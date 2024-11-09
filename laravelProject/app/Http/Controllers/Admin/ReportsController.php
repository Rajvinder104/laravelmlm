<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super_model;

class ReportsController extends Controller
{
    /***************************************************** __construct ******************************************************/
    protected $supermodel;

    public function __construct(Super_model $supermodel)
    {
        $this->supermodel = $supermodel;
    }

    /***************************************************** Income Ledgar ******************************************************/
    public function Income_ledgar()
    {
        $records = get_limit_records('tbl_income_wallet', [], '*', 5);
        $response['header'] = 'Income Ledgar';
        $response['path'] = route('income-ledgar');
        $response['users'] = $records;
        $response['field'] = '';
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
            if ($user->amount < 0) {
                $formattedAmount = currency . abs($user->amount);
            } else {
                $formattedAmount = currency . $user->amount;
            }
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>

                                <td>' . $user->user_id . '</td>
                              <td>' .   ($user->amount < 0 ? '-' : '') . $formattedAmount . '</td>
                                 <td>' . ucwords(str_replace('_', ' ', $user->type)) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** payout_summary ******************************************************/
    public function payout_summary()
    {
        $where = [];
        $config_incomes = configArray('incomes');
        $records = $this->supermodel->grouped_by_date('tbl_income_wallet', $where, 10);
        $response['header'] = 'Payout Summary';
        $response['path'] = route('payout_summary');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Date</th>';
        foreach ($config_incomes as $value) {
            $response['thead'] .= '<th>' . $value . '</th>';
        }

        $response['thead'] .= '<th>Total</th>
                                <th>Action</th>
                                </tr>';

        $tbody = [];
        $i = $records->firstitem();

        foreach ($records as $key => $user) {
            $users = '<a href="' . route('date-wise-payout-summary', ['date' => $user->date]) . '" class="btn btn-info">view</a>';

            $incomes = $this->supermodel->get_incomes('tbl_income_wallet', $user->date);
            $calculate = calculate_income($incomes, $config_incomes);

            $tbody[$key]  =  '<tr>
                           <td>' . $i . '</td>
                           <td>' . formatDate($user->date) . '</td>';
            foreach ($config_incomes as $inc_type => $value) {
                $tbody[$key] .= ' <td>' . currency . number_format($calculate[$inc_type], 2) . '</td>';
            }

            $tbody[$key] .= ' <td>' .  currency . number_format($calculate['total_payout'], 2) . '</td>
              <td>' . $users . '</td>
                         </tr>';

            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** Date Wise Payout summary ******************************************************/
    public function Date_wise_payout($date)
    {
        $where = [['created_at', 'LIKE', $date . '%'], ['amount', '>', 0]];
        $records = get_limit_records('tbl_income_wallet',  $where, '*', 5);
        $response['header'] = 'Date Wise Payout Summary';
        $response['path'] = route('date-wise-payout-summary', ['date' => $date]);
        $response['users'] = $records;
        $response['field'] = '';
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
                                 <td>' . currency .  $user->amount . '</td>
                                 <td>' . ucwords(str_replace('_', ' ', $user->type)) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }

    /***************************************************** Admin_Fund_History ******************************************************/
    public function Admin_Fund_History()
    {
        $records = get_limit_records('tbl_wallet', [['sender_id', '=', 'admin']], '*', 10);
        $response['header'] = 'Admin Fund History';
        $response['path'] = route('admin_fund_history');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Created At</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>

                                <td>' . $user->user_id . '</td>
                                <td>' . currency . $user->amount . '</td>
                                <td>' . ($user->amount > 0 ? badge_success('Credit') : badge_danger('Debit')) . '</td>
                                <td>' . $user->remark . '</td>
                                <td>' . formatDate($user->created_at) . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** fund_history ******************************************************/
    public function fund_history(Request $request, $status)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        if ($status  == 'pending') {
            $response['header'] = ' Pending Fund Request';
            $where = ['status' => 0];
        } elseif ($status == 'approved') {
            $response['header'] = 'Approved Fund Request';
            $where = ['status' => 1];
        } elseif ($status == 'rejected') {
            $response['header'] =  ' Rejected Fund Request';
            $where = ['status' => 2];
        } elseif ($status == 'allrequest') {
            $where = ['status' => 0];
            $response['header'] = 'All Fund Request';
            $where = [];
        } else {
            $response['header'] = 'Fund Request';
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
        $records = get_limit_records('tbl_payment_request', $where, '*', 10);
        $response['path'] = route('fundhistory', ['status' => $status]);

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
        <th>Name</th>
        <th>Phone</th>
        <th>Amount</th>
        <th>Image</th>
        <th>Type</th>
        <th>Transaction Id</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>';
        } else {
            $response['thead'] = '<tr>
        <th>#</th>
        <th>User Id</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Amount</th>
        <th>Image</th>
        <th>Type</th>
        <th>Transaction Id</th>
        <th>Status</th>
        <th>Date</th>
    </tr>';
        }
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $btn = '<a href="' . route('update-fund-request', ['id' => $user->id]) . '" class="btn btn-secondary btn-xs">Edit</a>';
            $name = get_single_record('users', ['user_id' => $user->user_id], 'name,phone');
            if ($status == 'pending' || $status == 'allrequest') {
                $tbody[$key] = '<tr>
                <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $name['name'] . '</td>
                <td>' . $name['phone'] . '</td>
                <td>' . currency . $user->amount . '</td>
                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                <td>' . ucwords(str_replace('_', ' ', $user->type)) . '</td>
                <td>' . $user->transaction_id . '</td>
                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>
                <td>' . formatDate($user->created_at) . '</td>
                <td>' . ($user->status == 0 ? $btn : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>


            </tr>';
            } else {
                $tbody[$key] = '<tr>
                <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $name['name'] . '</td>
                <td>' . $name['phone'] . '</td>
                <td>' . currency . $user->amount . '</td>
                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                <td>' . ucwords(str_replace('_', ' ', $user->type)) . '</td>
                <td>' . $user->transaction_id . '</td>
                <td>' . ($user->status == 0 ? badge_warning('Pending') : ($user->status == 1 ? badge_success('Approved') :  badge_danger('Rejected')))  . '</td>
                <td>' . formatDate($user->created_at) . '</td>


            </tr>';
            }
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** ShowNews ******************************************************/
    public function ShowNews()
    {

        $records = get_limit_records('news', [], '*', 10);
        $link = sprintf('<a href="%s" class="btn btn-primary">Add News</a>', route('news-create'));
        $response['header'] = 'NEWS' . $link;
        $response['path'] = route('news');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>News</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            // $btn ='';
            $btn = '<a href="' . route('edit-news', ['id' => $user->id]) . '" class="btn btn-primary btn-sm">Edit</a>';
            $deletebtn = '<a href="' . route('delete-news', ['id' => $user->id]) . '" class="btn btn-danger btn-sm">Delete</a>';

            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->title . '</td>
                                <td>' . $user->news . '</td>
                                <td>' . $user->created_at . '</td>
                                <div class="d-flex justify-content-between" ><td colspan="1" > ' . $btn . '' . $deletebtn . '</td></div>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** kyc_history ******************************************************/
    public function kyc_history(Request $request, $status)
    {
        $search = $request->input('search');
        $type = $request->input('type');
        if ($status  == 'pending') {
            $response['header'] = ' Pending KYC Request';
            $where = ['kyc_status' => 1];
        } elseif ($status == 'approved') {
            $response['header'] = 'Approved KYC  Request';
            $where = ['kyc_status' => 2];
        } elseif ($status == 'rejected') {
            $response['header'] =  ' Rejected KYC  Request';
            $where = ['kyc_status' => 3];
        } elseif ($status == 'allrequest') {
            $where = ['kyc_status' => 0];
            $response['header'] = 'All KYC Request';
            $where = [];
        } else {
            $response['header'] = 'KYC Request';
            $where = [];
        }

        if ($search) {
            if ($status  == 'pending') {
                $where = ['kyc_status' => 1, $type => $search];
            } elseif ($status == 'approved') {
                $where = ['kyc_status' => 2, $type => $search];
            } elseif ($status == 'rejected') {
                $where = ['kyc_status' => 3, $type => $search];
            } elseif ($status == 'allrequest') {
                $where = [$type => $search];
            } else {
                $where = [$type => $search];
            }
        }
        $records = get_limit_records('bank_detail', $where, '*', 10);
        $response['path'] = route('kychistory', ['status' => $status]);

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
        <th>Bank Name</th>
        <th>Bank Account Number</th>
        <th>Account Holder Name</th>
        <th>Branch Address</th>
        <th>IFSC</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>';
        } else {
            $response['thead'] = '<tr>
        <th>#</th>
        <th>User Id</th>
        <th> Name</th>
        <th>Bank Name</th>
        <th>Bank Account Number</th>
        <th>Account Holder Name</th>
        <th>Branch Address</th>
        <th>IFSC</th>
        <th>Status</th>
        <th>Date</th>

    </tr>';
        }
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $btn = '<a href="' . route('kycverify', ['id' => $user->id]) . '" class="btn btn-secondary btn-xs">Edit</a>';
            $name = get_single_record('users', ['user_id' => $user->user_id], 'name');
            if ($status == 'pending' || $status == 'allrequest') {
                $tbody[$key] = '<tr>
                <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $name['name'] . '</td>
                <td>' . $user->bank_name . '</td>
                <td>' . $user->account_number . '</td>
                <td>' . $user->holder_name . '</td>
                <td>' . $user->branch . '</td>
                <td>' . $user->ifsc_code . '</td>
                <td>' . ($user->kyc_status == 1 ? badge_warning('Pending') : ($user->kyc_status == 2 ? badge_success('Approved') : ($user->kyc_status == 3 ? badge_danger('Rejected') : badge_info('Kyc Not Submit'))))  . '</td>
                <td>' . formatDate($user->created_at) . '</td>
                <td>' . ($user->kyc_status == 1 ? $btn : ($user->kyc_status == 2 ? badge_success('Approved') : ($user->kyc_status == 3 ? badge_danger('Rejected') : badge_info('Kyc Not Submit'))))  . '</td>


            </tr>';
            } else {
                $tbody[$key] = '<tr>
                <td>' . $i . '</td>
                <td>' . $user->user_id . '</td>
                <td>' . $name['name'] . '</td>
                <td>' . $user->bank_name . '</td>
                <td>' . $user->account_number . '</td>
                <td>' . $user->holder_name . '</td>
                <td>' . $user->branch . '</td>
                <td>' . $user->ifsc_code . '</td>
                <td>' . ($user->kyc_status == 1 ? badge_warning('Pending') : ($user->kyc_status == 2 ? badge_success('Approved') : ($user->kyc_status == 3 ? badge_danger('Rejected') : badge_info('Kyc Not Submit'))))  . '</td>
                <td>' . formatDate($user->created_at) . '</td>


            </tr>';
            }
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }
}
