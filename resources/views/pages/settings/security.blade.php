@extends('layouts.settings', ['active' => 'security'])

@section('subpage')
    <h2 class="my-4">Security</h2>

    <div class="col-lg-8 col-xl-6 mx-3 mx-md-0">
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
            <button type="button" class="btn btn-danger">Change Password</button>
        </div>
    </div>
@endsection
