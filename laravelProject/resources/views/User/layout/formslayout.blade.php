@php
    use App\Providers\Helper\FormHelper as Form;
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="forms/userforms/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="forms/userforms/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="forms/userforms/assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="forms/userforms/assets/img/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="forms/userforms/assets/css/style.css">

</head>

<body id="top">
    <div class="page_loader"></div>

    <!-- Login 15 start -->
    <div class="login-15">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 pad-0">
                    <div class="form-section align-self-center">
                        <div class="logo">
                            <a href="login-15.html">
                                <img src="forms/userforms/assets/img/logos/logo-2.png" alt="logo">
                            </a>
                        </div>
                        @if (session($message))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session($message) }}
                            </div>
                        @endif
                        @hasSection('form')
                            @yield('form')
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 align-self-center pad-0 bg-img">
                    <div class="info clearfix">
                        <div class="logo-2">
                            <a href="login-15.html">
                                <img src="forms/userforms/assets/img/logos/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Welcome to Devil</h3>
                        <div class="social-list">
                            <a href="#" class="facebook-bg">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="twitter-bg">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="google-bg">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="linkedin-bg">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="animation-container">
            <div class="lightning-container">
                <div class="lightning white"></div>
                <div class="lightning red"></div>
            </div>
            <div class="boom-container">
                <div class="shape circle big white"></div>
                <div class="shape circle white"></div>
                <div class="shape triangle big yellow"></div>
                <div class="shape disc white"></div>
                <div class="shape triangle blue"></div>
            </div>
            <div class="boom-container second">
                <div class="shape circle big white"></div>
                <div class="shape circle white"></div>
                <div class="shape disc white"></div>
                <div class="shape triangle blue"></div>
            </div>
        </div>
    </div>
    <!-- Login 15 end -->

    <!-- External JS libraries -->
    <script src="forms/userforms/assets/js/jquery-3.6.0.min.js"></script>
    <script src="forms/userforms/assets/js/bootstrap.bundle.min.js"></script>
    <script src="forms/userforms/assets/js/jquery.validate.min.js"></script>
    <script src="forms/userforms/assets/js/app.js"></script>

    <!-- Custom JS Script -->
    <script>
        function getName() {
            var user_id = document.getElementById('user_id').value;
            if (user_id != '') {
                var url = '{{ route('get_user', ['user_id' => ':user_id']) }}'.replace(':user_id', user_id);
                $.get(url, function(res) {
                    $('#userName').html(res);
                })
            }
        }

        getName();
    </script>
</body>

</html>
