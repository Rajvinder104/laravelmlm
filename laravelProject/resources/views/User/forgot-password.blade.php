@extends('User.layout.formslayout')

@section('form')
    @php
        use App\Providers\Helper\FormHelper as Form;
    @endphp
    <div class="btn-section clearfix">
        <a href="{{ route('login') }}" class="link-btn active btn-1 default-bg">Login</a>
        <a href="{{ route('register') }}" class="link-btn btn-2 default-bg">Register</a>
    </div>
    <div class="clearfix"></div>
    {!! Form::open(route('forgot_pass'), 'POST', []) !!}
    <div class="form-group">
        {!! Form::text('user_id', old('user_id'), ['class' => 'form-control', 'placeholder' => 'Enter User Id']) !!}
        @error('user_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group clearfix">
        <button type="submit" class="btn btn-lg btn-primary btn-theme"><span>Send Me
                Email</span></button>
    </div>
    {!! Form::close() !!}
    <p>Already a member? <a href="{{ route('login') }}">Login here</a></p>
@endsection
