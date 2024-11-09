@php
    use App\Providers\Helper\FormHelper as Form;
@endphp
@extends('Admin/layout.layout2')

@section('content')
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card form-cards">
                            <div class="form-header">
                                <h4>SELF DETAIL</h4>
                            </div>
                            <div class="card-body">
                                @if (session('personal'))
                                    <div class="alert alert-{{ session('type') }}">
                                        {{ session('personal') }}
                                    </div>
                                @endif
                                {!! Form::open() !!}
                                <div class="form-group">
                                    {!! Form::label('Email Address'),
                                        Form::email('email', old('email', $user['email']), ['class' => 'form-control']) !!}
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::label('Name'), Form::text('name', old('name', $user['name']), ['class' => 'form-control']) !!}
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::hidden('form_type', 'personal') !!}
                                </div>
                                <div class="form-group for-button mt-3 ">
                                    {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card form-cards">
                            <div class="form-header">
                                <h4>BANK DETAIL</h4>
                            </div>
                            <div class="card-body">
                                @if (session('bank_detail'))
                                    <div class="alert alert-{{ session('type') }}">
                                        {{ session('bank_detail') }}
                                    </div>
                                @endif
                                {!! Form::open() !!}
                                <div class="form-group">
                                    {!! Form::label('Bank Name'),
                                        Form::text('bank_name', old('bank_name', $user_bank['bank_name']), ['class' => 'form-control']) !!}
                                    @error('bank_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::label('account_number'),
                                        Form::text('account_number', old('account_number', $user_bank['account_number']), ['class' => 'form-control']) !!}
                                    @error('account_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::label('Branch'),
                                        Form::text('branch', old('branch', $user_bank['branch']), ['class' => 'form-control']) !!}
                                    @error('branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::label('IFSC Code'),
                                        Form::text('ifsc_code', old('ifsc_code', $user_bank['ifsc_code']), ['class' => 'form-control']) !!}
                                    @error('ifsc_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::label('Holder Name'),
                                        Form::text('holder_name', old('holder_name', $user_bank['holder_name']), ['class' => 'form-control']) !!}
                                    @error('holder_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::hidden('form_type', 'bank_detail') !!}
                                </div>
                                <div class="form-group for-button mt-3 ">
                                    {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card form-cards">
                            <div class="form-header">
                                <h4>Password</h4>
                            </div>
                            <div class="card-body">
                                @if (session('password'))
                                    <div class="alert alert-{{ session('type') }}">
                                        {{ session('password') }}
                                    </div>
                                @endif
                                {!! Form::open() !!}
                                <div class="form-group">
                                    {!! Form::label('Password'),
                                        Form::password('password', old('password', $user['password']), ['class' => 'form-control']) !!}
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {!! Form::hidden('form_type', 'password') !!}
                                </div>
                                <div class="form-group for-button mt-3 ">
                                    {!! Form::submit('Update', ['class' => 'btn btn-warning']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
