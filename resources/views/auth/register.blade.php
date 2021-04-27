@extends('layouts.app')

@section('content')
    <div class="container-lg text-center">
        <form class="form-signup" method="post" action="{{ route("register") }}">
            {{ csrf_field() }}

            <h1 class="mb-3">Sign Up</h1>
            <label for="inputUsername" class="sr-only float-start">Username*</label>
            <input type="text" id="inputUsername" class="form-control" name="username" required autofocus="">

            <label for="inputName" class="sr-only float-start">Name*</label>
            <input type="text" id="inputName" class="form-control" name="name" required autofocus="">

            <label for="inputEmail" class="sr-only float-start">Email*</label>
            <input type="email" id="inputEmail" class="form-control" name="email" required autofocus="">

            <label for="inputPhone" class="sr-only float-start">Phone Number</label>
            <input class="form-control" id="inputPhone" type="phone" name="phone">

            <label for="inputPassword"  class="sr-only float-start">Password*</label>
            <input type="password" id="inputPassword" class="form-control" name="password" required>

            <label for="confirmation" class="sr-only float-start">Comfirm Password*</label>
            <input type="password" id="confirmation" class="form-control" required>

            <div class="d-flex flex-row align-items-baseline text-start mt-2">
                <input type="checkbox" id="termsCheckbox" class="me-2" required>
                <label for="termsCheckbox"> I have read and agree with this site's
                    <a href="https://is.gd/TABNhT">terms of service</a>
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign Up</button>
        </form>

        <div class="options-separator">
            <span class="divider-text text-black-50">Or</span>
        </div>

        <button class="btn btn-lg btn-secondary btn-block" type="button">
            <i class=" bi bi-github"></i>
            Sign up with GitHub
        </button>

        <div class="m-2 text-secondary mt-3 mb-5">
            <p>Already have an account?
                <a href="signin.php" class="text-secondary fw-bold">Sign in <i class="bi bi-arrow-right"></i></a>
            </p>
        </div>
    </div>
@endsection
