@extends('layouts.app', ['title' => 'Log In'])

@section('content')
    
    <div class="container-fluid" style="flex:auto;">
        <section class="d-flex align-items-center justify-content-center">
            <div class="container-lg text-center">
                <form class="form-reset-password" method="POST" action="{{ route("password.update") }}">
                    @csrf
                
                    <h1 class="mb-3">Reset your password</h1>
                    
                    @if (Session::has('status'))
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">

                    <label for="inputEmail" class="sr-only float-start">Email*</label>
                    <input type="text" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" required>

                    <label for="password" class="sr-only float-start">New Password*</label>
                    <input type="password" id="password" class="form-control" name="password" required>

                    <label for="password-confirm" class="sr-only float-start">Comfirm Password*</label>
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required>

                    <button class="mt-2 mb-4 btn btn-lg btn-primary btn-block" type="submit">Reset password</button>

                    <div class="auth-pages-link">
                        <p>Already have an account? <a href="{{ route('login') }}" class="text-secondary">Sign in</a></p>
                        <p>Don't have an account? <a href="{{ route('register') }}" class="text-secondary">Sign up</a></p>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
