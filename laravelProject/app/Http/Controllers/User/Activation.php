<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super_model;
use App\Providers\Helper\FormHelper as Form;
use App\Helpers\businessHelper as business;
use App\Providers\Helper\Encrypt as EnCrypt;

class Activation extends Controller
{
    /********************************************************  __construct *************************************************/
    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }

    /********************************************************  index *************************************************/
    public function index()
    {

        $message = 'activation';
        $response['header'] = "Activate Account";
        $response['message'] = $message;
        $response['wallet_Balance'] = get_single_record('tbl_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as wallet_Balance');
        $packages = get_records('tbl_package', [], '*');
        $price = [];


        foreach ($packages as $key => $package) {
            $price[$package->id] = $package->id . '- ' . $package->title . ' ' . currency . $package->price;
        }
        $response['package'] = $price;
        return userView('activation', $response);
    }



    /********************************************************  activate *************************************************/
    public function activate(Request $req)
    {
        if (activation == 0) {
            $message = 'activation';
            if ($req->isMethod('post')) {
                $req->validate([
                    'user_id' => 'required|string',
                    'amount' => 'required|numeric'
                ]);
                $user_id = $req->input('user_id');
                $activationAmount = $req->input('amount');
                $user = get_single_record('users', ['user_id' => $user_id], '*');

                $walletBalance = get_single_record('tbl_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as walletBalance');
                // $CheckPackage = json_decode($user['package'], true);
                if (!empty($user)) {
                    if ($walletBalance['walletBalance'] >= $activationAmount) {
                        if ($activationAmount >= $user['package_amount']) {
                            tbl_walletAdd($user_id, $activationAmount);
                            tbl_usersupdate($user_id, $activationAmount);
                            tbl_addActivation($user_id, $activationAmount);
                            if ($user['paid_status'] == 0) {
                                $directs = update_directs($user['sponsor']);
                            }

                            $sponsor = get_single_record('users', ['user_id' => $user['sponsor']], 'user_id,sponsor,directs,paid_status');

                            //************************ Direct Income Start ************************/

                            if (direct_access == 0) {
                                if (!empty($sponsor['user_id'])) {
                                    // $CheckPacksgesponsor = json_decode($sponsor['package'], true);
                                    if ($sponsor['paid_status'] == 1) {
                                        $direct_income = $activationAmount * 0.05;
                                        $remark = 'Direct Income for ' . $user_id . ' Activation Amount ' . $activationAmount;
                                        add_direct_Income($sponsor['user_id'], $direct_income, 'direct_income', $remark);
                                    }
                                }
                            }
                            //************************ Direct Income Start ************************/

                            //************************ Roi Income Start ************************/

                            if (roi_access == 0) {
                                $dailyroi = $activationAmount * 0.02;
                                $totalroi = $dailyroi * 100;

                                $this->roiIncomeAdd($user_id, $activationAmount, $totalroi, $dailyroi, 200, 'roi_income');
                            }

                            //************************ Roi Income End ************************/

                            //************************ Level Income Start ************************/

                            if (level_access == 0) {
                                $level_income = '0.04,0.03,0,02,0.01';
                                if (!empty($sponsor)) {
                                    $this->level_income($sponsor['sponsor'], $user_id, $activationAmount, $level_income);
                                }
                            }

                            //************************ Level Income End ************************/

                            return flashdata('activate-account', $message, 'Account Activated Successfully', 'success');
                        } else {
                            return flashdata('activate-account', $message, 'This Package Is Alredy Activate', 'danger');
                        }
                    } else {
                        return flashdata('activate-account', $message, 'Insuffcient Balance!', 'danger');
                    }
                } else {
                    return flashdata('activate-account', $message, 'User Not Found!', 'danger');
                }
            }
        } else {
            $message = 'activation';
            if ($req->isMethod('post')) {
                $req->validate([
                    'user_id' => 'required|string',
                    'package_id' => 'required|numeric',
                ]);
                $user_id = $req->input('user_id');
                $packages = get_single_record('tbl_package', ['id' => $req->input('package_id')], '*');
                $activationAmount = $packages['price'];
                $user = get_single_record('users', ['user_id' => $user_id], '*');
                $walletBalance = get_single_record('tbl_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as walletBalance');
                if (!empty($user)) {
                    if ($walletBalance['walletBalance'] >= $activationAmount) {
                        if ($activationAmount >= $user['package_amount']) {
                            tbl_walletAdd($user_id, $activationAmount);
                            tbl_addActivation($user_id, $activationAmount);
                            tbl_usersupdate($user_id, $activationAmount);
                            if ($user['paid_status'] == 0) {
                                update_directs($user['sponsor']);
                            }
                            $sponsor = get_single_record('users', ['user_id' => $user['sponsor']], 'user_id,sponsor,paid_status');

                            //************************ Direct Income Start ************************/

                            if (direct_access == 0) {
                                if (!empty($sponsor['user_id'])) {
                                    if ($sponsor['paid_status'] == 1) {
                                        $direct_income = $activationAmount * 0.05;
                                        $remark = 'Direct Income for ' . $user_id . ' Activation Amount ' . $activationAmount;
                                        add_direct_Income($sponsor['user_id'], $direct_income, 'direct_income', $remark);
                                    }
                                }
                            }

                            //************************ Direct Income End ************************/

                            //************************ Roi Income Start ************************/

                            if (roi_access == 0) {
                                $dailyroi = $activationAmount * 0.02;
                                $totalroi = $dailyroi * $packages['days'];
                                $this->roiIncomeAdd($user_id, $activationAmount, $totalroi, $dailyroi, 200, 'roi_income');
                            }

                            //************************ Roi Income End ************************/

                            //************************ Level Income Start ************************/

                            if (level_access == 0) {
                                $level_income = '0.04,0.03,0,02,0.01';
                                if (!empty($sponsor)) {
                                    $this->level_income($sponsor['sponsor'], $user_id, $activationAmount, $level_income);
                                }
                            }

                            //************************ Level Income End ************************/

                            return flashdata('activate-account', $message, 'Account Activated Successfully', 'success');
                        } else {
                            return flashdata('activate-account', $message, 'This Package Is Alredy Activate', 'danger');
                        }
                    } else {
                        return flashdata('activate-account', $message, 'Insuffcient Balance!', 'danger');
                    }
                } else {
                    return flashdata('activate-account', $message, 'User Not Found!', 'danger');
                }
            }
        }
    }



    /********************************************************  roiIncomeAdd *************************************************/
    private function roiIncomeAdd($user_id, $activationAmount, $totalRoi, $dailyRoi, $days, $type)
    {
        $roiAdd = [
            'user_id' => $user_id,
            'package' => $activationAmount,
            'amount' => $totalRoi,
            'roi_amount' => $dailyRoi,
            'days' => $days,
            'total_days' => $days,
            'type' => $type,
            'creditDate' => date('Y-m-d H:i:s'),
        ];
        add('tbl_roi', $roiAdd);
    }



    /********************************************************  level_income *************************************************/
    private function level_income($sponsoId, $activatedid, $package, $income)
    {
        $incomeArr = explode(',', $income);

        foreach ($incomeArr as $key => $inc) {
            $level = $key + 2;
            $user = get_single_record('users', ['user_id' => $sponsoId], 'user_id,sponsor,paid_status');
            if (!empty($user)) {
                // $CheckPacksgesponsor = json_decode($user['package'], true);
                if ($user['paid_status'] == 1) {
                    $level_income = $package * $inc;
                    $remark = 'Level Income from Activation of Member (' . currency . $package . ') ' . $activatedid . ' At level ' . ($level);
                    add_direct_Income($user['user_id'], $level_income, 'level_income', $remark);
                }

                $sponsoId = $user['sponsor'];
            }
        }
    }
}
