@extends('User.layout.layout')
@section('content')
    @php
        use App\Providers\Helper\FormHelper as Form;
        $userinfo = userinfo();
        $bankinfo = bankinfo();
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="geex-content__wrapper">
                <div class="col-md-12 form-brand">
                    <div class="heading">
                        <h4>
                            {!! $header !!}
                        </h4>
                    </div>

                    <div class="card-title">
                        @if (session($message))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session($message) }}
                            </div>
                        @endif
                    </div>
                    @if (withdraw_status == 0)
                        @if (withdraw == 0)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <ul>
                                            <li class="detailsusers">
                                                <div class="detaillable">
                                                    Account Holder Name :-
                                                </div>
                                                <div class="detailsvalue">
                                                    {{ $bankinfo['holder_name'] }}
                                                </div>
                                            </li>
                                            <li class="detailsusers">
                                                <div class="detaillable">
                                                    Bank Name :-
                                                </div>
                                                <div class="detailsvalue">
                                                    {{ $bankinfo['bank_name'] }}
                                                </div>
                                            </li>
                                            <li class="detailsusers">
                                                <div class="detaillable">
                                                    Bank Account Number :-
                                                </div>
                                                <div class="detailsvalue">
                                                    {{ $bankinfo['account_number'] }}
                                                </div>
                                            </li>
                                            <li class="detailsusers">
                                                <div class="detaillable">
                                                    Branch Address :-
                                                </div>
                                                <div class="detailsvalue">
                                                    {{ $bankinfo['branch'] }}
                                                </div>
                                            </li>
                                            <li class="detailsusers">
                                                <div class="detaillable">
                                                    IFSC Code :-
                                                </div>
                                                <div class="detailsvalue">
                                                    {{ $bankinfo['ifsc_code'] }}
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div>
                                <p>Wallet Balance : <span
                                        class="text-info text-bold"></span>{{ currency . $balance['balance'] }}</span>
                                </p>
                            </div>
                            {!! Form::open(route('withdraw'), 'POST', [
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="mb-3">
                                {!! Form::label('Amount') .
                                    Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount']) !!}
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (withdraw == 1)
                                <div class="mb-3">
                                    {!! Form::label('USDT Address') .
                                        Form::text('wallet_address', null, ['class' => 'form-control', 'placeholder' => 'Enter Wallet Address']) !!}
                                    @error('wallet_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-3">
                                {!! Form::label('Transaction Id') .
                                    Form::number('master_key', null, ['class' => 'form-control', 'placeholder' => 'Enter Transaction Id']) !!}
                                @error('master_key')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="card-footer">
                                {!! Form::submit('Request', ['class' => 'btn btn-primary', 'id' => 'submit', 'style' => 'display: block;']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="col-md-4">
                                <marquee behavior="" direction="">
                                    <span class="text-danger">Withdraw Closed By Admin !</span>
                                </marquee>
                            </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
