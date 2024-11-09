<?php

namespace App\Http\Controllers\User;

use App\Providers\Helper\FormHelper as Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\Encrypt as EnCrypt;

class UserSettings extends Controller
{
    /********************************************************  reset_password *************************************************/
    public function reset_password(Request $request)
    {
        $message = 'resetPAssword';

        $response['title'] = 'reset-password';
        $response['header'] = 'Reset-Password';

        $response['form_open'] = Form::open(route('reset_passaword'), 'POST');

        $response['form'] = [
            'cpassword' => Form::label('Current Password', '', ['class' => 'form-label']) .
                Form::password('cpassword', old('cpassword', ''), ['class' => 'form-control', 'placeholder' => 'Enter Current Password']),
            'password' => Form::label('New Password', '', ['class' => 'form-label']) .
                Form::password('password', old('password', ''), ['class' => 'form-control', 'id' => 'npassword', 'placeholder' => 'Enter New Password']),
            'password_confirmation' => Form::label('Confirm Password', '', ['class' => 'form-label']) .
                Form::password('password_confirmation', old('password_confirmation', ''), ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']),
        ];
        $response['form_button'] = Form::submit('Update', ['class' => 'btn btn-primary']);

        if ($request->isMethod('post')) {
            $credentials =  $request->validate([
                'cpassword' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = get_single_record('users', ['user_id' => session('user_id')], '*');
            $checkUserPassoerd = EnCrypt::decrypt($user['password']);
            if ($checkUserPassoerd != $credentials['cpassword']) {
                return flashdata('reset_passaword', $message, 'Current password is incorrect', 'danger');
            }
            $data = [
                'password' => EnCrypt::encrypt($credentials['password']),
            ];
            $res = update_data('users', ['user_id' => session('user_id')], $data);
            if ($res) {
                return flashdata('reset_passaword', $message, 'Password Updated Successfully', 'success');
            } else {
                return flashdata('reset_passaword', $message, 'Something Went Wrong', 'danger');
            }
        }
        $response['message'] = $message;
        $response['extra_header'] = false;
        return userView('forms', $response);
    }
}
