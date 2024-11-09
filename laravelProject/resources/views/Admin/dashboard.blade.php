@extends('Admin.layout.layout2')

@section('content')
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">
                <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                    <div class="left-part">
                        <h2 class="text-dark"><span
                                class="text-primary text-capitalize">{{ Auth::guard('admin')->user()->user_id }}</span>
                            Dashboard</h2>
                        <p class="text-gray mb-0">Lorem ipsum dolor sit amet </p>
                    </div>
                    <div class="right-part">
                        <a href="{{ route('Withdraw_on_off') }}"
                            class="btn-sm btn {{ $settings['withdraw_status'] == 0 ? 'btn-success' : 'btn-danger' }} rounded-2 ff-heading fs-18 fw-bold py-4">
                            <i class="bi bi-pie-chart-fill me-1"></i> Withdraw
                            {{ $settings['withdraw_status'] == 0 ? 'On' : 'Off' }}
                        </a>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl-12 col-lg-12">
                        <div class="row">
                            <div class="col col-12">
                                <div class="card border-0 shadow-sm py-3">
                                    <div class="card-body py-0">
                                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                            <div class="d-flex align-items-center gap-0 flex-wrap">
                                                <div id="chart-45"></div>
                                                <div>
                                                    <h4 class="mb-3">Total Payout</h4>
                                                    <h2 class="fs-38 mb-0">
                                                        {{ currency }}{{ $total_payout['total_payout'] }}</h2>
                                                </div>
                                            </div>

                                            <div>
                                                <h5 class="fw-semibold mb-1">Average from last month</h5>
                                                <p class="text-gray mb-0"><span class="text-success fw-bold"><i
                                                            class="bi bi-graph-up-arrow"></i> +0.5%</span> invoices sent</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col col-lg-4">
                                <div class="card border-0 shadow-sm p-5">
                                    <div
                                        class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                        <div class="flex-shrink-0">
                                            <h4 class="mb-3">Total Users</h4>
                                            <h2 class="fs-38 d-flex align-items-center gap-4">{{ $total_user }}
                                                <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                    {{ $total_user }}
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="card border-0 shadow-sm p-5">
                                    <div
                                        class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                        <div class="flex-shrink-0">
                                            <h4 class="mb-3">Today Users</h4>
                                            <h2 class="fs-38 d-flex align-items-center gap-4">{{ $today_user }}
                                                <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                    {{ $today_user }}
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @php
                                $incomes = ConfigArray('incomes') ?? [];
                            @endphp

                            @if (empty($incomes))
                                <div>No income records found.</div>
                            @else
                                @foreach ($incomes as $key => $inc)
                                    @php
                                        $getBalance = get_single_record(
                                            'tbl_income_wallet',
                                            ['type' => $key],
                                            'ifnull(sum(amount), 0) as balance',
                                        );

                                        $getBalanceToday = get_single_record(
                                            'tbl_income_wallet',
                                            ['type' => $key, 'created_at' => date('Y-m-d')],
                                            'ifnull(sum(amount), 0) as balance',
                                        );

                                        $totalBalance = $getBalance['balance'] ?? 0;
                                        $todayBalance = $getBalanceToday['balance'] ?? 0;
                                    @endphp

                                    <div class="col col-lg-4">
                                        <div class="card border-0 shadow-sm p-5">
                                            <div
                                                class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                                <div class="flex-shrink-0">
                                                    <h4 class="mb-3">{{ $inc }}</h4>
                                                    <h2 class="fs-38 d-flex align-items-center gap-4">
                                                        {{ currency . $totalBalance }}
                                                        <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                            {{ currency . $totalBalance }}
                                                        </div>
                                                    </h2>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col col-lg-4">
                                <div class="card border-0 shadow-sm p-5">
                                    <div
                                        class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                        <div class="flex-shrink-0">
                                            <h4 class="mb-3">Wallet Balance</h4>
                                            <h2 class="fs-38 d-flex align-items-center gap-4">
                                                {{ currency . $wallet_balance['wallet_balance'] }}
                                                <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                    {{ currency . $wallet_balance['wallet_balance'] }}
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="card border-0 shadow-sm p-5">
                                    <div
                                        class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                        <div class="flex-shrink-0">
                                            <h4 class="mb-3">Paid Users</h4>
                                            <h2 class="fs-38 d-flex align-items-center gap-4">{{ $paid_users }}
                                                <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                    {{ $paid_users }}
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="card border-0 shadow-sm p-5">
                                    <div
                                        class="card-body p-0 d-flex align-items-center justify-content-between gap-5 flex-wrap flex-xl-nowrap">
                                        <div class="flex-shrink-0">
                                            <h4 class="mb-3">Today Paid Users</h4>
                                            <h2 class="fs-38 d-flex align-items-center gap-4">{{ $today_paid_users }}
                                                <div class="text-success fs-16"><i class="bi bi-caret-up-fill"></i>
                                                    {{ $today_paid_users }}
                                                </div>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col col-lg-6">
                                <div class="card border-0 shadow-sm pd-top-40 pd-bottom-40">
                                    <div class="card-body py-0">
                                        <h4 class="mb-3">Total Mail</h4>
                                        <div class="d-flex align-items-center gap-3 mt-3">
                                            <div class="flex-grow-1">
                                                <div class="progress rounded-1 bg-light-200 mb-2" role="progressbar"
                                                    aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
                                                    <div class="progress-bar bg-primary bg-gradient rounded-1"
                                                        style="width: 24%"></div>
                                                </div>
                                                <p class="text-gray mb-0"><span
                                                        class="text-danger fw-bold">{{ $pending_total_mail }}</span>
                                                    {{ $pending_total_mail }}</p>
                                            </div>
                                            <h2 class="fs-38"> {{ $pending_total_mail }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col col-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-transparent border-0 p-5 pb-2">
                                        <div>
                                            <h4>Projects Calendar</h4>
                                            <p class="text-gray mb-0">Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="flatpickr-inline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
