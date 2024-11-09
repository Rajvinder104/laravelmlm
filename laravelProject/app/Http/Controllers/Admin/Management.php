<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Super_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\Helper\Encrypt as EnCrypt;
use App\Providers\Helper\FormHelper as Form;

class Management extends Controller
{
    /***************************************************** Update_fund_request ******************************************************/
    public function index()
    {
        $date = date('Y-m-d');
        $response['settings'] = get_single_record('plan_setting', ['id' => 1], '*');
        $response['total_user'] = get_sum('users', [], 'COUNT(id)');
        $response['paid_users'] = get_sum('users', ['paid_status' => 1], 'COUNT(id)');
        $response['today_paid_users'] = get_sum('users', ['paid_status' => 1, 'DATE(created_at)' => $date], 'COUNT(id)');
        $response['today_user'] = get_sum('users', ['DATE(created_at)' => $date], 'COUNT(id)');
        $response['wallet_balance'] = get_single_record('tbl_wallet', [], 'ifnull(sum(amount),0) as wallet_balance');
        $response['total_payout'] = get_single_record('tbl_income_wallet',  [['amount', '>', 0]], 'ifnull(sum(amount),0) as total_payout');
        $response['total_mail'] = get_sum('support_message', 'user_id != "Admin"', 'COUNT(id)');
        $response['pending_total_mail'] = get_sum('support_message', 'user_id != "Admin"', 'status = "0"', 'COUNT(id)');
        $response['approved_mail'] = get_sum('support_message', 'user_id != "Admin"', 'status = "1"', 'COUNT(id)');


        return adminView('dashboard', $response);
    }


    /***************************************************** userLogin ******************************************************/
    public function userLogin($user_id)
    {
        $userid = EnCrypt::decrypt($user_id);
        $user = get_single_record('users', ['user_id' => $userid], '*');
        if (!empty($user)) {
            if (Auth::guard('user')->loginUsingId([$user['id']])) {
                Auth::guard('user')->user();
                $role = $user['role'];
                $user_id = $user['user_id'];
                session(['role' => $role]);
                session(['user_id' => $userid]);
                return redirect('index');
            }
        }
    }



    /***************************************************** blockStatus ******************************************************/
    public function blockStatus($user_id, $status)
    {
        $response['success'] = 0;
        $updres = update_data('users', array('user_id' => $user_id), array('disabled' => $status));

        if ($updres) {
            $response['success'] = 1;
            $response['message'] = 'Status Updated Successfully';
        } else {
            $response['message'] = 'Error While Updating Status';
        }

        return response()->json($response);
    }


    /***************************************************** Send_Income ******************************************************/
    public function Send_Income(Request $request)
    {
        $response = [];
        $message = 'send-income';
        $response['header'] = 'Send Income';
        $response['form_open'] = Form::open('send-income', 'POST', ['class' => 'form-horizontal']);
        $incomes = configArray('incomes');
        $response['form'] = [
            'user_id' => Form::label('User ID', '', ['class' => 'form-label']) . Form::text('user_id', '', ['class' => 'form-control', 'placeholder' => 'Enter User ID', 'id' => 'user_id', 'onkeyup' => "getName()"]),
            '<span id="userName" ></span>',
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) . Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount']),
            'income_type' => Form::label('Income Type', '', ['class' => 'form-label']) . Form::dropdown('income_type', $incomes, '', ['class' => 'form-control']),
            'type' => Form::label('Type', '', ['class' => 'form-label']) . Form::dropdown('type', ['credit' => 'Credit', 'debit' => 'Debit'], '', ['class' => 'form-control']),
        ];

        $response['form_close'] = Form::close();
        $response['form_button'] = [
            Form::submit('Send', ['class' => 'btn btn-primary mt-3'])
        ];

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'amount' => 'required',
                'income_type' => 'required',
                'type' => 'required',
            ]);
            $amount = $credentials['amount'];

            if ($credentials['type'] == 'credit') {
                $amount = abs($credentials['amount']);
            } else {
                $amount = '-' . abs($credentials['amount']);
            }

            $user = get_single_record('users', ['user_id' => $credentials['user_id']], '*');

            if (!empty($user)) {
                $sendwallet = [
                    'amount' => $amount,
                    'user_id' => $credentials['user_id'],
                    'type' => $request['income_type'],
                    'remark' => 'Income ' . strtoupper($request['type']) . ' by Admin ',
                    'admin_status' => 1,

                ];

                $add = add('tbl_income_wallet', $sendwallet);

                if ($add) {
                    flashdata('send-income', $message, 'Income ' . ucwords($request['type']) . ' Successfully', 'success');
                } else {
                    flashdata('send-income', $message, 'Something went wrong', 'danger');
                }
            } else {
                flashdata('send-income', $message, 'User not found', 'danger');
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }
}
