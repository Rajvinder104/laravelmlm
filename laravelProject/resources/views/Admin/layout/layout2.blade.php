<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kleon Admin Template">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="{{ favicon }}" rel="shortcut icon" type="image/png">
    <link href="../admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../admin/assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../admin/assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../admin/assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    <link rel="stylesheet" href="{{ '../project/css/projectstyle.css' }}">
    <!-- Page Title -->
    <title>{{ title }}</title>

    <!-- Styles Include -->
    <link rel="stylesheet" href="../../admin/assets/css/main.css" id="stylesheet">

</head>


<body class="bg-light">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="spinner"></div>
            <div class="logo"><img src="{{ logo }}" alt="img" class="logostyle"></div>
        </div>
    </div>

    <!-- Default Nav -->
    <header class="header kleon-default-nav">
        <div class="d-none d-xl-block">
            <div
                class="header-inner d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
                <div class="header-left-part d-flex align-items-center flex-grow-1 w-100">
                    <div class="header-search w-100">
                        <form class="search-form" action="search.php">
                            <input type="text" name="search" class="keyword form-control w-100"
                                placeholder="Search">
                            <button type="submit" class="btn"><img src="../admin/assets/img/svg/search.svg"
                                    alt=""></button>
                        </form>
                    </div>
                </div>

                <div class="header-right-part d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                            <div class="sun"><img src="../admin/assets/img/sun.svg" alt="img"></div>
                            <div class="switch">
                                <input type="checkbox" id="colorSwitch" value="false" name="defaultMode">
                                <div class="shutter">
                                    <span class="lbl-off"></span>
                                    <span class="lbl-on"></span>
                                    <div class="slider bg-primary"></div>
                                </div>
                            </div>
                            <div class="moon"><img src="../admin/assets/img/moon.svg" alt="img"></div>
                        </li>



                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/svg/bell.svg" alt="bell">
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a
                                                        href="#">Kleon Projects</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as
                                                        read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-author">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="54"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0 text-primary">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="80" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
            <div class="logo">
                <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ logo }}" alt="logo" class="logostyle">

                </a>
            </div>
            <div>
                <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i
                            class="bi bi-three-dots-vertical"></i></button>
                <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i
                            class="bi bi-arrow-left"></i></span> <span class="open"><i
                            class="bi bi-list"></i></span></button>
            </div>
        </div>

        <div class="header-mobile-option">
            <div class="header-inner">
                <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </li>
                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at
                                                    <a href="#">Kleon Projects</a>
                                                </h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as
                                                        read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-author px-3">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="40"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="60" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Horizontal Nav -->
    <header class="header kleon-horizontal-nav shadow">
        <div class="d-none d-xl-block">
            <div
                class="d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
                <div class="d-flex align-items-center gap-7">
                    <div class="logo">
                        <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                            <img src="{{ logo }}" alt="logo" class="logostyle">

                        </a>
                    </div>

                    <div class="kleon-navmenu text-center">
                        <ul class="main-menu">

                            <li class="menu-item menu-item-has-children"><a href="#"> <span
                                        class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-16"></i></span>
                                    <span class="nav-text">Dashboards</span></a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="{{ route('admin/index') }}">Dashboards</a></li>

                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                            </li>

                            <li class="menu-item menu-item-has-children"><a href="#"> <span
                                        class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span>
                                    <span class="nav-text">User Details</span></a>
                                <ul class="sub-menu">
                                    <!-- HR Management -->
                                    <li class="menu-item menu-item-has-children"><a href="#"> <span
                                                class="nav-icon flex-shrink-0"><i
                                                    class="bi bi-people fs-16"></i></span> <span class="nav-text">All
                                                members</span></a>

                                    </li>

                                    <!-- Job Hiring -->
                                    <li class="menu-item menu-item-has-children"><a href="#"> <span
                                                class="nav-icon flex-shrink-0"><i
                                                    class="bi bi-briefcase fs-16"></i></span> <span
                                                class="nav-text">Paid members</span></a>

                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                </div>

                <div class="d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <img src="../admin/assets/img/svg/search.svg" alt="">
                            </button>
                        </li>
                        <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                            <div class="sun"><img src="../admin/assets/img/sun.svg" alt="img"></div>
                            <div class="switch">
                                <input type="checkbox" id="colorSwitch2" value="false" name="defaultMode">
                                <div class="shutter">
                                    <span class="lbl-off"></span>
                                    <span class="lbl-on"></span>
                                    <div class="slider bg-primary"></div>
                                </div>
                            </div>
                            <div class="moon"><img src="../admin/assets/img/moon.svg" alt="img"></div>
                        </li>



                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/svg/bell.svg" alt="bell">
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at
                                                    <a href="#">Kleon Projects</a>
                                                </h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as
                                                        read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item nav-author">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="54"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="80" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}
                                                </h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
            <div class="logo">
                <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ logo }}" alt="logo" class="logostyle">

                </a>
            </div>
            <div>
                <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i
                            class="bi bi-three-dots-vertical"></i></button>
                <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i
                            class="bi bi-arrow-left"></i></span> <span class="open"><i
                            class="bi bi-list"></i></span></button>
            </div>
        </div>

        <div class="header-mobile-option">
            <div class="header-inner">
                <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </li>
                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at
                                                    <a href="#">Kleon Projects</a>
                                                </h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as
                                                        read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item nav-author px-3">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="40"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="60" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}
                                                </h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Combo Nav -->
    <header class="header kleon-combo-nav shadow">
        <div class="d-none d-xl-block">
            <div
                class="d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
                <div class="d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/svg/bell.svg" alt="bell">
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you
                                                    at <a href="#">Kleon Projects</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark
                                                        as read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-giftbox">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/svg/gift.svg" alt="img">
                                <div class="badge rounded-circle">5</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#"><i class="bi bi-three-dots-vertical"></i></a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-soft-primary">
                                                <i class="bi bi-bell-fill"></i>
                                            </div>
                                            <div
                                                class="user-message d-flex align-items-center justify-content-between gap-5">
                                                <h6 class="message mb-0">Review New Candidate Application</h6>
                                                <p class="message-footer flex-shrink-0 mb-0"> <span
                                                        class="time">08:00 AM</span></p>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-folder">
                            <a href="#" class="nav-toggler">
                                <img src="../admin/assets/img/svg/folder.svg" alt="img">
                                <div class="badge rounded-circle">!</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu dropdown-schedule p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Schedule <a
                                                href="#"><i class="bi bi-three-dots-vertical"></i></a></h4>
                                        <p>Thursday January 10th, 2022</p>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media">
                                                <img src="../admin/assets/img/2.jpg" alt="img" width="60"
                                                    class="rounded-2">
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message mb-1"><a href="#" class="text-dark">Meeting
                                                        with Candidate #1</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span><i class="bi bi-calendar-fill"></i> January 17, 2023</span>
                                                    <span><i class="bi bi-clock-fill"></i> 10.00 - 11.00</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media">
                                                <img src="../admin/assets/img/4.jpg" alt="img" width="60"
                                                    class="rounded-2">
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message mb-1"><a href="#" class="text-dark">Meeting
                                                        with Candidate #2</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span><i class="bi bi-calendar-fill"></i> January 17, 2023</span>
                                                    <span><i class="bi bi-clock-fill"></i> 10.00 - 11.00</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media">
                                                <img src="../admin/assets/img/6.jpg" alt="img" width="60"
                                                    class="rounded-2">
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message mb-1"><a href="#" class="text-dark">Meeting
                                                        with Candidate #3</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span><i class="bi bi-calendar-fill"></i> January 17, 2023</span>
                                                    <span><i class="bi bi-clock-fill"></i> 10.00 - 11.00</span>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All</a> </h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-7 order-1 order-xl-0">
                    <div class="kleon-navmenu text-center">
                        <ul class="main-menu">

                            <li class="menu-item menu-item-has-children"><a href="{{ route('admin/index') }}"> <span
                                        class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-16"></i></span>
                                    <span class="nav-text">Dashboards</span></a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="{{ route('admin/index') }}">Dashboards</a></li>

                                </ul>
                                <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>


                            </li>

                            <li class="menu-item menu-item-has-children"><a href="#"> <span
                                        class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span>
                                    <span class="nav-text">User Details</span></a>

                            </li>


                        </ul>
                    </div>
                </div>

                <div class="d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <img src="../admin/assets/img/svg/search.svg" alt="">
                            </button>
                        </li>
                        <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                            <div class="sun"><img src="../admin/assets/img/sun.svg" alt="img"></div>
                            <div class="switch">
                                <input type="checkbox" id="colorSwitch3" value="false" name="defaultMode">
                                <div class="shutter">
                                    <span class="lbl-off"></span>
                                    <span class="lbl-on"></span>
                                    <div class="slider bg-primary"></div>
                                </div>
                            </div>
                            <div class="moon"><img src="../admin/assets/img/moon.svg" alt="img"></div>
                        </li>


                        <li class="nav-item nav-author">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="54"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="80" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}
                                                </h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
            <div class="logo">
                <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ logo }}" alt="logo" class="logostyle">

                </a>
            </div>
            <div>
                <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i
                            class="bi bi-three-dots-vertical"></i></button>
                <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i
                            class="bi bi-arrow-left"></i></span> <span class="open"><i
                            class="bi bi-list"></i></span></button>
            </div>
        </div>

        <div class="header-mobile-option">
            <div class="header-inner">
                <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </li>
                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you
                                                    at <a href="#">Kleon Projects</a></h6>
                                                <p
                                                    class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark
                                                        as read</span>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <h6 class="all-notifications"> <a href="#"
                                            class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a> </h6>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-author px-3">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../admin/assets/img/nav_author.jpg" alt="img" width="40"
                                    class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">{{ Auth::guard('admin')->user()->user_id }}</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="../admin/assets/img/nav_author.jpg" alt="img"
                                                width="60" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">{{ Auth::guard('admin')->user()->user_id }}
                                                </h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="profile.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="email.html"
                                                        class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href="{{ route('admin/logout') }}"
                                                class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </header>

    <!-- Vertical Nav -->
    <div class="kleon-vertical-nav">
        <!-- Logo  -->
        <div class="logo d-flex align-items-center justify-content-between">
            <a href="index.html" class="d-flex align-items-center gap-3 flex-shrink-0">
                <img src="{{ logo }}" alt="logo" class="logostyle">

            </a>
            <button type="button" class="kleon-vertical-nav-toggle"><i class="bi bi-list"></i></button>
        </div>

        <div class="kleon-navmenu">
            <h6 class="hidden-header text-gray text-uppercase ls-1 ms-4 mb-4">Main Menu</h6>
            <ul class="main-menu">

                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Home</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="#"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-18"></i></span> <span
                            class="nav-text">Dashboards</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('admin/index') }}">Dashboards</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>

                </li>

                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>User Details</span>
                </li>
                <!-- User Details -->
                <li class="menu-item menu-item-has-children"><a href="#"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-people fs-18"></i></span> <span
                            class="nav-text">User Details</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('admin/AllUsers') }}">All members</a></li>
                        <li class="menu-item"><a href="{{ route('Today-Join') }}">Today Joined members</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>

                <!--Settings -->

                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Settings</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="#"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-gear-fill"></i></span> <span
                            class="nav-text">Settings</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('news') }}">News</a></li>
                        <li class="menu-item"><a href="{{ route('edit_qrcode') }}">Update QR Code</a></li>
                        <li class="menu-item"><a href="{{ route('upload-popup') }}">Update Popup</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!--Incomes -->

                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Incomes</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="#"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-coin"></i></span> <span
                            class="nav-text">Incomes</span></a>
                    <ul class="sub-menu">
                        @php
                            $incomes = ConfigArray('incomes');
                        @endphp
                        @foreach ($incomes as $key => $income)
                            <li class="menu-item"><a
                                    href="{{ route('income', ['type' => $key]) }}">{{ $income }}</a></li>
                        @endforeach
                        <li class="menu-item"><a href="{{ route('send-income') }}">Credit/Debit Income</a></li>
                        <li class="menu-item"><a href="{{ route('income-ledgar') }}">Income Ledgar</a></li>
                        <li class="menu-item"><a href="{{ route('payout_summary') }}">Payout Summary</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!--Fund Management -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Fund Management</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('send-wallet') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-files"></i></span> <span
                            class="nav-text">Fund Management</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('fundhistory', ['status' => 'allrequest']) }}">All
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('fundhistory', ['status' => 'pending']) }}">Pending
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('fundhistory', ['status' => 'approved']) }}">Approved
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('fundhistory', ['status' => 'rejected']) }}">Rejected
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('send-wallet') }}">Credit/Debit Fund</a></li>
                        <li class="menu-item"><a href="{{ route('admin_fund_history') }}">Admin Fund History</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!-- Kyc Requests -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Kyc Requests</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('send-wallet') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-bank2"></i></span> <span
                            class="nav-text">Kyc Requests</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('kychistory', ['status' => 'allrequest']) }}">All
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('kychistory', ['status' => 'pending']) }}">Pending
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('kychistory', ['status' => 'approved']) }}">Approved
                                Requests</a></li>
                        <li class="menu-item"><a href="{{ route('kychistory', ['status' => 'rejected']) }}">Rejected
                                Requests</a></li>


                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!-- Withdraw Requests -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Withdraw Requests</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('send-wallet') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-currency-dollar"></i></span> <span
                            class="nav-text">Withdraw Requests</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a
                                href="{{ route('withdrawhistory', ['status' => 'allrequest']) }}">All
                                Requests</a></li>
                        <li class="menu-item"><a
                                href="{{ route('withdrawhistory', ['status' => 'pending']) }}">Pending
                                Requests</a></li>
                        <li class="menu-item"><a
                                href="{{ route('withdrawhistory', ['status' => 'approved']) }}">Approved
                                Requests</a></li>
                        <li class="menu-item"><a
                                href="{{ route('withdrawhistory', ['status' => 'rejected']) }}">Rejected
                                Requests</a></li>


                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!--Support-->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Support</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('send-wallet') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-envelope"></i></span> <span
                            class="nav-text">Support</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('support') }}">Compose mail</a></li>
                        <li class="menu-item"><a href="{{ route('Outbox-Report') }}">Outbox mail History</a></li>
                        <li class="menu-item"><a href="{{ route('Inbox-Report') }}">Inbox mail History</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!-- Authentication -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Authentication</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('send-wallet') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-box-arrow-in-left"></i></span> <span
                            class="nav-text">Authentication</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('register') }}" target="_blank">Registration</a>
                        </li>
                        <li class="menu-item"><a href="{{ route('login') }}" target="_blank">Login</a></li>

                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
                <!-- Logout -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Logout</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="{{ route('admin/logout') }}"> <span
                            class="nav-icon flex-shrink-0"><i class="bi bi-box-arrow-in-right fs-18"></i></span> <span
                            class="nav-text">Logout</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('admin/logout') }}">Logout</a></li>
                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>
            </ul>
        </div>



        <div class="card border-0 rounded-0 mt-6">
            <div class="card-body p-0">
                <h6 class="text-gray lh-20 mb-0"> Admin Dashboard</h6>

            </div>
        </div>
    </div>

    <!-- Theme Customizer Panel -->
    <button
        class="aside_open btn btn-primary position-fixed z-index-9 rounded-circle p-0 m-0 d-flex align-items-center justify-content-center"
        type="button" data-bs-toggle="offcanvas" data-bs-target="#themeSwitcher"><i
            class="bi bi-gear-fill fs-20"></i></button>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="themeSwitcher">
        <div class="offcanvas-header bg-light-200">
            <h5 class="offcanvas-title">Theme Customizer</h5>
            <button type="button"
                class="aside_close btn btn-danger z-index-9 rounded-circle p-0 m-0 d-flex align-items-center justify-content-center"
                data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="offcanvas-body bg-white p-0">
            <div class="bg-light-500 p-4 flex-grow-1">
                <h6 class="mb-3 lh-16">Theme Color Mode</h6>
                <div>
                    <div class="form-switch p-0">
                        <label class="form-label mb-0" for="colorSwitch4">Light</label>
                        <input type="checkbox" class="form-check-input border-0 m-0 mx-3" id="colorSwitch4">
                        <label class="form-label mb-0" for="colorSwitch4">Dark</label>
                    </div>
                </div>
            </div>


            <div class="bg-light-200 p-4 flex-grow-1">
                <h6 class="mb-3 lh-16">Navigation Layout</h6>
                <div class="row">
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <input type="radio" class="form-check-input" id="verticalNav" name="checkLayout"
                                value="vertical" checked>
                            <label class="form-label mb-0" for="verticalNav">
                                <span class="d-inline-block mb-2">
                                    <img class="light-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/vertical-light.png" alt="img">
                                    <img class="dark-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/vertical-dark.png" alt="img">
                                </span>
                                <span class="label-text">Vertical</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <input type="radio" class="form-check-input" id="horizontalNav" name="checkLayout"
                                value="horizontal">
                            <label class="form-label mb-0" for="horizontalNav">
                                <span class="d-inline-block mb-2">
                                    <img class="light-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/horizontal-light.png" alt="img">
                                    <img class="dark-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/horizontal-dark.png" alt="img">
                                </span>
                                <span class="label-text">Horizontal</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <input type="radio" class="form-check-input" id="comboNav" name="checkLayout"
                                value="combo">
                            <label class="form-label mb-0" for="comboNav">
                                <span class="d-inline-block mb-2">
                                    <img class="light-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/combo-light.png" alt="img">
                                    <img class="dark-version img-fluid rounded-1"
                                        src="../admin/assets/img/customizer/combo-dark.png" alt="img">
                                </span>
                                <span class="label-text">Combo</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-light-500 p-4 flex-grow-1">
                <h6 class="mb-3 lh-16">Vertical Navigation Styles</h6>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="fullwidthNav" name="checkVerticalNav"
                            value="fullwidth" checked>
                        <label class="form-label mb-0" for="fullwidthNav">Fullwidth</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="collapseNav" name="checkVerticalNav"
                            value="collapse">
                        <label class="form-label mb-0" for="collapseNav">Collapse</label>
                    </div>
                </div>
            </div>


            <div class="bg-light-200 p-4 flex-grow-1">
                <h6 class="mb-3 lh-16">Header Position</h6>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="scrollableHeader" name="headerPosition"
                            value="scrollable" checked>
                        <label class="form-label mb-0" for="scrollableHeader">Scrollable</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="fixedHeader" name="headerPosition"
                            value="fixed">
                        <label class="form-label mb-0" for="fixedHeader">Fixed</label>
                    </div>
                </div>
            </div>

            <div class="bg-light-500 p-4 flex-grow-1">
                <h6 class="mb-3 lh-16">Topbar Style</h6>
                <div class="row">
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <label class="form-label mb-0">
                                <a href="index.html" target="_blank" rel="noopener noreferrer"
                                    class="fs-14 fw-semibold text-dark">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/vertical-light.png" alt="img">
                                        <img class="dark-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/vertical-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Style One</span>
                                </a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <label class="form-label mb-0">
                                <a href="index-horizontal.html" target="_blank" rel="noopener noreferrer"
                                    class="fs-14 fw-semibold text-dark">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/horizontal-light.png"
                                            alt="img">
                                        <img class="dark-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/horizontal-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Style Two</span>
                                </a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline with-layout-image m-0">
                            <label class="form-label mb-0">
                                <a href="index-combo.html" target="_blank" rel="noopener noreferrer"
                                    class="fs-14 fw-semibold text-dark">
                                    <span class="d-inline-block mb-2">
                                        <img class="light-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/combo-light.png" alt="img">
                                        <img class="dark-version img-fluid rounded-1"
                                            src="../admin/assets/img/customizer/combo-dark.png" alt="img">
                                    </span>
                                    <span class="label-text">Style Three</span>
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @hasSection('content')
        @yield('content')
    @endif


    <!-- Core JS -->
    <script src="../admin/assets/js/jquery-3.6.0.min.js"></script>
    <script src="../admin/assets/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery UI Kit -->
    <script src="../admin/plugins/jquery_ui/jquery-ui.1.12.1.min.js"></script>

    <!-- ApexChart -->
    <script src="../admin/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../admin/plugins/apexchart/apexchart-inits/apexcharts-analytics-2.js"></script>

    <!-- Peity  -->
    <script src="../admin/plugins/peity/jquery.peity.min.js"></script>
    <script src="../admin/plugins/peity/piety-init.js"></script>

    <!-- Select 2 -->
    <script src="../admin/plugins/select2/js/select2.min.js"></script>

    <!-- Datatables -->
    <script src="../admin/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../admin/plugins/datatables/js/datatables.init.js"></script>



    <!-- Date Picker -->
    <script src="../admin/plugins/flatpickr/flatpickr.min.js"></script>

    <!-- Dropzone -->
    <script src="../admin/plugins/dropzone/dropzone.min.js"></script>
    <script src="../admin/plugins/dropzone/dropzone_custom.js"></script>

    <!-- TinyMCE -->
    <script src="../admin/plugins/tinymce/tinymce.min.js"></script>
    <script src="../admin/plugins/prism/prism.js"></script>
    <script src="../admin/plugins/jquery-repeater/jquery.repeater.js"></script>

    <script src="../admin/plugins/sweetalert/sweetalert2.min.js"></script>
    <script src="../admin/plugins/sweetalert/sweetalert2-init.js"></script>
    <script src="../admin/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../admin/plugins/nicescroll/jquery.nicescroll.min.js"></script>

    <!-- Snippets JS -->
    <script src="../admin/assets/js/snippets.js"></script>

    <!-- Theme Custom JS -->
    <script src="../admin/assets/js/theme.js"></script>

    @yield('script')

</body>

</html>
