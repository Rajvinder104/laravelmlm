<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super_model;

class UserManageController extends Controller
{
    /********************************************************  __construct *************************************************/

    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }



    /********************************************************  index *************************************************/
    public function index()
    {
        $response['wallet_balance'] = get_single_record('tbl_wallet', ['user_id' => session('user_id')], 'ifnull(sum(amount),0) as wallet_balance');
        $response['total_income'] = get_single_record('tbl_income_wallet',  ['user_id' => session('user_id'), ['amount', '>', 0], ['type', '!=', 'withdraw_request']], 'ifnull(sum(amount),0) as total_income');
        $response['Paidteam'] =   $this->supermodel->totalTeam(session('user_id'), 1);
        $response['UnPaidteam'] = $this->supermodel->totalTeam(session('user_id'), 0);
        $response['popup'] = get_single_record('tbl_popup', [], '*');
        $response['news'] = get_records('news', [], '*');
        return userView('userdashboard', $response);
    }



    /********************************************************  Tree *************************************************/
    public function Tree($user_id)
    {
        $response = [];
        $response['header'] = 'Direct Referral Tree';
        $response['user'] = get_single_record('users', ['user_id' => $user_id], '*');
        $response['users'] = get_records('users', ['sponsor' => $user_id], '*');
        foreach ($response['users'] as $key => $directs) {
            $subDirects = get_records('users', ['sponsor' => $directs->user_id], '*');
            $response['users'][$key]->sub_directs = $subDirects;
        }
        return userView('tree', $response);
    }
}
