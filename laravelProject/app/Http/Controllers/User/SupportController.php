<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\FormHelper as Form;

class SupportController extends Controller
{
    /*************************************************  Compose_mail ******************************************************/
    public function Compose_mail(Request $request)
    {
        $message = 'Send-Mail';
        $response['header'] = 'Send-Mail';
        $response['title'] = 'Send-Mail';
        $response['form_open'] = Form::open(route('user-support'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'title' => Form::label('Title', '', ['class' => 'form-label']) .
                Form::text('title', old('title', ''), ['class' => 'form-control', 'placeholder' => 'Title']),
            'message' => Form::label('Message', '', ['class' => 'form-label']) .
                Form::textarea('message', old('message', ''), ['class' => 'form-control', 'placeholder' => 'Message']),
            'image' => Form::label('Image', 'image', ['class' => 'form-label']) .
                Form::file('image', old('message', ''), ['class' => 'form-control', 'placeholder' => 'Image']),
        ];
        $response['form_button'] = Form::submit('Submit', ['class' => 'btn btn-warning mt-3', 'id' => 'submit', 'style' => 'display: block;']);

        if (request()->isMethod('post')) {
            $credentials = $request->validate([
                'title' => 'required',
                'message' => 'required',
                'image' => 'required',
            ]);

            $file = $request->file('image');
            $filePath = $file->store('uploads', 'public');

            $add = [
                'image' => $filePath,
                'user_id' => session('user_id'),
                'title' => $credentials['title'],
                'message' => $credentials['message']
            ];

            $AddData = add('support_message', $add);
            if ($AddData) {
                flashdata('user-support', $message, 'Mail Send Successfully', 'success');
                return redirect('user-support');
            } else {
                flashdata('user-support', $message, 'Something Went Wrong', 'danger');
                return redirect('user-support');
            }
        }
        $response['message'] = $message;
        $response['extra_header'] = false;
        return userView('forms', $response);
    }



    /*************************************************  Inbox ******************************************************/
    public function Inbox()
    {
        $records = get_limit_records('support_message', [['user_id', '=', 'Admin'], 'reciever_id' => session('user_id')], '*', 10);
        $response['header'] = 'Inbox Mail Report';
        $response['path'] = route('user-inbox-report');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>From</th>
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
                                <td>' . $user->user_id . '</td>
                                <td>' . $user->title . '</td>
                                <td>' . $user->message . '</td>
                                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }



    /*************************************************  Outbox ******************************************************/
    public function Outbox()
    {
        $records = get_limit_records('support_message', ['user_id' => session('user_id')], '*', 1);
        $response['header'] = 'Outbox Mail Report';
        $response['path'] = route('user-outbox-report');
        $response['users'] = $records;
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>';
        $tbody = [];
        $i = $records->firstitem();
        foreach ($records as $key => $user) {
            $tbody[$key] = '<tr>
                                <td>' . $i . '</td>
                                <td>' . $user->title . '</td>
                                <td>' . $user->message . '</td>
                                <td><img src="' . asset('storage/' . $user->image) . '" alt="attachment" style="width: 100px; height: 100px;" class="img-thumbnail"></td>
                                <td>' .  ($user->status == 1 ? '<span class="badge bg-success btn-xs">Approved</span>'  : ($user->status == 0  ? '<span class="badge bg-warning btn-xs">Pending</span>' : '<span class="badge bg-danger btn-xs">Rejected</span>')) . '</td>
                                <td>' . $user->created_at . '</td>
                            </tr>';
            $i++;
        }

        $response['tbody'] = $tbody;
        return userView('reports', $response);
    }
}
