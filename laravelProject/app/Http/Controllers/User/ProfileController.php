<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\FormHelper as Form;

class ProfileController extends Controller
{

    /*************************************************  profile_update ******************************************************/
    public function profile_update(Request $req)
    {
        $message = 'profile_update';
        $users = get_single_record('users', ['user_id' => session('user_id')], '*');
        $response['header'] = ' Personal Detail Update';
        $response['form_open'] = Form::open(route('profile-update'), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'name' => Form::label('Name', null, ['class' => 'form-label']) . Form::text('name', $users['name'], ['class' => 'form-control', 'placeholder' => 'Enter Your Name', 'required' => 'required']),
            'email' => Form::label('Email Address', null, ['class' => 'form-label']) . Form::email('email', $users['email'], ['class' => 'form-control ', 'placeholder' => 'Enter Email Address', 'required' => 'required']),
            'phone' => Form::label('Phone Number', null, ['class' => 'form-label']) . Form::number('phone', $users['phone'], ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'required' => 'required']),
        ];
        $response['form_button'] = Form::submit('Update', ['class' => 'btn btn-warning mt-3', 'id' => 'submit', 'style' => 'display: block;']);
        if ($req->isMethod('post')) {
            $validatedData = $req->validate([
                'email' => 'required|email',
                'name' => 'required|string',
                'phone' => 'required|numeric',

            ]);
            $data = [
                'email' => $req->input('email'),
                'name' => $req->input('name'),
                'phone' => $req->input('phone'),
            ];
            $update = update_data('users', ['user_id' => session('user_id')], $data);
            if ($update == true) {
                flashdata("profile-update", $message, 'Personal Detail Updated successful!', 'success');
                return redirect('profile-update');
            } else {
                flashdata('profile-update', $message, 'Try Again Later!', 'danger');
            }
        }
        $response['message'] = $message;
        $response['extra_header'] = false;
        return userView('forms', $response);
    }



    /*************************************************  bank_detail ******************************************************/
    public function bank_detail(Request $req)
    {
        $message = 'bank_detail';
        $users = get_single_record('bank_detail', ['user_id' => session('user_id')], '*');
        $response['header'] = ' Bank Detail Update';
        $response['form_open'] = Form::open(route('bank-detail-update'), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'bank_name' => Form::label('Bank Name', null, ['class' => 'form-label']) . Form::text('bank_name', $users['bank_name'], ['class' => 'form-control ', 'placeholder' => 'Enter Bank Name', 'required' => 'required']),
            'account_number' => Form::label('Account Number', null, ['class' => 'form-label']) . Form::text('account_number', $users['account_number'], ['class' => 'form-control', 'placeholder' => 'Enter Account Nnumber', 'required' => 'required']),
            'branch' => Form::label('Branch', null, ['class' => 'form-label']) . Form::text('branch', $users['branch'], ['class' => 'form-control', 'placeholder' => 'Enter Brach Name', 'required' => 'required']),
            'ifsc_code' => Form::label('Ifsc Code', null, ['class' => 'form-label']) . Form::text('ifsc_code', $users['ifsc_code'], ['class' => 'form-control', 'placeholder' => 'Enter Ifsc Code', 'required' => 'required']),
            'holder_name' => Form::label('Bank Holder Name', null, ['class' => 'form-label']) . Form::text('holder_name', $users['holder_name'], ['class' => 'form-control mb-3', 'placeholder' => 'Enter Bank Holder Name', 'required' => 'required']),
        ];
        if ($users['kyc_status'] == 1) {
            $response['form_button'] = badge_warning('Kyc Verification Pending');
        } elseif ($users['kyc_status'] == 2) {
            $response['form_button'] = badge_success('kyc Verification Approved');
        } else {
            $response['form_button'] = Form::submit('Update', ['class' => 'btn btn-warning mt-3', 'id' => 'submit', 'style' => 'display: block;']);
        }
        if ($req->isMethod('post')) {
            $validatedData = $req->validate([
                'bank_name' => 'required|string',
                'account_number' => 'required|string',
                'branch' => 'required|string',
                'ifsc_code' => 'required|string',
                'holder_name' => 'required|string',
            ]);
            $data = [
                'bank_name' => $req->input('bank_name'),
                'account_number' => $req->input('account_number'),
                'branch' => $req->input('branch'),
                'ifsc_code' => $req->input('ifsc_code'),
                'holder_name' => $req->input('holder_name'),
                'kyc_status' => 1,
            ];
            $update = update_data('bank_detail', ['user_id' => session('user_id')], $data);
            if ($update == true) {
                flashdata("bank-detail-update", $message, 'Bank Detail Updated successful!', 'success');
                return redirect('bank-detail-update');
            } else {
                flashdata('bank-detail-update', $message, 'Try Again Later!', 'danger');
                return redirect('bank-detail-update');
            }
        }
        $response['extra_header'] = false;
        $response['message'] = $message;
        return userView('forms', $response);
    }
}
