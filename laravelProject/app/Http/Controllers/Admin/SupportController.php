<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\FormHelper as Form;

class SupportController extends Controller
{
    /***************************************************** Support ******************************************************/
    public function Support(Request $request)
    {
        $message = 'Send-Mail';
        $response['header'] = 'Send-Mail';
        $response['title'] = 'Send-Mail';
        $response['form_open'] = Form::open(route('support'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'user_id' => Form::label('User ID', '', ['class' => 'form-label']) .
                Form::text('user_id', old('user_id', ''), ['class' => 'form-control', 'placeholder' => 'User ID', 'id' => 'user_id', 'onkeyup' => "getName()"]),
            '<span id="userName" ></span>',
            'title' => Form::label('Title', '', ['class' => 'form-label']) .
                Form::text('title', old('title', ''), ['class' => 'form-control', 'placeholder' => 'Title']),
            'message' => Form::label('Message', '', ['class' => 'form-label']) .
                Form::textarea('message', old('message', ''), ['class' => 'form-control', 'placeholder' => 'Message']),
            'image' => Form::label('Image', 'image', ['class' => 'form-label']) .
                Form::file('image', old('message', ''), ['class' => 'form-control', 'placeholder' => 'Image']),
        ];
        $response['form_close'] = Form::close();
        $response['form_button'] = [
            Form::submit('Submit', ['class' => 'btn btn-primary mt-3'])
        ];
        if (request()->isMethod('post')) {
            $credentials = $request->validate([
                'user_id' => 'required',
                'title' => 'required',
                'message' => 'required',
                'image' => 'required',
            ]);
            $checkID = get_single_record('users', ['user_id' => $credentials['user_id']], 'user_id');
            $file = $request->file('image');
            $filePath = $file->store('uploads', 'public');
            if (!empty($checkID)) {
                $add = [
                    'image' => $filePath,
                    'user_id' => 'Admin',
                    'reciever_id' => $credentials['user_id'],
                    'title' => $credentials['title'],
                    'message' => $credentials['message']
                ];

                $AddData = add('support_message', $add);
                if ($AddData) {
                    return flashdata('support', $message, 'Mail Send Successfully', 'success');
                } else {
                    return flashdata('support', $message, 'Something Went Wrong', 'danger');
                }
            } else {
                return flashdata('support', $message, 'User Not Found', 'danger');
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }



    /***************************************************** Inbox ******************************************************/
    public function Inbox()
    {
        $records = get_limit_records('support_message', [['user_id', '!=', 'Admin']], '*', 10);
        $response['header'] = 'Inbox Mail Report';
        $response['path'] = route('Inbox-Report');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $btn = '<a href="' . route('mail_verify', ['id' => $user->id]) . '" class="btn btn-primary btn-xs">view</a>';
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->user_id . '</td>
                                <td>' . $user->title . '</td>
                                <td>' . $user->message . '</td>
                                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                                <td>' .  ($user->status == 1 ? '<span class="badge bg-success btn-xs">Approved</span>'  : ($user->status == 0  ? '<span class="badge bg-warning btn-xs">Pending</span>' : '<span class="badge bg-danger btn-xs">Rejected</span>')) . '</td>
                                <td>' . $btn . '</td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }



    /***************************************************** Outbox ******************************************************/
    public function Outbox()
    {
        $records = get_limit_records('support_message', [['user_id', '=', 'Admin']], '*', 10);
        $response['header'] = 'Outbox Mail Report';
        $response['path'] = route('Outbox-Report');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>

                                <th>Reciver ID</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Image</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>

                                <td>' . $user->reciever_id . '</td>
                                <td>' . $user->title . '</td>
                                <td>' . $user->message . '</td>
                                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return adminView('reports', $response);
    }


    /***************************************************** supportview ******************************************************/
    public function supportview(Request $req, $id)
    {
        $message = 'Mail_Details';
        $users = get_single_record('support_message', ['id' => $id], '*');
        $response['header'] = 'Mail Details For Verify';
        $response['form_open'] = Form::open(route('mail_verify', ['id' => $id]), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'title' => Form::label('Title', '', ['class' => 'form-label']) .
                Form::text('title', $users['title'], ['class' => 'form-control', 'placeholder' => 'Title']),
            'message' => Form::label('Message', '', ['class' => 'form-label']) .
                Form::textarea('message', $users['message'], ['class' => 'form-control', 'placeholder' => 'Message']),
            'status' => Form::label('Status', '', ['class' => 'form-label']) .
                Form::dropdown('status', [1 => 'Approved', 2 => 'Reject'], '', ['class' => 'form-control']),
            'remark' => Form::label('Remark', '', ['class' => 'form-label']) .
                Form::text('remark', $users['remark'], ['class' => 'form-control', 'placeholder' => 'Remark']),
        ];
        $response['form_close'] = Form::close();
        $response['form_button'] = [
            Form::submit('Update', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $credentials = $req->validate([

                'title' => 'required',
                'message' => 'required',
                'status' => 'required',
                'remark' => 'required',
            ]);

            $updatedata = [
                'status' => $credentials['status'],
                'remark' => $credentials['remark'],
            ];

            $AddData = update_data('support_message', ['id' => $id], $updatedata);
            if ($AddData) {
                return flashdata('mail_verify', $message, 'Mail Details Verified Successfully', 'success', $id);
            } else {
                return flashdata('mail_verify',  $message, 'Something Went Wrong', 'danger', $id);
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }
}
