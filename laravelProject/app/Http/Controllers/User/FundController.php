<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\FormHelper as Form;

class FundController extends Controller
{
    /*************************************************  Request_fund ******************************************************/
    public function Request_fund(Request $request)
    {
        $message = 'Request_Fund';
        $response['header'] = 'Request Fund';
        $response['wallet_Balance'] = get_single_record('tbl_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as wallet_Balance');
        if (request()->isMethod('post')) {
            $credentials = $request->validate([
                'amount' => 'required',
                'transaction_id' => 'required',
                'payment_method' => 'required',
                'image' => 'required',
            ]);
            $file = $request->file('image');
            $filePath = $file->store('uploads', 'public');

            $check = get_single_record('users', array('master_key' => $request['transaction_id']), '*');
            if (!empty($check['master_key'])) {
                $add = [
                    'image' => $filePath,
                    'user_id' => session('user_id'),
                    'amount' => $credentials['amount'],
                    'payment_method' => $credentials['payment_method'],
                    'transaction_id' => $credentials['transaction_id'],
                    'type' => 'fund_request',
                ];
                $AddData = add('tbl_payment_request', $add);
                if ($AddData) {
                    flashdata('request_fund', $message, 'Your request for funding has been successfully processed.', 'success');
                } else {
                    flashdata('request_fund', $message, 'Something Went Wrong', 'danger');
                }
            } else {
                flashdata('request_fund', $message, 'Error please enter vaild Hash ID', 'danger');
            }
        }
        $response['qrcode'] = get_single_record('tbl_qrcode', ['id' => 1], "*");
        $response['message'] = $message;
        return userView('request-fund', $response);
    }
}
