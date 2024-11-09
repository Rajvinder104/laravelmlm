<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super_model;

class ReportsController extends Controller
{
    /********************************************************  __construct *************************************************/
    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }



    /********************************************************  Activation_History *************************************************/
    public function Activation_History()
    {
        $records = get_limit_records('tbl_activation_details', [['activater', '=', session('user_id')]], '*', 10);
        $response['header'] = 'Activation History';
        $response['path'] = route('activation_history');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Activator</th>
                                <th>Package</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>

                                <td>' . $user->user_id . '</td>
                                <td>' . $user->activater . '</td>
                                <td>' . currency . $user->package . '</td>
                                <td>' . $user->type . '</td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  My_directs ******************************************************/
    public function My_directs()
    {
        $records = get_limit_records('users', ['sponsor' => session('user_id')], '*', 10);
        $response['header'] = 'My Directs';
        $response['path'] = route('my_directs');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->user_id . '</td>
                                <td>' . $user->name . '</td>
                                <td>' . $user->package_amount . '</td>
                                <td>' . ($user->paid_status > 0 ? badge_success('Active') : badge_danger('Inactive')) . '</td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  My_downline_team ******************************************************/
    public function My_downline_team()
    {
        $records = get_limit_records('sponsor_count', ['user_id' => session('user_id')], '*', 10);
        $response['header'] = 'My Downline Team';
        $response['path'] = route('my-downline-team');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Downline Id</th>
                                <th>Name</th>
                                <th>Package</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {

            $userdata = get_single_record('users', ['user_id' => $user->downline], '*');
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->downline . '</td>
                                <td>' . $userdata['name'] . '</td>
                                <td>' . currency . $userdata['package_amount'] . '</td>
                                <td>' . $user->level . '</td>
                                <td>' . ($userdata['paid_status']  > 0 ? badge_success('Active') : badge_danger('Inactive')) . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  incomes ******************************************************/
    public function incomes($type = '')
    {

        $where = ['user_id' => session('user_id'), 'type' => $type];
        $records = get_limit_records('tbl_income_wallet', $where, '*', 10);
        $response['header'] = ucwords(str_replace('_', ' ', $type));
        $response['path'] = route('userincome', ['type' => $type]);
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Remark</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . currency . $user->amount . '</td>
                                <td>' . ($type > 0 ? badge_success('Credit') : badge_danger('Debit')) . '</td>
                                <td>' . str_replace('_', ' ', ucwords($type)) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }




    /*************************************************  fund_request_history ******************************************************/
    public function fund_request_history()
    {
        $records = get_limit_records('tbl_payment_request', ['user_id' => session('user_id')], '*', 10);
        $response['header'] = 'Fund Request History';
        $response['path'] = route('fund_history');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . currency . $user->amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ',  $user->type)) . '</td>
                                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') : ($user->status == 2 ? badge_danger('Rejected') : badge_info('Fund')))) . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  Wallet_ledger ******************************************************/
    public function Wallet_ledger()
    {
        $records = get_limit_records('tbl_wallet', ['user_id' => session('user_id')], '*', 10);
        $response['header'] = 'Wallet Ledger';
        $response['path'] = route('wallet_ledger');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Remark</th>
                            <th>Created At</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>'  . currency . $user->amount . '</td>
                               <td>' . ($user->amount > 0 ? badge_success('Credit') : badge_danger('Debit')) . '</td>
                                <td>' . ucwords(str_replace('_', ' ',  $user->type)) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  Withdraw_history ******************************************************/
    public function Withdraw_history()
    {
        $records = get_limit_records('tbl_withdraw', ['user_id' => session('user_id')], '*', 10);
        $response['header'] = 'Withdraw History';
        $response['path'] = route('withdraw_history');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Payable Amount</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Remark</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . currency . $user->amount . '</td>
                                <td>' . currency . $user->payable_amount . '</td>
                                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') : ($user->status == 2 ? badge_danger('Rejected') : badge_info('Withdraw')))) . '</td>
                                <td>' . ucwords(str_replace('_', ' ',  $user->type)) . '</td>
                                <td>' . ($user->remark ? $user->remark : 'Your Withdraw Request is in Progress – Stay Tuned!') . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  level Wise report ******************************************************/
    public function levelreport()
    {
        $records = $this->supermodel->grouped_by_level('sponsor_count', ['user_id' => session('user_id')], 10);
        $response['header'] = 'Level Report';
        $response['path'] = route('levelreport');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Level</th>
                                <th>Count Ids</th>
                                <th>Active</th>
                                <th>Inactive</th>
                                <th>Action</th>

                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $active_active = $this->supermodel->calculateTeamLevel(session('user_id'), 1, $user->level);
            $inactive_user = $this->supermodel->calculateTeamLevel(session('user_id'), 0, $user->level);
            $users = '<a href="' . route('level-wise-users', ['level' => $user->level]) . '" class="btn btn-info">view</a>';
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>'  . $user->level . '</td>
                                <td>'  . $user->total . '</td>
                                <td>'  . $active_active->team . '</td>
                                <td>'  . $inactive_user->team . '</td>
                                <td>'  . $users . '</td>

                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }


    /*************************************************  level Wise users     ******************************************************/
    public function level_users($level)
    {
        $records = get_limit_records('sponsor_count', ['user_id' => session('user_id'), 'level' => $level], '*', 10);
        $response['header'] =   'Level ' . '<span class="text-info">' . $level . '</span>' . ' Users';
        $response['path'] = route('level-wise-users', ['level' => $level]);
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Downline Id</th>
                                <th>Name</th>
                                <th>Package Amount</th>
                                <th>level</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $status = get_single_record('users', ['user_id' => $user->downline], '*');
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->downline . '</td>
                                <td>' . $status['name'] . '</td>
                                <td>' . currency . $status['package_amount'] . '</td>
                                <td>' . $user->level . '</td>
                                <td>' . ($status['paid_status'] == 0 ? badge_danger('Inactive') : badge_success('Active')) . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }
}
