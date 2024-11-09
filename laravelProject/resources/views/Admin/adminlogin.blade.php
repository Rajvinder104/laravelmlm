<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        @if (session('message'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="heading">
                        <h4>
                            {{ $header }}
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
    </div>
</body>
</html>
