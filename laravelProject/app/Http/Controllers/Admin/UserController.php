<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\Helper\Encrypt as EnCrypt;

class UserController extends Controller
{
    /***************************************************** supportview ******************************************************/
    public function Allusers(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $export = $request->input('export');

        if ($search) {
            $where = [$type => $search];
        } else {
            $where = [];
        }

        $records = get_limit_records('users', $where, '*', 10);
        $response['header'] = 'ALL USERS DETAIL';

        if ($export) {
            return $this->exportAllusers($records, $export, $response['header']);
        }
        $response['path'] = route('admin/AllUsers');
        $response['users'] = $records;
        $response['field'] = '  <div class="form-group search-field d-flex">
                                    <div class="col-4">
                                        <select class="form-control" name="type">
                                            <option value="user_id" ' . ($type == "user_id" ? "selected" : "") . '>User Id</option>
                                            <option value="email" ' . ($type == "email" ? "selected" : "") . '>Email</option>
                                        </select>
                                    </div>
                                    <input type="text" name="search" class="form-control text-dark float-right" value="' . $search . '" placeholder="How can we help?">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th>Sponser Id</th>
                                <th>Package Amount</th>
                                <th>TXN Pin</th>
                                <th>E-Mail</th>
                                <th>E-Wallet</th>
                                <th>Income</th>
                                <th>Status</th>
                                <th>Joining Date</th>
                            </tr>';

        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $userId = EnCrypt::encrypt($user->user_id);
            $btn_disabled = '<button class="blockUser btn-xs btn btn-' . ($user->disabled == 0 ? "danger" : "primary") . '" data-status="' . ($user->disabled == 0 ? "1" : "0") . '" data-user_id="' . $user->user_id . '">' . ($user->disabled == 0 ? "Block" : " UnBlock") . '</button> ';
            $login = '<a class="btn btn-info btn-xs" href="' . route('userLogin', ['user_id' => $userId]) . '" target="_blank">Login</a>';
            $edit = '<a class="btn btn-warning btn-xs" href="' . route('admin.EditUser', ['user_id' => $userId]) . '" target="_blank">Edit</a>';
            $wallet_balance = get_single_record('tbl_wallet', ['user_id' => $user->user_id], 'ifnull(sum(amount),0) as balance');
            $Total_income = get_single_record('tbl_income_wallet', ['user_id' => $user->user_id, ['amount', '>', 0], ['type', '!=', 'withdraw_request']], 'ifnull(sum(amount),0) as balance');
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $login . '' . $btn_disabled . '' . $edit . '</td>
                                <td>' . $user->name . '</td>
                                <td>' . $user->user_id . '</td>
                                <td>' . $user->sponsor . '</td>
                                <td>' . currency . number_format($user->package_amount, 2) . '</td>
                                <td>' . $user->master_key . '</td>
                                <td>' . $user->email . '</td>
                                <td>' . currency . number_format($wallet_balance['balance'], 2) . '</td>
                                <td>' . currency . number_format($Total_income['balance'], 2) . '</td>
                                <td>' . ($user->paid_status == 1 ? '<span class="badge bg-success btn-xs">Active</span>' : '<span class="badge bg-danger btn-xs">Inactive</span>') . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }
        $response['export'] = true;
        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }

    /********************** Allusers Export *************************************************/
    private function exportAllusers($records, $exportType, $filename)
    {
        $application_type = 'application/' . $exportType;
        $header = ['#', 'User ID', 'Name', 'Phone', 'Email', 'Transaction Pin', 'Sponsor ID', 'Package', 'E-wallet', 'Income', 'Joining Date'];
        $fileheader = $filename;
        $records_export = [];
        foreach ($records as $key => $rec) {
            $e_wallet = get_single_record('tbl_wallet', ['user_id' => $rec->user_id], 'ifnull(sum(amount),0) as e_wallet');
            $income_wallet = get_single_record('tbl_income_wallet', ['user_id' => $rec->user_id], 'ifnull(sum(amount),0) as income_wallet');
            $records_export[$key] = [
                'i' => $key + 1,
                'user_id' => $rec->user_id,
                'name' => $rec->name,
                'phone' => $rec->phone,
                'email' => $rec->email,
                'master_key' => $rec->master_key,
                'sponsor' => $rec->sponsor,
                'package_amount' => $rec->package_amount,
                'e_wallet' => $e_wallet['e_wallet'],
                'income_wallet' => $income_wallet['income_wallet'],
                'created_at' => $rec->created_at,
            ];
        }
        return finalExport($exportType, $application_type, $header, $records_export, $fileheader);
    }



    /********************************************************  Today Join Members *************************************************/
    public function todayJoin(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        $today = now()->toDateString();

        $where = [['created_at', '>=', $today . ' 00:00:00'], ['created_at', '<=', $today . ' 23:59:59']];

        if ($search) {
            $where[] = [$type, $search];
        }
        $records = get_limit_records('users', $where, '*', 10);
        $response['header'] = 'TODAY JOIN USERS';
        $response['path'] = route('Today-Join');
        $response['users'] = $records;
        $response['field'] = '  <div class="form-group search-field d-flex">
                                    <div class="col-4">
                                        <select class="form-control" name="type">
                                            <option value="user_id" ' . $type . ' == "user_id" ? "selected" : "";?>User Id</option>
                                            <option value="email" ' . $type . ' == "email" ? "selected" : "";?>Email</option>
                                        </select>
                                    </div>
                                    <input type="text" name="search" class="form-control text-dark float-right"
                                        search="' . $search . '" placeholder="How can we help?">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th>E-Mail</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $userId = EnCrypt::encrypt($user->user_id);
            $btn_disabled = '<button class="blockUser btn-xs btn btn-' . ($user->disabled == 0 ? "danger" : "primary") . '" data-status="' . ($user->disabled == 0 ? "1" : "0") . '" data-user_id="' . $user->user_id . '">' . ($user->disabled == 0 ? "Block" : " UnBlock") . '</button> ';
            $login = '<a class="btn btn-info btn-xs"  href="' . route('userLogin', ['user_id' => $userId]) . '" target="_blank">Login</a>';
            $edit = '<a class=" btn btn-warning btn-xs"  href="' . route('admin.EditUser', ['user_id' => $userId]) . '" target="_blank">Edit</a>';
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <div><td colspan="1"> ' . $login . '' . $btn_disabled . '' . $edit . '</td></div>
                                <td>' . $user->name . '</td>
                                <td>' . $user->user_id . '</td>
                                <td>' . $user->email . '</td>
                               <td>' . ($user->paid_status == 1 ? '<span class="badge bg-success btn-xs">Active</span>' : '<span class="badge bg-warning btn-xs">Inactive</span>') . '</td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }



    /***************************************************** incomes ******************************************************/
    public function incomes(Request $request, $type = '')
    {
        $search = $request->input('search');
        $types = $request->input('type');
        $where = ['type' => $type];

        if ($search) {
            $where[] = [$types, $search];
        }
        $records = get_limit_records('tbl_income_wallet', $where, '*', 10);
        $response['header'] = ucwords(str_replace('_', ' ', $type));
        $response['path'] = route('income', ['type' => $type]);
        $response['users'] = $records;
        $response['field'] = '  <div class="form-group search-field d-flex">
                                    <div class="col-4">
                                        <select class="form-control" name="type">
                                            <option value="user_id" ' . $types . ' == "user_id" ? "selected" : "";?>User Id</option>
                                        </select>
                                    </div>
                                    <input type="text" name="search" class="form-control text-dark float-right"
                                        search="' . $search . '" placeholder="How can we help?">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User Id</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Remark</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->user_id . '</td>
                                <td>' . currency . $user->amount . '</td>
                                <td>' . str_replace('_', ' ', ucwords($type)) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }
}
