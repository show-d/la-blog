@extends('layouts.default')

@section('body')
    @if ($success)
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @else
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    @if($url != '')
        <p>
           <b> {{$seconds}}秒后跳转到 [{{$url}}]。</b>

            <script type="text/javascript">
                var secs = {{$seconds}} * 1000;
                setTimeout(function () {
                    location.href = '{{$url}}';
                }, secs)
            </script>
        </p>
    @endif

    <p>
        <input type="button" onclick="history.back()" value="返回"/>
    </p>
@endsection


@section('javacript')



@endsection
