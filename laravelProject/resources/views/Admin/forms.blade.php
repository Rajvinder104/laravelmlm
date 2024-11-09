@php
    use App\Providers\Helper\FormHelper as Form;
@endphp
@extends('Admin/layout.layout2')

@section('content')
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 form-brand">
                            @if (session($message))
                                <div class="alert alert-{{ session('type') }}">
                                    {{ session($message) }}
                                </div>
                            @endif

                            <div class="heading form-header">
                                <h4>
                                    {!! $header !!}
                                </h4>

                            </div>
                            {!! $form_open !!}
                            @csrf
                            @foreach ($form as $key => $value)
                                <div class="">
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

                            @foreach ($form_button as $btn)
                                <div class="">
                                    {!! $btn !!}
                                </div>
                            @endforeach

                            {!! $form_close !!}
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePasswordIcons = document.querySelectorAll('.toggle-password');

        togglePasswordIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const targetInput = document.querySelector(this.getAttribute('data-target'));
                if (targetInput.getAttribute('type') === 'password') {
                    targetInput.setAttribute('type', 'text');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    targetInput.setAttribute('type', 'password');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    });
</script>
