<?php

/*********************************************************** tbl_addActivation *************************************************/
if (!function_exists('tbl_addActivation')) {
    function tbl_addActivation($user_id, $amount)
    {
        $user = get_single_record('users', ['user_id' => $user_id], 'user_id,package_amount');
        $addData = [
            'user_id' => $user_id,
            'package' => $amount,
            'activater' => session('user_id'),
            'type' => $user['package_amount'] == 0 ? 'activation' : 'upgradation',
        ];
        add('tbl_activation_details', $addData);
    }
}



/*********************************************************** tbl_walletAdd *************************************************/
if (!function_exists('tbl_walletAdd')) {
    function tbl_walletAdd($user_id, $amount)
    {
        $sendWallet = [
            'user_id' => session('user_id'),
            'amount' => -$amount,
            'type' => 'account_activation',
            'remark' => 'Account Activation Deduction for ' . $user_id,
        ];
        add('tbl_wallet', $sendWallet);
    }
}


/*********************************************************** tbl_usersupdate *************************************************/
if (!function_exists('tbl_usersupdate')) {
    function tbl_usersupdate($user_id, $amount)
    {
        $user = get_single_record('users', ['user_id' => $user_id], '*');
        $userUpdate = [
            'topup_date' =>  date('Y-m-d H:i:s'),
            'package_id' => $user['package_id'] + 1,
            'package_amount' => $amount,
            'total_package' => $user['total_package'] + $amount,
            'paid_status' => 1,
        ];
        update_data('users', ['user_id' => $user_id], $userUpdate);
    }
}


/*********************************************************** add_direct_Income *************************************************/
if (!function_exists('add_direct_Income')) {
    function add_direct_Income($user_id, $amount, $type, $remark)
    {
        $user = get_single_record('users', ['user_id' => $user_id], 'incomes,paid_status');
        if ($user['paid_status'] == 1) {
            if (incomeLimit == 0) {
                $addData = [
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'type' => $type,
                    'remark' => $remark
                ];
                $res =  add('tbl_income_wallet', $addData);
                if ($res) {
                    $updateIncome = json_decode($user['incomes'], true);
                    $updateIncome[$type] += $amount;
                    $endcodeIncome = json_encode($updateIncome);
                    $userUpdate = [
                        'incomes' => ($updateIncome),
                    ];
                    $users = update_data('users', ['user_id' => $user_id], $userUpdate);
                }
            } else {
                $addData = [
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'type' => $type,
                    'remark' => $remark
                ];
                $res =  add('tbl_income_wallet', $addData);
                if ($res) {
                    $updateIncome[$type] = $amount;
                    $userUpdate = [
                        'incomes' => $updateIncome,
                    ];
                    $users = update_data('users', ['user_id' => $user_id], $userUpdate);
                }
            }
        }
    }
}
