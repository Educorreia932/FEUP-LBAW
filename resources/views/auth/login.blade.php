@extends('layouts.app', ['title' => 'Log In'])

@section('content')

    <div class="container-fluid" style="flex:auto;">
        <section class="d-flex align-items-center justify-content-center">
            <div class="container-lg text-center">
                <form class="form-signin" method="POST" action="{{ route("login") }}">
                    @csrf

                    <h1 class="mb-3">Sign In</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <label for="inputEmail" class="sr-only float-start">Email/Username</label>
                    <input type="text" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" required>

                    <label for="inputPassword" class="sr-only float-start">Password</label>
                    <input type="password" id="inputPassword" class="form-control" name="password" required>

                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>

                    <div class="forgot-password-container ">
                        <a href="#" class="text-secondary">Forgot password?</a>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>

                <div class="options-separator">
                    <span class="divider-text text-black-50">Or</span>
                </div>

                <a class="btn btn-lg btn-secondary btn-block" type="button" href="{{ route("callback", [ "provider" => "github"]) }}">
                    <i class=" bi bi-github"></i>
                    Sign in with GitHub
                </a>

                <div class="m-2 text-secondary mt-3">
                    <p>
                        Dont have an account?
                        <a href="{{ route("register_form") }}" class="text-secondary fw-bold">
                            Sign up
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
