@extends('User.layout.layout')
@section('content')
    @php
        $userinfo = userinfo();
    @endphp
    <div class="geex-content__wrapper">
        <div class="geex-content__section-wrapper">
            <div class="geex-content__feature mb-40">
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">E-wallet</p>
                        <h4 class="geex-content__feature__card__title">
                            Total: <span class="text-primary"> {{ currency }}
                                {{ $wallet_balance['wallet_balance'] }}</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Total Income</p>
                        <h4 class="geex-content__feature__card__title">
                            Total: <span class="text-primary"> {{ currency }}
                                {{ $total_income['total_income'] }}</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Total Members</p>
                        <h4 class="geex-content__feature__card__title">
                            <span class="text-primary"> {{ $Paidteam->team + $UnPaidteam->team }}</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Active Members</p>
                        <h4 class="geex-content__feature__card__title">
                            <span class="text-success"> {{ $Paidteam ? $Paidteam->team : 0 }}</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Inactive Members</p>
                        <h4 class="geex-content__feature__card__title">
                            <span class="text-danger"> {{ $UnPaidteam ? $UnPaidteam->team : 0 }}</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>

            </div>
            <div class="geex-content__feature mb-40">

                @php
                    $incomes = configArray('incomes');
                @endphp

                @foreach ($incomes as $key => $inc)
                    @php
                        $startOfDay = today()->startOfDay();
                        $endOfDay = today()->endOfDay();

                        $getBalance = get_single_record(
                            'tbl_income_wallet',
                            ['user_id' => session('user_id'), 'type' => $key],
                            'ifnull(sum(amount), 0) as balance',
                        );

                        $getBalanceToday = get_single_record(
                            'tbl_income_wallet',
                            [
                                'user_id' => session('user_id'),
                                'type' => $key,
                                'created_at' => [$startOfDay, $endOfDay],
                            ],
                            'ifnull(sum(amount), 0) as balance',
                        );
                        // dd($getBalanceToday['balance']);
                        // die();
                        $totalBalance = $getBalance['balance'] ?? 0;
                        $todayBalance = $getBalanceToday['balance'] ?? 0;
                    @endphp

                    <div class="geex-content__feature__card">
                        <div class="geex-content__feature__card__text">
                            <p class="geex-content__feature__card__subtitle">{{ $inc }}</p>
                            <h4 class="geex-content__feature__card__title">
                                Total: <span class="text-primary"> {{ currency }} {{ $totalBalance }}</span>
                            </h4>
                            <h4 class="geex-content__feature__card__title">
                                Today: <span class="text-success">{{ currency }} {{ $todayBalance }}</span>
                            </h4>
                        </div>
                        <div class="geex-content__feature__card__img">
                            <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="geex-content__feature mb-40">
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Total Team</p>
                        <h4 class="geex-content__feature__card__title">
                            Team: <span class="text-primary">
                                0</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
                <div class="geex-content__feature__card">
                    <div class="geex-content__feature__card__text">
                        <p class="geex-content__feature__card__subtitle">Paid Team</p>
                        <h4 class="geex-content__feature__card__title">
                            paid: <span class="text-primary">
                                0</span>
                        </h4>
                    </div>
                    <div class="geex-content__feature__card__img">
                        <img src="user/assets/img/feature/feature-2.svg" alt="feature" />
                    </div>
                </div>
            </div>



            <div class="geex-content__section geex-content__section--transparent geex-content__review">
                <div class="geex-content__section__header">
                    <div class="geex-content__section__header__title-part">
                        <h4 class="geex-content__section__header__title">User Details</h4>
                        <p class="geex-content__section__header__subtitle">Eum fuga consequuntur ut et.</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="custom_card">

                            <div class="heading w-100">
                                <h4> user details</h4>
                            </div>

                            <ul>
                                <li class="detailsusers">
                                    <div class="detaillable">
                                        Name
                                    </div>
                                    <div class="detailsvalue">
                                        {{ $userinfo['name'] }}
                                    </div>
                                </li>
                                <li class="detailsusers">
                                    <div class="detaillable">
                                        User Id
                                    </div>
                                    <div class="detailsvalue">
                                        {{ $userinfo['user_id'] }}
                                    </div>
                                </li>
                                <li class="detailsusers">
                                    <div class="detaillable">
                                        Package Amount
                                    </div>
                                    <div class="detailsvalue">
                                        {{ $userinfo['package_amount'] }}
                                    </div>
                                </li>
                                <li class="detailsusers">
                                    <div class="detaillable">
                                        Activation Date
                                    </div>
                                    <div class="detailsvalue">
                                        {{ formatDate($userinfo['topup_date']) }}
                                    </div>
                                </li>
                                <li class="detailsusers">
                                    <div class="detaillable">
                                        Status
                                    </div>
                                    <div class="detailsvalue">
                                        {!! $userinfo['paid_status']
                                            ? '<span class="badge bg-success btn-xs">Active</span>'
                                            : '<span class="badge bg-danger btn-xs">Inactive</span>' !!}
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="col-md-6 grid">
                        <div class="custom_card">
                            <div class="heading w-100">
                                <h4>news</h4>
                            </div>
                            <div class="newsdetails">
                                @foreach ($news as $rec)
                                    <marquee behavior="2" direction="left">{{ $rec->news }}</marquee>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="custom_card">

                            <div class="heading w-100">
                                <h4>Referal Link</h4>
                            </div>

                            <div class="">
                                <div class="display_flex flex-direction reffral-code w-100 trans__adsd">
                                    <input type="text" id="linkTxt"
                                        value="{{ url('/register/?sponsor=' . $userinfo['user_id']) }}" readonly
                                        class="form-control custom-form">

                                    <button id="btnCopy" class="btn d-block copy_btns" onclick="copyToClipboard()">
                                        Copy link
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="geex-content__section geex-content__section--transparent geex-content__review mt-5">
                <div class="geex-content__section__header">
                    <div class="geex-content__section__header__title-part">
                        <h4 class="geex-content__section__header__title">Rewards</h4>
                        <p class="geex-content__section__header__subtitle">This Is For You After Acchivements </p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <div class="custom_card">
                                <div class="heading w-100">
                                    <h4 class="p-0">Rewards</h4>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rank</th>
                                            <th>Amount</th>
                                            <th>Reward</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $rewards = ConfigArray('reward');
                                        @endphp
                                        @foreach ($rewards as $key => $reward)
                                            @php
                                                $checkstatus = get_single_record(
                                                    'tbl_rewards',
                                                    [
                                                        'award_id' => $key,
                                                        'user_id' => session('user_id'),
                                                    ],
                                                    '*',
                                                );

                                            @endphp
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $reward['Rank'] }}</td>
                                                <td>{{ currency . $reward['business'] }}</td>
                                                <td>{{ currency . $reward['Reward'] }}</td>
                                                <td>
                                                    @if (!empty($checkstatus))
                                                        {!! badge_success('Achieved') !!}
                                                    @else
                                                        {!! badge_warning('Pending') !!}
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($popup['status'] == 1)
        <div class="modal fade justify-content-center" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $popup['caption'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            fdprocessedid="mhmwvk"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $popup['media']) }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
