@extends('User.layout.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="geex-content__wrapper">
                <div class="col-md-12 form-brand">
                    @if (session($message))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session($message) }}
                        </div>
                    @endif

                    <div class="heading">
                        <h4>
                            {{ $header }}
                        </h4>

                    </div>
                    @if ($extra_header == true)
                        <div class="balance">
                            <h5>Balance : {{ currency . number_format($balance['balance'], 2) }} </h5>
                        </div>
                    @endif
                    {!! $form_open !!}
                    @csrf
                    @foreach ($form as $key => $value)
                        <div class="form-group">
                            @php
                                // Apply the validation classes based on whether there are errors or old input
                                $inputClass = $errors->has($key) ? 'is-invalid' : (old($key) ? 'is-valid' : '');
                                $value = str_replace('form-control', 'form-control ' . $inputClass, $value);
                            @endphp
                            {!! $value !!}
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <span class="text-brand">
                            @error($key)
                                {{ $message }}
                            @enderror
                        </span>
                    @endforeach

                    {!! $form_button !!}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
