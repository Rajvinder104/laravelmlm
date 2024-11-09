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
                            <p>Wallet Balance : <span class="text-info text-bold"><span class="text-danger">{{ currency }}</span>{{ $wallet_Balance['wallet_Balance'] }}</span></p>
                        </div>
                        {!! Form::open(route('activate'), 'POST', []) !!}
                        <div class="mb-3">
                            {!! Form::label('User ID') .
                                Form::text('user_id', session('user_id'), [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter User ID',
                                    'id' => 'user_id',
                                    'onkeyup' => 'getName()',
                                ]) !!}
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span id="userName"></span>
                        </div>
                        @if (activation == 0)
                            <div class="mb-3">
                                {!! Form::label('Amount') .
                                    Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount']) !!}
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                {!! Form::label('Packages', '', ['class' => 'form-label']) !!}
                                {!! Form::dropdown('package_id', $package, '', ['class' => 'form-control']) !!}
                            </div>
                        @endif
                        <div class="card-footer">
                            {!! Form::submit('Activate', ['class' => 'btn btn-warning', 'id' => 'submit', 'style' => 'display: block;']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
