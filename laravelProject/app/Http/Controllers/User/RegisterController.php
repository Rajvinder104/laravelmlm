<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\Encrypt as EnCrypt;
use App\Models\Super_model;

class RegisterController extends Controller
{
    /*************************************************  __construct ******************************************************/

    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }



    /*************************************************  register ******************************************************/
    public function register()
    {
        $response['sponsor'] = '';
        if (!empty($_GET['sponsor'])) {
            $response['sponsor'] = $_GET['sponsor'];
        }

        if (registration == 0) {
            $response['message'] = 'register';
            return userView('register', $response);
        } else {
            $response['message'] = 'register_binary';
            return userView('register_binary', $response);
        }
    }


    /*************************************************  registerPOST ******************************************************/
    public function registerPOST(Request $request)
    {
        $message = 'register';
        if ($request->isMethod('post')) {
            $request->validate([
                'sponsor' => 'required|string',
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'password' => 'required|string|min:6|confirmed',

            ]);
            $sponsorId = $request->sponsor;
            $sponsor = get_single_record('users', ['user_id' => $sponsorId], '*');
            if (!empty($sponsor)) {
                $user_id = $this->generateUseId();
                $reigster = [
                    'user_id' => $user_id,
                    'sponsor' => $request->sponsor,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'name' => $request->name,
                    'password' => EnCrypt::encrypt($request->password),
                    'master_key' => rand(100000, 999999),
                    'incomes' => $this->incomeArray(),

                ];
                $res = add('users', $reigster);
                add('bank_detail', ['user_id' => $reigster['user_id']]);
                if ($res) {
                    $this->add_sponser_counts($reigster['user_id'], $reigster['user_id'], 1);
                    return flashdata('register', $message, ' Register User Successully!', 'success');
                    return redirect('register');
                } else {
                    return flashdata('register', $message, 'something went wrong !', 'danger');
                }
            } else {
                return flashdata('register', $message, 'Sponsor Id Is Not Valid', 'danger');
            }
        } else {
            return flashdata('register', $message, 'something went wrong !', 'danger');
        }
        return redirect('register');
    }



    /*************************************************  binaryregisterPOST ******************************************************/
    public function binaryregisterPOST(Request $request)
    {
        $message = 'register_binary';
        if ($request->isMethod('post')) {
            $request->validate([
                'sponsor' => 'required|string',
                'phone' => 'required',
                'name' => 'required|string',
                'password' => 'required|string|min:4|confirmed',
                'email' => 'required|email',
            ]);
            $sponsorId = $request->sponsor;
            $sponsor = get_single_record('users', ['user_id' => $sponsorId], '*');
            $upline = get_single_record('binary_users', ['user_id' => $sponsorId], '*');
            if (!empty($sponsor)) {
                $user_id = $this->generateUseId();
                $reigster = [
                    'user_id' => $user_id,
                    'sponsor' => $request->sponsor,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'name' => $request->name,
                    'password' => EnCrypt::encrypt($request->password),
                    'master_key' => rand(100000, 999999),
                    'incomes' => $this->incomeArray(),
                ];
                $res = add('users', $reigster);
                add('bank_detail', ['user_id' => $reigster['user_id']]);
                $binary_users = [
                    'user_id' => $reigster['user_id'],
                    'last_left' => $reigster['user_id'],
                    'last_right' => $reigster['user_id'],
                    'position' => $request->position,
                ];
                if ($binary_users['position'] == "L") {
                    $binary_users['upline_id'] = $upline['last_left'];
                } elseif ($binary_users['position'] == "R") {
                    $binary_users['upline_id'] = $upline['last_right'];
                } else {
                    return flashdata('register', $message, 'Something went wrong !', 'danger');
                }

                $res = add('binary_users', $binary_users);
                if ($res) {
                    // *******Binary Start********

                    if ($binary_users['position'] == 'R') {
                        update_data('binary_users', array('last_right' => $binary_users['upline_id']), array('last_right' => $binary_users['user_id']));
                        update_data('binary_users', array('user_id' => $binary_users['upline_id']), array('right_node' => $binary_users['user_id']));
                    } elseif ($binary_users['position'] == 'L') {
                        update_data('binary_users', array('last_left' => $binary_users['upline_id']), array('last_left' => $binary_users['user_id']));
                        update_data('binary_users', array('user_id' => $binary_users['upline_id']), array('left_node' => $binary_users['user_id']));
                    } else {
                        return flashdata('register', $message, 'Something went wrong !', 'danger');
                    }
                    $this->add_counts($binary_users['user_id'], $binary_users['user_id'], 1);
                    $this->add_sponser_counts($binary_users['user_id'], $binary_users['user_id'], 1);

                    //******Binary End********

                    $mailmessage = "User ID: " . $binary_users['user_id'] . "<br> Password: " . EnCrypt::decrypt($reigster['password']) . "<br> Sponsor ID: " . $reigster['sponsor'];
                    $subject = "Registration Successfully";
                    $mail = $reigster['email'];
                    SendMail($mail, $mailmessage, $subject);

                    return flashdata('register', $message, ' Register User Successully!', 'success');
                } else {
                    return flashdata('register', $message, 'something went wrong !', 'danger');
                }
            } else {
                return flashdata('register', $message, 'Sponsor Id Is Not Valid', 'danger');
            }
        } else {
            return flashdata('register', $message, 'something went wrong !', 'danger');
        }
        return redirect('register');
    }



    /*************************************************  generateUseId ******************************************************/
    private function generateUseId()
    {
        $user_id = prefix . rand(100000, 999999);
        $check = get_single_record('users', ['user_id' => $user_id], '*');
        if (!empty($check)) {
            return $this->generateUseId();
        } else {
            return $user_id;
        }
    }



    /*************************************************  add_sponser_counts ******************************************************/
    private function add_sponser_counts($user_name, $downline_id, $level)
    {
        $user = get_single_record('users', ['user_id' => $user_name], 'sponsor,user_id');
        if ($user['sponsor'] != '' && $user['sponsor'] != 'none') {
            $downlineArray = array(
                'user_id' => $user['sponsor'],
                'downline' => $downline_id,
                'position' => '',
                'level' => $level,
            );
            add('sponsor_count', $downlineArray);
            $user_name = $user['sponsor'];
            $this->add_sponser_counts($user_name, $downline_id, $level + 1);
        }
    }



    /*************************************************  add_counts ******************************************************/
    private function add_counts($user_name, $downline_id, $level)
    {
        $user = get_single_record('binary_users', array('user_id' => $user_name), 'upline_id,position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->supermodel->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline' => $downline_id,
                'position' => $user['position'],
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            add('downline_count', $downlineArray);
            $user_name = $user['upline_id'];
            if ($user['upline_id'] != '') {
                $this->add_counts($user_name, $downline_id, $level + 1);
            }
        }
    }


    /*************************************************  incomeArray ******************************************************/
    private function incomeArray()
    {
        $incomes = configArray('incomes');
        $packageArray = [];
        foreach ($incomes as $key => $value) {
            $packageArray[$key] = 0;
        }
        return json_encode($packageArray);
    }
}
