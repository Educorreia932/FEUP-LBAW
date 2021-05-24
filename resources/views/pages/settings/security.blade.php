@extends('layouts.settings', ['active' => 'security', 'title' => 'Security'])

@section('subpage')
    <h2 class="my-4">Security</h2>

    <div class="status-messages">
        @if (Session::has('success'))
        <div class="alert alert-success">
            <ul>
                @foreach(Session::get('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                @foreach(Session::get('error') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="col-lg-8 col-xl-6 mx-3 mx-md-0">
        <form action="{{ route('change_password') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="row">
                <label class="form-label" for="pwd">Current Password</label> <br>
                <input class="form-control" type="password" id="pwd" name="pwd">
            </div>
            <div class="row">
                <label class="form-label" for="pwd">New Password</label> <br>
                <input class="form-control" type="password" id="pwd-new" name="new-pwd">
            </div>
            <div class="row">
                <label class="form-label" for="pwd">Confirm Password</label> <br>
                <input class="form-control" type="password" id="pwd-confirmed" name="confirmed-pwd">
            </div>

            <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-danger">Change Password</button>
            </div>
        </form>
    </div>
@endsection
