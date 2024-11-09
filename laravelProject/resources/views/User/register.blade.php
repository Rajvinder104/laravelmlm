@extends('User.layout.formslayout')
@section('form')
    @php
        use App\Providers\Helper\FormHelper as Form;
    @endphp
    <div class="btn-section clearfix">
        <a href="{{ route('login') }}" class="link-btn active btn-1 default-bg">Login</a>

        <a href="{{ route('register') }}" class="link-btn btn-2 active-bg">Register</a>
    </div>
    <div class="clearfix"></div>
    {!! Form::open(route('registerPOST'), 'POST', []) !!}
    <div class="form-group">
        {!! Form::text('sponsor', $sponsor, [
            'class' => 'form-control',
            'placeholder' => 'Enter sponsor Id',
            'id' => 'user_id',
            'onkeyup' => 'getName()',
        ]) !!}
        <span id="userName"></span>
        @error('sponsor')
            <span class="text-danger text-brand">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter user name']) !!}
        @error('name')
            <span class="text-danger text-brand">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter your email']) !!}
        @error('email')
            <span class="text-danger text-brand">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::number('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Enter your phone number']) !!}
        @error('phone')
            <span class="text-danger text-brand">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::password('password', old('password'), ['class' => 'form-control', 'placeholder' => 'Enter password']) !!}
        @error('password')
            <span class="text-danger text-brand">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group clearfix">
        {!! Form::password('password_confirmation', old('password_confirmation'), [
            'class' => 'form-control',
            'placeholder' => 'Enter Comfirm Password',
        ]) !!}
    </div>
    <div class="form-group clearfix">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberme">
            <label class="form-check-label" for="rememberme">
                I agree to the terms of service
            </label>
        </div>
    </div>
    <div class="form-group clearfix">
        <button type="submit" class="btn btn-lg btn-primary btn-theme"><span>Register</span></button>
    </div>
    <p>Already a member? <a href="{{ route('login') }}">Login here</a></p>
    {!! Form::close() !!}
@endsection

