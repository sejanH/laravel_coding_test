<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Check Registration Status</h4>
                <form action="{{ route('check') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-10">
                        <input type="text" name="nid" class="form-control" placeholder="Enter your NID to check"
                            required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Check</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if (isset($status) && $status)
                <div class="col-md-6 mt-4 alert alert-info">
                    <strong>{{ $status }}</strong>
                    @if ($status == 'Not registered')
                        <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                    @elseif($status == 'Scheduled')
                        @ {{ $user->center->registered_at }}
                    @endif
                </div>
            @endif
        </div>
    </div>
</body>

</html>
