<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\FormHelper as Form;

class TransferController extends Controller
{
    /*************************************************  income_to_eWallet_Transfer ******************************************************/
    public function income_to_eWallet_Transfer(Request $request)
    {
        $message = 'wallet-transfer';
        $response['extra_header'] = true;
        $response['balance'] = get_single_record('tbl_income_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
        $response['header'] = 'Income Transfer to E-Wallet';
        $response['form_open'] = Form::open(route('income-to-ewallet-transfer'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'user_id' => Form::label('User Id', '', ['class' => 'form-label']) .
                Form::text('user_id', session('user_id'), ['class' => 'form-control', 'readonly' => 'readonly']),
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) .
                Form::text('amount', old('amount', ''), ['class' => 'form-control', 'placeholder' => 'amount']),

        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'btn btn-primary mt-3', 'id' => 'submit', 'style' => 'display: block;']);
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'amount' => 'required|numeric',

            ]);
            $balance = get_single_record('tbl_income_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
            $checkuser = get_single_record('users', ['user_id' => $request['user_id']], '*');
            $transfer_amount = $request['amount'];
            $todayTransfer = get_single_record('tbl_wallet', ['user_id' => session('user_id'), 'type' => 'income_wallet_transfer'], '*', true);
            $minimum_amount = 1;
            $maximum_amount = 10;
            $charges = 0.10;
            $userinfo = userinfo();
            if (empty($todayTransfer)) {
                if (!empty($checkuser['user_id'])) {
                    if ($userinfo['directs'] >= 1) {
                        if ($transfer_amount >= $minimum_amount && $transfer_amount <= $maximum_amount) {
                            if ($transfer_amount % $minimum_amount == 0) {
                                if ($balance['balance'] >= $transfer_amount) {
                                    $DebitIncome = array(
                                        'user_id' => session('user_id'),
                                        'amount' => -$transfer_amount,
                                        'type' => 'income_wallet_transfer',
                                        'remark' => 'Sent ' . $transfer_amount . ' to ' . $request->user_id,
                                    );
                                    add('tbl_income_wallet', $DebitIncome);

                                    $CrdeitIncome = array(
                                        'user_id' => $request->user_id,
                                        'amount' => ($transfer_amount * $charges),
                                        'type' => 'income_wallet_transfer',
                                        'remark' => 'Got ' . ($transfer_amount * $charges) . ' from ' . session('user_id'),
                                    );
                                    add('tbl_wallet', $CrdeitIncome);
                                    return flashdata('income-to-ewallet-transfer', $message, 'Income Transfer Successfully', 'success');
                                } else {
                                    return flashdata('income-to-ewallet-transfer', $message, 'Insuffcient Balance', 'info');
                                }
                            } else {
                                return flashdata('income-to-ewallet-transfer', $message, 'Multiple Transfer Amount is ' . currency . $minimum_amount, 'danger');
                            }
                        } else {
                            return flashdata('income-to-ewallet-transfer', $message, 'Minimum Transfer Amount is ' . currency . $minimum_amount . '   and Maximum  ' . currency . $maximum_amount, 'danger');
                        }
                    } else {
                        return flashdata('income-to-ewallet-transfer', $message, '1 Direct required for Transfer !', 'danger');
                    }
                } else {
                    return flashdata('income-to-ewallet-transfer', $message, 'Invalid User', 'danger');
                }
            } else {
                return flashdata('income-to-ewallet-transfer', $message, 'Income to E-Wallet Transfer Once in a Day Only !', 'danger');
            }
        }

        $response['message'] = $message;

        return userView('forms', $response);
    }



    /*************************************************************  Income_transfer ******************************************************/
    public function Income_transfer(Request $request)
    {
        $message = 'income-transfer';
        $response['extra_header'] = true;
        $response['balance'] = get_single_record('tbl_income_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
        $response['header'] = 'Income Transfer';
        $response['form_open'] = Form::open(route('income-transfer'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'user_id' => Form::label('User Id', '', ['class' => 'form-label']) .
                Form::text('user_id', old('user_id'), ['class' => 'form-control', 'placeholder' => 'user id']),
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) .
                Form::text('amount', old('amount', ''), ['class' => 'form-control', 'placeholder' => 'amount']),

        ];
        $response['form_button'] = Form::submit('Transfer Income', ['class' => 'btn btn-primary mt-3', 'id' => 'submit', 'style' => 'display: block;']);
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'amount' => 'required|numeric',

            ]);
            $balance = get_single_record('tbl_income_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
            $checkuser = get_single_record('users', ['user_id' => $request['user_id']], '*');
            $transfer_amount = $request['amount'];
            $minimum_amount = 1;
            $maximum_amount = 100;
            $charges = $transfer_amount * 95 / 100;
            if (!empty($checkuser['user_id'])) {
                if ($request['user_id'] !=  session('user_id')) {
                    if ($transfer_amount >= $minimum_amount && $transfer_amount <= $maximum_amount) {
                        if ($transfer_amount % $minimum_amount == 0) {
                            if ($balance['balance'] >= $transfer_amount) {
                                $DebitIncome = array(
                                    'user_id' => session('user_id'),
                                    'amount' => -$transfer_amount,
                                    'type' => 'income_transfer',
                                    'remark' => 'Sent ' . $transfer_amount . ' to ' . $request->user_id,
                                );
                                add('tbl_income_wallet', $DebitIncome);

                                $CrdeitIncome = array(
                                    'user_id' => $request->user_id,
                                    'amount' =>  $charges,
                                    'type' => 'income_transfer',
                                    'remark' => 'Got ' . ($transfer_amount * $charges) . ' from ' . session('user_id'),
                                );
                                add('tbl_income_wallet', $CrdeitIncome);
                                return flashdata('income-transfer', $message, 'Income Transfer Successfully', 'success');
                            } else {
                                return flashdata('income-transfer', $message, 'Insuffcient Balance', 'info');
                            }
                        } else {
                            return flashdata('income-transfer', $message, 'Multiple Transfer Amount is ' . currency . $minimum_amount, 'danger');
                        }
                    } else {
                        return flashdata('income-transfer', $message, 'Minimum Transfer Amount is ' . currency . $minimum_amount . '   and Maximum  ' . currency . $maximum_amount, 'danger');
                    }
                } else {
                    return flashdata('income-transfer', $message, 'Cannot Transfer as same amount !', 'danger');
                }
            } else {
                return flashdata('income-transfer', $message, 'Invalid User', 'danger');
            }
        }

        $response['message'] = $message;

        return userView('forms', $response);
    }


    /*********************************************************************  Wallet_transfer ******************************************************/
    public function Wallet_transfer(Request $request)
    {
        $message = 'wallet-transfer';
        $response['extra_header'] = true;
        $response['balance'] = get_single_record('tbl_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
        $response['header'] = 'Wallet Transfer';
        $response['form_open'] = Form::open(route('wallet-transfer'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'user_id' => Form::label('User Id', '', ['class' => 'form-label']) .
                Form::text('user_id', old('user_id'), ['class' => 'form-control', 'placeholder' => 'User Id']),
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) .
                Form::text('amount', old('amount', ''), ['class' => 'form-control', 'placeholder' => 'Amount']),
            'txn_password' => Form::label('Transaction Password', '', ['class' => 'form-label']) .
                Form::text('txn_password', old('txn_password', ''), ['class' => 'form-control', 'placeholder' => 'Transaction Password']),

        ];
        $response['form_button'] = Form::submit('Transfer Wallet', ['class' => 'btn btn-primary mt-3', 'id' => 'submit', 'style' => 'display: block;']);
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'amount' => 'required|numeric',
                'txn_password' => 'required|numeric',

            ]);
            $balance = get_single_record('tbl_wallet',  ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
            $checkuser = get_single_record('users', ['user_id' => $request['user_id']], '*');
            $transfer_amount = $request['amount'];
            $minimum_amount = 1;
            $maximum_amount = 10000;
            $userinfo = userinfo();
            if (!empty($checkuser['user_id'])) {
                if ($request['user_id'] !=  session('user_id')) {
                    if ($transfer_amount >= $minimum_amount && $transfer_amount <= $maximum_amount) {
                        if ($userinfo['master_key'] == $request['txn_password']) {
                            if ($balance['balance'] >= $transfer_amount) {
                                $Debitwallet = array(
                                    'user_id' => session('user_id'),
                                    'amount' => -$transfer_amount,
                                    'sender_id' => session('user_id'),
                                    'receiver_id' => $request['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => 'Fund Transfer To ' . $request['user_id'],
                                );
                                add('tbl_wallet', $Debitwallet);

                                $Crdeitwallet = array(
                                    'user_id' => $request->user_id,
                                    'amount' =>  $transfer_amount,
                                    'sender_id' => session('user_id'),
                                    'type' => 'fund_transfer',
                                    'remark' => 'Fund Transfer From ' . session('user_id'),
                                );
                                add('tbl_wallet', $Crdeitwallet);
                                return flashdata('wallet-transfer', $message, 'Fund Transfer Successfully', 'success');
                            } else {
                                return flashdata('wallet-transfer', $message, 'Insuffcient Balance', 'info');
                            }
                        } else {
                            return flashdata('wallet-transfer', $message, 'Incorrect Transaction Password', 'danger');
                        }
                    } else {
                        return flashdata('wallet-transfer', $message, 'Minimum Transfer Amount is ' . currency . $minimum_amount . '   and Maximum  ' . currency . $maximum_amount, 'danger');
                    }
                } else {
                    return flashdata('wallet-transfer', $message, 'Cannot Transfer as same amount !', 'danger');
                }
            } else {
                return flashdata('wallet-transfer', $message, 'Invalid User', 'danger');
            }
        }

        $response['message'] = $message;

        return userView('forms', $response);
    }
}
