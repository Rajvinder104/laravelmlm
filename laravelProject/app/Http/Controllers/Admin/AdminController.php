<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;
use App\Providers\Helper\Encrypt as EnCrypt;

class AdminController extends Controller
{
    /***************************************************** registerview ******************************************************/
    public function registerview()
    {
        $response['header'] = 'Join Our Community';
        $response['form_open'] = Form::open(['route' => 'AdminregisterPOST', 'method' => 'POST']);
        $response['form_close'] = Form::close('');
        $response['form'] = [
            'user_id' => Form::label('user_id', 'User Id') . Form::text('user_id', old('user_id'), ['id' => 'user_id', 'class' => 'form-control', 'placeholder' => 'Enter User Id']),
            'password' => Form::label('password', 'Password') . Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Your Password']),
            'password_confirmation' => Form::label('password_confirmation', 'Confirm Password') . Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Confirm Your Password']),

        ];
        $response['form_button'] = Form::submit('Register', ['class' => 'w-100 btn btn-info mt-4']);
        return adminView('forms', $response);
    }


    /***************************************************** registerPOST ******************************************************/
    public function registerPOST(Request $request)
    {
        $message = 'register';
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $update = [
                'user_id' => $request->user_id,
                'password' => EnCrypt::encrypt($request->password),
            ];
            $res = update_data('admins', ['id' => 1], $update);
            if ($res) {
                return flashdata('admin/register', $message, 'Admin Data Updated Successully!', 'success');
            } else {
                return flashdata('admin/register', $message, 'something went wrong !', 'danger');
            }
        } else {
            return flashdata('admin/register', $message, 'something went wrong !', 'danger');
        }
    }


    /***************************************************** loginview ******************************************************/
    public function loginview()
    {
        $response['header'] = 'Login to join us';
        $response['form_open'] = Form::open(['route' => 'AdminloginPost']);
        $response['form_close'] = Form::close('');

        $response['form'] = [
            'user_id' => Form::label('user_id', 'User Id') . Form::text('user_id', old('user_id'), ['id' => 'user_id', 'class' => 'form-control', 'placeholder' => 'Enter User Id']),
            'password' => Form::label('password', 'Password') . Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Your Password']),
        ];
        $response['form_button'] = [Form::submit('Login', ['class' => 'w-100 btn btn-info mt-4'])];
        return adminView('adminlogin', $response);
    }


    /***************************************************** AdminloginPost ******************************************************/
    public function AdminloginPost(Request $request)
    {
        $message = 'login';

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);

            $user = get_single_record('admins', ['id' => 1], '*');
            $checkPassword = EnCrypt::decrypt($user['password']);
            if ($checkPassword == $credentials['password'] &&  $credentials['user_id'] == "adminaccess") {

                if (Auth::guard('admin')->loginUsingId($user['id'])) {
                    $adminUser = Auth::guard('admin')->user();
                    $role = $adminUser->role;
                    session(['role' => $role]);
                    return redirect()->route('admin/index');
                }
            } else {
                return redirect()->route('admin/login')->with('message', 'Invalid credentials or admin not found', 'danger');

                return flashdata('admin/login', $message, 'Invalid credentials or admin not found', 'danger');
            }
            return flashdata('admin/login', $message, 'Invalid credentials or admin not found', 'danger');
        }
    }


    /***************************************************** logout ******************************************************/
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin/login');
    }


    /***************************************************** checkUserSession ******************************************************/
    public function checkUserSession()
    {
        $userId = session('user_id');

        if ($userId) {
            return "User ID in session: " . $userId;
        } else {

            return "User ID not found in session.";
        }
    }
}
