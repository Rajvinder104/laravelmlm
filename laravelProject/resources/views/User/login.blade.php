@extends('User.layout.formslayout')
@section('form')
    @php
        use App\Providers\Helper\FormHelper as Form;
    @endphp
    <div class="btn-section clearfix">
        <a href="{{ route('login') }}" class="link-btn active btn-1 active-bg">Login</a>
        <a href="{{ route('register') }}" class="link-btn btn-2 default-bg">Register</a>
    </div>
    <div class="clearfix"></div>
    {!! Form::open(route('loginPost'), 'POST', []) !!}
    <div class="form-group">
        {!! Form::text('user_id', old('user_id'), ['class' => 'form-control', 'placeholder' => 'Enter User ID']) !!}
        @error('user_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group clearfix">
        {!! Form::password('password', old('password'), ['class' => 'form-control', 'placeholder' => 'Enter Password']) !!}
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="form-group clearfix">
        {!! Form::submit('Sign In', ['class' => 'btn btn-lg btn-primary btn-theme']) !!}

        <a href="{{ route('forgot_password') }}" class="forgot-password">Forgot Password</a>
    </div>
    {!! Form::close() !!}
    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
@endsection
