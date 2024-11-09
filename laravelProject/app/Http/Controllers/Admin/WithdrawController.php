<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\Encrypt as EnCrypt;
use App\Providers\Helper\FormHelper as Form;

class WithdrawController extends Controller
{
    /********************************************************  Withdraw_history *************************************************/
    public function Withdraw_history(Request $request, $status)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        if ($status  == 'pending') {
            $response['header'] = ' Pending Withdraw Request';
            $where = ['status' => 0];
        } elseif ($status == 'approved') {
            $response['header'] = 'Approved Withdraw  Request';
            $where = ['status' => 1];
        } elseif ($status == 'rejected') {
            $response['header'] =  ' Rejected Withdraw  Request';
            $where = ['status' => 2];
        } elseif ($status == 'allrequest') {
            $where = ['status' => 0];
            $response['header'] = 'All Withdraw Request';
            $where = [];
        } else {
            $response['header'] = 'Withdraw Request';
            $where = [];
        }

        if ($search) {
            if ($status  == 'pending') {
                $where = ['status' => 0, $type => $search];
            } elseif ($status == 'approved') {
                $where = ['status' => 1, $type => $search];
            } elseif ($status == 'rejected') {
                $where = ['status' => 2, $type => $search];
            } elseif ($status == 'allrequest') {
                $where = [$type => $search];
            } else {
                $where = [$type => $search];
            }
        }
        $records = get_limit_records('tbl_withdraw', $where, '*', 10);
        $response['path'] = route('withdrawhistory', ['status' => $status]);

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
         <button type="submit" class="btn btn-primary btn-xs"">Search</button>
               </div>';


        if ($status == 'pending' || $status == 'allrequest') {
            $response['thead'] = '<tr>
        <th>#</th>
        <th>User Id</th>
        <th> Name</th>
        <th> Phone</th>
        <th>Amount</th>
        <th>Payable Amount</th>
        <th>Type</th>
        <th>Status</th>
        <th>Remark</th>
        <th>Date</th>
        <th>Action</th>
        </tr>';
        } else {
            $response['thead'] = '<tr>
        <th>#</th>
        <th>User Id</th>
        <th> Name</th>
        <th> Phone</th>
        <th>Amount</th>
        <th>Payable Amount</th>
        <th>Type</th>
        <th>Status</th>
        <th>Remark</th>
        <th>Date</th>
    </tr>';
        }
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $btn = '<a href="' . route('withdrawverify', ['id' => $user->id]) . '" class="btn btn-secondary btn-xs">Edit</a>';
            $userdetails = get_single_record('users', ['user_id' => $user->user_id], 'name,phone,eth_address');

            if ($status == 'pending' || $status == 'allrequest') {
                $tbody[$key] = '<tr>
                <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $userdetails['name'] . '</td>
                <td>' . $userdetails['phone'] . '</td>
                <td>' . currency . $user->amount . '</td>
                <td>' . currency . $user->payable_amount . '</td>
                <td>' . ucwords(str_replace('_', ' ', $user->type)) . '</td>
                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>
                <td>' . ($user->remark ?  $user->remark : 'Withdraw Request is on its Way!') . '</td>
                <td>' . formatDate($user->created_at) . '</td>
                <td>' . ($user->status == 0 ? $btn : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>


            </tr>';
            } else {
                $tbody[$key] = '<tr>
                   <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $userdetails['name'] . '</td>
                <td>' . $userdetails['phone'] . '</td>
                <td>' . currency . $user->amount . '</td>
                <td>' . currency . $user->payable_amount . '</td>
                <td>' . ucwords(str_replace('_', ' ', $user->type))  . '</td>
                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>
                <td>' . ($user->remark ?  $user->remark : 'Withdraw Request is on its Way!') . '</td>
                <td>' . formatDate($user->created_at) . '</td>
            </tr>';
            }
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }



    /*********************************************************** withdraw_verify *************************************************/
    public function withdraw_verify(Request $request, $id)
    {
        $response = [];
        $message = 'withdraw-verify';
        $response['header'] = 'Withdraw Verification';
        $check = get_single_record('tbl_withdraw', ['id' => $id], '*');
        $response['form_open'] = Form::open(route('withdrawverify', ['id' => $id]), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'user_id' => Form::label('User Id', '', ['class' => 'form-label']) .
                Form::text('user_id', $check['user_id'], ['class' => 'form-control', 'placeholder' => 'User Id', 'readonly' => 'readonly']),
            'amount' => Form::label('Amount', '', ['class' => 'form-label']) .
                Form::text('amount', $check['amount'], ['class' => 'form-control', 'placeholder' => 'Amount', 'readonly' => 'readonly']),
            'remark' => Form::label('Remark', '', ['class' => 'form-label']) .
                Form::text('remark', '', [
                    'class' => 'form-control',
                    'placeholder' => 'Remark'
                ]),
            'status' => Form::label('Withdraw Status', '', ['class' => 'form-label']) .
                Form::dropdown('status', [1 => 'Approved', 2 => 'Reject'], '', ['class' => 'form-control']),
        ];
        $response['form_close'] = Form::close();

        $response['form_button'] = [
            Form::submit('Verify', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $request->validate([
                'user_id' => 'required',
                'amount' => 'required',
                'remark' => 'required',
                'status' => 'required'
            ]);

            if ($check['status'] != 0) {
                return flashdata('withdrawverify', $message, 'This withdraw request already updated!', 'danger', $id);
            } else {
                if ($request['status'] == 1) {
                    $wArr = array(
                        'status' => 1,
                        'remark' => $request['remark'],
                    );
                    $updateData = update_data('tbl_withdraw', ['id' => $id], $wArr);
                    return flashdata('withdrawverify', $message, 'Withdraw Verification Successfully', 'success', $id);
                } elseif ($request['status'] == 2) {
                    $wArr = array(
                        'status' => 2,
                        'remark' => $request['remark'],
                    );
                    $res = update_data('tbl_withdraw', array('id' => $id), $wArr);
                    if ($res) {
                        $productArr = array(
                            'user_id' => $check['user_id'],
                            'amount' => $check['amount'],
                            'type' => $check['type'],
                            'remark' => $request['remark'],
                        );
                        add('tbl_income_wallet', $productArr);
                        return flashdata('withdrawverify', $message, 'Withdraw request rejected!', 'success', $id);
                    }
                }
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }

    /*********************************************************** withdraw_on_off *************************************************/
    public function Withdraw_on_off()
    {
        $message = ' ';
        $status = get_single_record('plan_setting', ['id' => 1], '*');
        if ($status['withdraw_status'] == 0) {
            update_data('plan_setting', ['withdraw_status' => 0], ['withdraw_status' => 1]);
            return flashdata('admin/index', $message, '', ' ');
        } else {
            update_data('plan_setting', ['withdraw_status' => 1], ['withdraw_status' => 0]);
            return flashdata('admin/index', $message, '', ' ');
        }
    }
}
