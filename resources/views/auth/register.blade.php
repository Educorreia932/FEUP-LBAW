@extends('layouts.app', ['title' => 'Register'])

@section('content')
    <div class="container-lg text-center">
        <form class="form-signup" method="post" action="{{ route("register") }}">
            @csrf

            <h1 class="mb-3">Sign Up</h1>
            <label for="username" class="sr-only float-start">Username*</label>
            <input type="text" id="username" class="form-control" name="username" required>

            <label for="name" class="sr-only float-start">Name*</label>
            <input type="text" id="name" class="form-control" name="name" required>

            <label for="email" class="sr-only float-start">Email*</label>
            <input type="email" id="email" class="form-control" name="email" required>

            <label for="phone" class="sr-only float-start">Phone Number</label>
            <input class="form-control" id="phone" name="phone" type="phone">

            <label for="password" class="sr-only float-start">Password*</label>
            <input type="password" id="password" class="form-control" name="password" required>

            <label for="password-confirm" class="sr-only float-start">Comfirm Password*</label>
            <input type="password" id="password-confirm" class="form-control" required>

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

        <a class="btn btn-lg btn-secondary btn-block" type="button"
           href="{{ route("auth_redirect", [ "provider" => "github"]) }}">
            <i class=" bi bi-github"></i>
            Sign up with GitHub
        </a>

        <div class="m-2 text-secondary mt-3 mb-5">
            <p>Already have an account?
                <a href="signin.php" class="text-secondary fw-bold">Sign in <i class="bi bi-arrow-right"></i></a>
            </p>
        </div>
    </div>
@endsection
