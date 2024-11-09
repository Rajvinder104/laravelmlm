<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Helper\Encrypt as EnCrypt;
use App\Providers\Helper\FormHelper as Form;

class SettingsController extends Controller
{
    /***************************************************** EditUser ******************************************************/
    public function EditUser(Request $req, $userId)
    {
        $response = [];
        $userIds = EnCrypt::decrypt($userId);
        $response['user'] = get_single_record('users', ['user_id' => $userIds], '*');
        $response['user_bank'] = get_single_record('bank_detail', ['user_id' => $userIds], '*');

        if ($req->isMethod('post')) {
            if ($req->form_type == 'personal') {
                $credentials = $req->validate([
                    'email' => 'required|email',
                    'name' => 'required|string',
                ]);
                $res = update_data('users', ['user_id' => $userIds], $credentials);

                if ($res) {
                    return redirect()->route('admin.EditUser', $userId)->with('personal', 'Personal Detail Updated Successfully')->with('type', 'success');
                } else {
                    return redirect()->route('admin.EditUser', $userId)->with('personal', 'Update Failed')->with('type', 'danger');
                }
            } elseif ($req->form_type == 'bank_detail') {
                $credentials = $req->validate([
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'branch' => 'required',
                    'ifsc_code' => 'required',
                    'holder_name' => 'required',
                ]);

                $res = update_data('bank_detail', ['user_id' => $userIds], $credentials);

                if ($res) {
                    return redirect()->route('admin.EditUser', $userId)->with('bank_detail', 'Bank Details Updated Successfully')->with('type', 'success');
                } else {
                    return redirect()->route('admin.EditUser', $userId)->with('bank_detail', 'Update Failed')->with('type', 'danger');
                }
            } else {
                $credentials = $req->validate([
                    'password' => 'required',
                ]);

                $update = [
                    'password' => EnCrypt::encrypt($req->password),
                ];

                $res = update_data('users', ['user_id' => $userIds], $update);

                if ($res) {
                    return redirect()->route('admin.EditUser', $userId)->with('password', 'Password Updated Successfully')->with('type', 'success');
                } else {
                    return redirect()->route('admin.EditUser', $userId)->with('password', 'Update Failed')->with('type', 'danger');
                }
            }
        }

        return adminView('editUser', $response);
    }



    /***************************************************** Edit_qrcode ******************************************************/
    public function Edit_qrcode(Request $request)
    {
        $response = [];
        $message = 'QR Code';
        $response['header'] = 'QR Code';
        $response['form_open'] = Form::open(route('edit_qrcode'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'image' => Form::label('Image', 'image', ['class' => 'form-label']) .
                Form::file('image', old('image', ''), ['class' => 'form-control', 'placeholder' => 'Image']),
            'caption' => Form::label('Caption', '', ['class' => 'form-label']) .
                Form::text('caption', old('caption', ''), ['class' => 'form-control', 'placeholder' => 'Caption']),
        ];
        $response['form_close'] = Form::close();

        $response['form_button'] = [
            Form::submit('Update', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $request->validate([
                'image' => 'required',
                'caption' => 'required',
            ]);
            $file = $request->file('image');
            $filePath = $file->store('uploads', 'public');

            $add = [
                'image' => $filePath,
                'caption' => $request->news
            ];
            $AddData = update_data('tbl_qrcode', ['id' => 1], $add);

            if ($AddData) {
                return flashdata('edit_qrcode', $message, 'QR Code Update Successfully', 'success');
            } else {
                return flashdata('edit_qrcode', $message, 'Something Went Wrong', 'danger');
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }



    /***************************************************** upload_popup ******************************************************/
    public function upload_popup(Request $request)
    {
        $response = [];
        $message = 'Upload Popup';
        $popup = get_single_record('tbl_popup', array('id' => 1), '*');
        $toggleText = $popup['status'] == 0 ? 'OFF' : 'ON';
        $btn = ' <a href="' . route('popuponoff') . '" class="ml-3 btn-sm btn ' . ($popup['status'] == 0 ? 'btn-danger' : 'btn-success') . '">' . $toggleText . '</a>';
        $response['header'] = 'Popup ' . $btn;
        $response['form_open'] = Form::open(route('upload-popup'), 'POST', ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']);
        $response['form'] = [
            'caption' => Form::label('Caption', '', ['class' => 'form-label']) .
                Form::text('caption', old('caption', ''), ['class' => 'form-control', 'placeholder' => 'Caption']),
            'type' => Form::label('type', '', ['class' => 'form-label']) .
                Form::dropdown('type', ['image' => 'image', 'video' => 'video'], '', ['class' => 'form-control']),
            'image' => Form::label('Image', 'image', ['class' => 'form-label']) .
                Form::file('image', old('image', ''), ['class' => 'form-control', 'placeholder' => 'Image']),
        ];
        $response['form_close'] = Form::close();
        $response['form_button'] = [
            Form::submit('Update', ['class' => 'btn btn-primary mt-3'])
        ];
        if ($request->isMethod('post')) {
            $request->validate([
                'image' => 'required|file',
                'caption' => 'required',
            ]);
            if ($request->hasFile('image')) {
                $originalFileName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('uploads', $originalFileName, 'public');
                $update = [
                    'media' => $path,
                    'caption' => $request->caption,
                    'type' => $request->type,
                ];
                $updateData = add('tbl_popup', ['id' => 1], $update);

                if ($updateData) {
                    return flashdata('upload-popup', $message, 'Popup Update Successfully', 'success');
                } else {
                    return flashdata('upload-popup', $message, 'Something Went Wrong', 'danger');
                }
            } else {
                return flashdata('upload-popup', $message, 'No file uploaded', 'danger');
            }
        }

        // Return response
        $response['message'] = $message;
        return adminView('forms', $response);
    }



    /***************************************************** popuponoff ******************************************************/
    public function popuponoff()
    {
        $message = 'Upload Popup';
        $popup = get_single_record('tbl_popup', ['id' => 1], '*');
        if ($popup['status'] == 0) {
            update_data('tbl_popup', ['id' => 1], ['status' => 1]);
            return flashdata('upload-popup', $message, 'Popup Activated Successfully', 'success');
        } else {
            update_data('tbl_popup', ['id' => 1], ['status' => 0]);
            return flashdata('upload-popup', $message, 'Popup Deactivated Successfully', 'danger');
        }
    }


    /***************************************************** CreateNews ******************************************************/
    public function CreateNews(Request $request)
    {
        $response = [];
        $message = 'Create News';
        $response['header'] = 'Create News';
        $response['title'] = 'Create News';
        $response['form_open'] = Form::open(route('news-create'), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'title' => Form::label('Title', '', ['class' => 'form-label']) .
                Form::text('title', old('title', ''), ['class' => 'form-control', 'placeholder' => 'Title']),
            'news' => Form::label('News', '', ['class' => 'form-label']) .
                Form::text('news', old('news', ''), ['class' => 'form-control', 'placeholder' => 'News']),
        ];
        $response['form_close'] = Form::close();

        $response['form_button'] = [
            Form::submit('Add News', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'news' => 'required',
            ]);
            $add = [
                'title' => $request->title,
                'news' => $request->news
            ];
            $AddData = add('news', $add);
            if ($AddData) {
                return flashdata('news-create', $message, 'News Added Successfully', 'success');
            } else {
                return flashdata('news-create', $message, 'Something Went Wrong', 'danger');
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }

    /***************************************************** EditNews ******************************************************/
    public function EditNews(Request $request, $id)
    {
        $response = [];
        $message = 'edit-news';
        $response['header'] = 'Edit News';
        $response['title'] = 'Edit News';
        $check = get_single_record('news', ['id' => $id], '*');
        $response['form_open'] = Form::open(route('edit-news', ['id' => $id]), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'title' => Form::label('Title', '', ['class' => 'form-label']) .
                Form::text('title', $check['title'], ['class' => 'form-control', 'placeholder' => 'Title']),
            'news' => Form::label('News', '', ['class' => 'form-label']) .
                Form::text('news', $check['news'], ['class' => 'form-control', 'placeholder' => 'News']),
        ];
        $response['form_close'] = Form::close();

        $response['form_button'] = [
            Form::submit('Update News', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'news' => 'required',
            ]);
            $add = [
                'title' => $request->title,
                'news' => $request->news
            ];
            $AddData = update_data('news', ['id' => $id], $add);
            if ($AddData) {
                return flashdata('edit-news', $message, 'News Updated Successfully', 'success', $id);
            } else {
                return flashdata('edit-news', $message, 'Something Went Wrong', 'danger', $id);
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }


    /***************************************************** deleteNews ******************************************************/
    public function deleteNews(Request $request, $id)
    {
        $news = get_single_record('news', ['id' => $id], '*');

        if ($news) {
            $delete = deleteRecord('news', $news);
            return redirect()->back();
        }
    }


    /***************************************************** Kyc_verify ******************************************************/
    public function Kyc_verify(Request $request, $id)
    {
        $response = [];
        $message = 'kyc-verify';
        $response['header'] = 'KYC Verification';
        $check = get_single_record('bank_detail', ['id' => $id], '*');
        $response['form_open'] = Form::open(route('kycverify', ['id' => $id]), 'POST', ['class' => 'form-horizontal']);
        $response['form'] = [
            'bank_name' => Form::label('Bank Name', '', ['class' => 'form-label']) .
                Form::text('bank_name', $check['bank_name'], ['class' => 'form-control', 'placeholder' => 'Bank Name', 'readonly' => 'readonly']),
            'account_number' => Form::label('Account Number', '', ['class' => 'form-label']) .
                Form::text('account_number', $check['account_number'], ['class' => 'form-control', 'placeholder' => 'Account Number', 'readonly' => 'readonly']),
            'ifsc_code' => Form::label('IFSC Code', '', ['class' => 'form-label']) .
                Form::text('ifsc_code', $check['ifsc_code'], ['class' => 'form-control', 'placeholder' => 'IFSC Code', 'readonly' => 'readonly']),
            'branch' => Form::label('Branch', '', ['class' => 'form-label']) .
                Form::text('branch', $check['branch'], ['class' => 'form-control', 'placeholder' => 'Branch Name', 'readonly' => 'readonly']),
            'kyc_status' => Form::label('Kyc Status', '', ['class' => 'form-label']) .
                Form::dropdown('kyc_status', [2 => 'Approved', 3 => 'Reject'], '', ['class' => 'form-control']),
        ];
        $response['form_close'] = Form::close();

        $response['form_button'] = [
            Form::submit('Verify', ['class' => 'btn btn-primary mt-3'])
        ];

        if (request()->isMethod('post')) {
            $request->validate([
                'bank_name' => 'required',
                'account_number' => 'required',
                'ifsc_code' => 'required',
                'branch' => 'required',
                'kyc_status' => 'required',
            ]);
            $update = [
                'kyc_status' => $request->kyc_status,
            ];
            $updateData = update_data('bank_detail', ['id' => $id], $update);
            if ($updateData) {
                return flashdata('kycverify', $message, 'KYC Verification Successfully', 'success', $id);
            } else {
                return flashdata('kycverify', $message, 'Something Went Wrong', 'danger', $id);
            }
        }
        $response['message'] = $message;
        return adminView('forms', $response);
    }
}
