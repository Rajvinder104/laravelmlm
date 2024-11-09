<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\Helper\Encrypt as EnCrypt;

class AuthController extends Controller
{

    /*************************************************  login ******************************************************/
    public function login()
    {
        $response['message'] = 'login';
        return userView('login', $response);
    }



    /*************************************************  loginPost ******************************************************/
    public function loginPost(Request $request)
    {
        $message = 'login';
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            $user = get_single_record('users', ['user_id' => $credentials['user_id']], '*');
            if (!empty($user)) {
                $checkPassword = EnCrypt::decrypt($user['password']);

                if ($checkPassword == $credentials['password']) {
                    if (Auth::guard('user')->loginUsingId([$user['id']])) {
                        $adminUser = Auth::guard('user')->user();
                        $role = $adminUser->role;
                        $user_id = $adminUser->user_id;
                        session(['role' => $role]);
                        session(['user_id' => $user_id]);
                        return flashdata('index', $message, 'Welcome User!', 'success');
                    }
                } else {
                    return redirect()->route('login')->with('message', span_danger('Invalid credentials or admin not found'));
                }
            } else {
                return redirect()->route('login')->with('message', span_danger('Invalid credentials or admin not found'));
            }
            return redirect()->route('login')->with('message', span_danger('Invalid credentials or admin not found'));
        }
    }


    /*************************************************  logout ******************************************************/
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


    /*************************************************  session ******************************************************/
    public function session()
    {
        dd(session('role'));
    }


    /*************************************************  forgot ******************************************************/
    public function forgot()
    {
        // $response = [];
        $response['message'] = 'forgot_pass';
        return userView('forgot-password', $response);
    }



    /*************************************************  forgot_pass ******************************************************/
    public function forgot_pass(Request $req)
    {
        $response = [];
        $message = 'forgot_pass';
        if ($req->isMethod('post')) {
            $req->validate([
                'user_id' => 'required|string',
            ]);
            $user = get_single_record('users', ['user_id' => $req['user_id']], '*');
            if ($user) {
                $to = $user['email'];
                $password = EnCrypt::decrypt($user['password']);
                $subject = 'Forgot Password';
                $messags = "user_id :-" . $user['user_id'] . '<br> Password :-' . $password;
                SendMail($to, $messags, $subject);
                return flashdata('forgot_password', $message, 'Detail Sent Your Registerd Email', 'success');
                return redirect('forgot_password');
            } else {
                return flashdata('forgot_password', $message, 'User Not Found!', 'danger');
            }
        }
    }
}
