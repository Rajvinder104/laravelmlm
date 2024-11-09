@extends('User.layout.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="geex-content__wrapper">
                <div class="col-md-12 form-brand">
                    <div class="inner-contents">
                        <div class="heading">
                            <h4 class="user">{!! $header !!}</h4>
                        </div>

                        <form method="GET" action={{ $path }}>
                            <div class="row">
                                <div class="col-md-6">
                                    {!! $field !!}
                                </div>
                            </div>
                        </form>
                        <table class="table mt-3">
                            <thead>
                                {!! $thead !!}
                            </thead>
                            <tbody>
                                @foreach ($tbody as $key => $tbodys)
                                    {!! $tbodys !!}
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{ $users->links('Admin.pagination') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
