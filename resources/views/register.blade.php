<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8">
                <h4 class="text-center">Registration</h4>
                <form action="{{ route('post.register') }}" method="post" class="row">
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="label form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your Name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="label form-label">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email (optional)">
                    </div>
                    <div class="col-md-6">
                        <label for="nid" class="label form-label">NID number</label>
                        <input type="text" name="nid" class="form-control" placeholder="Enter your NID"
                            required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="center" class="label form-label">Vaccine Center</label>
                        <select name="center" class="form-select" required>
                            <option value=""></option>
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->center_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="time" class="label form-label">Vaccine Schedule</label>
                        <input type="datetime-local" name="time" required class="form-control">
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success">Check</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 mt-2">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>

</html>
