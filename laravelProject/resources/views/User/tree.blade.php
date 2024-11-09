@extends('User.layout.layout')
<link rel="stylesheet" href="{{ asset('user/assets/css/tree.css') }}">
@section('content')
    @php
        use App\Providers\Helper\FormHelper as Form;
        $userinfo = userinfo();
        $bankinfo = bankinfo();
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="geex-content__wrapper">
                <div class="col-md-12 form-brand">
                    <div class="heading">
                        <h4>
                            {!! $header !!}
                        </h4>
                    </div>
                    <div class="treemain">
                        <ul class="clearfix">
                            <li class="main-node">
                                <div class="member-img">
                                    <a href="{{ route('tree', ['user_id' => $user['user_id']]) }}">
                                        <img
                                            src="{{ asset('storage/uploads/userimages') }}/{{ $user['paid_status'] == 1 ? 'active' : 'inactive' }}.png">
                                    </a>
                                    <br><span>{{ $user['name'] }} ({{ $user['user_id'] }})</span>
                                    <span>{{ $user['user_id'] }}</span>
                                    <span class="on-hover">
                                        User ID : {{ $user['user_id'] }} <br>
                                        User Name : {{ $user['name'] }} <br>
                                        Package Amount : {{ currency . $user['package_amount'] }} <br>
                                    </span>
                                </div>

                                <ul class="sub-tree clearfix">
                                    @foreach ($users as $direct)
                                        <li class="direct-node">
                                            <div class="member-img">
                                                <a href="{{ route('tree', ['user_id' => $direct->user_id]) }}">
                                                    <img
                                                        src="{{ asset('storage/uploads/userimages') }}/{{ $direct->paid_status == 1 ? 'active' : 'inactive' }}.png">
                                                </a>
                                                <br><span>{{ $direct->name }}</span>
                                                <span>{{ $direct->user_id }}</span>
                                                <span class="on-hover">
                                                    User ID : {{ $direct->user_id }} <br>
                                                    User Name : {{ $direct->name }} <br>
                                                    Package Amount : {{ currency . $direct->package_amount }} <br>
                                                </span>
                                            </div>

                                            <ul class="sub-tree clearfix">
                                                @foreach ($direct->sub_directs as $sub_direct)
                                                    <li class="sub-node">
                                                        <div class="member-img">
                                                            <a
                                                                href="{{ route('tree', ['user_id' => $sub_direct->user_id]) }}">
                                                                <img
                                                                    src="{{ asset('storage/uploads/userimages') }}/{{ $sub_direct->paid_status == 1 ? 'active' : 'inactive' }}.png">
                                                            </a>
                                                            <br><span>{{ $sub_direct->name }}</span>
                                                            <span>{{ $sub_direct->user_id }}</span>
                                                            <span class="on-hover">
                                                                User ID : {{ $sub_direct->user_id }} <br>
                                                                User Name : {{ $sub_direct->name }} <br>
                                                                Package Amount :
                                                                {{ currency . $sub_direct->package_amount }} <br>
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
