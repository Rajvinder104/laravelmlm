@extends('Admin/layout.layout2')
@section('content')
    {{ empty($export) ? ($export = false) : ($export = $export) }}
    <main class="main-wrapper">
        <div class="container-fluid">
            <div class="inner-contents">

                <h4 class="user">{!! $header !!}</h4>


                <form method="GET" action={{ $path }}>
                    <div class="row">
                        <div class="col-md-6">
                            {!! $field !!}
                        </div>
                        <div class="col-md-6">
                            <div class="text-end">
                                @if ($export == true)
                                    <a href="{{ $path . '?export=csv' }}" class="btn btn-success">Export as CSV</a>
                                    <a href="{{ $path . '?export=xls' }}" class="btn btn-primary">Export as Excel</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>

                <div class="table table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            {!! $thead !!}
                        </thead>
                        <tbody>
                            @foreach ($tbody as $key => $tbodys)
                                {!! $tbodys !!}
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{ $users->links('Admin.pagination') }}

                </div>
            </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).on('click', '.blockUser', function() {
            var status = $(this).data('status');
            var user_id = $(this).data('user_id');
            var url = '{{ route('blockStatus', ['user_id' => ':user_id', 'status' => ':status']) }}';
            url = url.replace(':user_id', user_id).replace(':status', status);
            $.get(url, function(res) {
                alert(res.message);
                if (res.success == 1) {
                    location.reload();
                }
            }, 'json');
        });
    </script>
@endsection
