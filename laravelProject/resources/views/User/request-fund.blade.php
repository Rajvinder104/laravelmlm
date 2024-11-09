@extends('User.layout.layout')
@section('content')
    @php
        use App\Providers\Helper\FormHelper as Form;
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
                    <div class="card-body">
                        <div>
                            <p>Wallet Balance : <span
                                    class="text-info text-bold"></span>{{ currency . $wallet_Balance['wallet_Balance'] }}</span>
                            </p>
                        </div>
                        {!! Form::open(route('request_fund'), 'POST', [
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
                        <div class="mb-3">
                            {!! Form::label('Transaction Id') .
                                Form::number('transaction_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Transaction Id']) !!}
                            @error('transaction_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {!! Form::label('Payment Method', '', ['class' => 'form-label']) !!}
                            {!! Form::dropdown('payment_method', ['bank' => 'Bank', 'upi' => 'UPI'], '', ['class' => 'form-control']) !!}
                            @error('payment_method')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('Image', 'image', ['class' => 'form-label']) !!}
                            {!! Form::file('image', old('image', ''), ['class' => 'form-control', 'placeholder' => 'Image']) !!}
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 d-flex flex-column">

                            {!! Form::label('QR Code', '', ['class' => 'form-label']) !!}
                            <img src="{{ asset('storage/' . $qrcode['image']) }}" alt="" style="width: 200px">
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Request', ['class' => 'btn btn-primary', 'id' => 'submit', 'style' => 'display: block;']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
