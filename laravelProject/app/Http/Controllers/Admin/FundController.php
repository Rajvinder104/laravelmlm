<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\Encrypt as EnCrypt;
use App\Providers\Helper\FormHelper as Form;

class FundController extends Controller
{
    /***************************************************** SendWallet ******************************************************/
    public function SendWallet(Request $request)
    {
        $response = [];
        $message = 'send-wallet';
        $response['header'] = 'Send Wallet';
        $response['title'] = 'Send Wallet';
        $response['form_open'] = Form::open('send-wallet', 'POST', ['class' => 'form-horizontal']);

        $response['form'] = [
            'user_id' => Form::label('User ID', '', ['class' => 'form-label']) . Form::text('user_id', '', ['class' => 'form-control', 'placeholder' => 'Enter User ID', 'id' => 'user_id', 'onkeyup' => "getName()"]),
            '<span id="userName" ></span>',
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) . Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount']),
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
                    'type' => 'admin_amount',
                    'sender_id' => 'admin',
                    'remark' => 'Fund' . $credentials['type'] . ' by admin',
                ];

                $add = add('tbl_wallet', $sendwallet);

                if ($add) {
                    flashdata('send-wallet', $message, 'Wallet Send Successfully', 'success');
                } else {
                    flashdata('send-wallet', $message, 'Something went wrong', 'danger');
                }
            } else {
                flashdata('send-wallet', $message, 'User not found', 'danger');
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }


    /***************************************************** Update_fund_request ******************************************************/
    public function Update_fund_request(Request $request, $id)
    {
        $fundrequest = get_single_record('tbl_payment_request', array('id' => $id), '*');
        $response = [];
        $message = 'message-fund';
        $response['header'] = 'Update Fund Request';
        $response['form_open'] = Form::open(route('update-fund-request', ['id' => $id]), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);

        $response['form'] = [
            'user_id' => Form::label('User ID', '', ['class' => 'form-label']) . Form::text('user_id', $fundrequest['user_id'], ['class' => 'form-control', 'placeholder' => 'Enter User ID', 'readonly' => 'readonly', 'id' => 'user_id', 'onkeyup' => "getName()"]),
            '<span id="userName" ></span>',
            'image' => Form::label('Image', '', ['class' => 'form-label']) . '<img alt="Proof Image" class="img-thumbnail d-block" src="' . asset('storage/' . $fundrequest['image']) . '">',
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) . Form::text('amount', $fundrequest['amount'], ['class' => 'form-control', 'placeholder' => 'Enter Amount', 'readonly' => 'readonly']),
            'remarks' => Form::label('Remarks', '', ['class' => 'form-label']) . Form::textarea('remarks', '', ['class' => 'form-control', 'placeholder' => 'Enter Remarks']),
            'type' => Form::label('Type', '', ['class' => 'form-label']) . Form::dropdown('type', ['approve' => 'Approved', 'reject' => 'Rejected'], '', ['class' => 'form-control']),
        ];

        $response['form_button'] = [
            Form::submit('Update', ['class' => 'btn btn-primary mt-3'])
        ];
        $response['form_close'] = Form::close();
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'amount' => 'required',
                'type' => 'required',
                'remarks' => 'required',
            ]);

            if ($request['type'] == 'reject') {
                $updres =   update_data('tbl_payment_request', ['id' => $id], ['status' => 2, 'remarks' => $request->remarks]);
                if ($updres == true) {
                    flashdata('update-fund-request', $message, 'Reqeust Rejected Successfully', 'danger', $id);
                } else {
                    flashdata('update-fund-request', $message, 'There is an error while Rejecting request Please try Again ..', 'danger', $id);
                }
            } elseif ($request['type'] == 'approve') {
                if ($fundrequest['status'] != 1) {
                    $updres =   update_data('tbl_payment_request', ['id' => $id], ['status' => 1, 'remarks' => $request->remarks]);
                    if ($updres == true) {
                        $walletData = array(
                            'user_id' => $fundrequest['user_id'],
                            'amount' => $fundrequest['amount'],
                            'sender_id' => 'admin',
                            'type' => 'admin_fund',
                            'remark' => $request->remarks,
                        );
                        $add =   add('tbl_wallet', $walletData);
                        if ($add == true) {
                            flashdata('update-fund-request', $message, 'Your fund request has been successfully accepted.', 'success', $id);
                        }
                    } else {
                        flashdata('update-fund-request', $message, 'There is an error while Rejecting request Please try Again ..', 'danger', $id);
                    }
                }
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }
}
