<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{

    /********************************************************  Direct_Income_Withdraw_Wallet *************************************************/
    public function Direct_Income_Withdraw_Wallet(Request $request)
    {
        $message = 'Withdraw';
        $resposnse['header'] = 'Direct Income Withdraw';
        $response['user'] = get_single_record('users', array('user_id' => session('user_id')), '*');
        $resposnse['balance'] = get_single_record('tbl_income_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
        $response['tokenValue'] = get_single_record('tbl_token_value', ['id' => 1], 'amount');

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                // 'amount' => 'required|numeric|min:' . min_withdraw . '|max:' . max_withdraw,
                'amount' => 'required|numeric',
                'master_key' => 'required',
                'wallet_address' => 'required|string',
            ]);

            $todayWithdraw = get_single_record('tbl_withdraw', ['user_id' => session('user_id'),], '*', true);
            $withdraw_amount = abs($request->amount);
            $master_key = $request->master_key;
            $balance = get_single_record('tbl_income_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');

            if (empty($todayWithdraw)) {
                if ($withdraw_amount >= min_withdraw && $withdraw_amount <= max_withdraw) {
                    if ($withdraw_amount % multiple_withdraw == 0) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($response['user']['master_key'] == $master_key) {
                                $DirectIncome = array(
                                    'user_id' => session('user_id'),
                                    'amount' => -$withdraw_amount,
                                    'type' => 'withdraw_request',
                                    'remark' => 'Withdrawal Amount ',
                                    'dollar' => $withdraw_amount,
                                    'token_price' => $response['tokenValue']['amount'],
                                );
                                $AddData = add('tbl_income_wallet', $DirectIncome);
                                $withdrawArr = array(
                                    'user_id' => session('user_id'),
                                    'amount' => $withdraw_amount,
                                    'type' => 'withdraw_request',
                                    'admin_charges' => $withdraw_amount * withdraw_charges / 100,
                                    'payable_amount' => ($withdraw_amount - ($withdraw_amount * withdraw_charges / 100)),
                                    'credit_type' => 'Wallet',
                                );
                                $AddData = add('tbl_withdraw', $withdrawArr);
                                if ($AddData) {
                                    flashdata('withdraw', $message, 'Withdraw Requested Successfully', 'success');
                                } else {
                                    flashdata('withdraw', $message, 'Something Went Wrong', 'danger');
                                }
                            } else {
                                flashdata('withdraw', $message, 'Invalid Master Key', 'danger');
                            }
                        } else {
                            flashdata('withdraw', $message, 'Insuffcient Balance', 'info');
                        }
                    } else {
                        flashdata('withdraw', $message, 'Multiple Withdraw Amount is ' . multiple_withdraw, 'danger');
                    }
                } else {
                    flashdata('withdraw', $message, 'Minimum Withdrawal Amount is ' . currency . min_withdraw . ' and Maximum ' . currency . max_withdraw, 'danger');
                }
            } else {
                flashdata('withdraw', $message, 'You can only withdraw once a day. Please try again tomorrow.', 'danger');
            }
        }

        $resposnse['message'] = $message;

        return userView('withdraw', $resposnse);
    }




    /********************************************************  Direct_Withdraw_Bank *************************************************/
    public function Direct_Withdraw_Bank(Request $request)
    {
        $message = 'Withdraw';
        $resposnse['header'] = 'Direct Withdraw Bank';
        $response['user'] = get_single_record('users', array('user_id' => session('user_id')), '*');
        $resposnse['balance'] = get_single_record('tbl_income_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
        $response['tokenValue'] = get_single_record('tbl_token_value', ['id' => 1], 'amount');

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                // 'amount' => 'required|numeric|min:' . min_withdraw . '|max:' . max_withdraw,
                'amount' => 'required|numeric',
                'master_key' => 'required',
            ]);

            $todayWithdraw = get_single_record('tbl_withdraw', ['user_id' => session('user_id'), ['created_at', '=', date('Y-m-d')]], '*');
            $withdraw_amount = abs($request->amount);
            $master_key = $request->master_key;
            $balance = get_single_record('tbl_income_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as balance');
            $max_withdraw = $response['user']['package_amount'] * 0.5; // jekar package dye hisab nal withdraw fix karna hove
            if (empty($todayWithdraw)) {
                if ($withdraw_amount >= min_withdraw && $withdraw_amount <= max_withdraw) {
                    if ($withdraw_amount % multiple_withdraw == 0) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($response['user']['master_key'] == $master_key) {
                                $DirectIncome = array(
                                    'user_id' => session('user_id'),
                                    'amount' => -$withdraw_amount,
                                    'type' => 'withdraw_request',
                                    'remark' => 'Withdrawal Amount '
                                );
                                $AddData = add('tbl_income_wallet', $DirectIncome);
                                $withdrawArr = array(
                                    'user_id' => session('user_id'),
                                    'amount' => $withdraw_amount,
                                    'type' => 'withdraw_request',
                                    'admin_charges' => $withdraw_amount * withdraw_charges / 100,
                                    'payable_amount' => ($withdraw_amount - ($withdraw_amount * withdraw_charges / 100)),
                                    'credit_type' => 'Bank',
                                );
                                $AddData = add('tbl_withdraw', $withdrawArr);
                                if ($AddData) {
                                    flashdata('withdraw', $message, 'Withdraw Requested Successfully', 'success');
                                } else {
                                    flashdata('withdraw', $message, 'Something Went Wrong', 'danger');
                                }
                            } else {
                                flashdata('withdraw', $message, 'Invalid Master Key', 'danger');
                            }
                        } else {
                            flashdata('withdraw', $message, 'Insuffcient Balance', 'info');
                        }
                    } else {
                        flashdata('withdraw', $message, 'Multiple Withdraw Amount is ' . multiple_withdraw, 'danger');
                    }
                } else {
                    flashdata('withdraw', $message, 'Minimum Withdrawal Amount is ' . currency . min_withdraw . ' and Maximum ' . currency . max_withdraw, 'danger');
                }
            } else {
                flashdata('withdraw', $message, 'You can only withdraw once a day. Please try again tomorrow.', 'danger');
            }
        }

        $resposnse['message'] = $message;

        return userView('withdraw', $resposnse);
    }
}
