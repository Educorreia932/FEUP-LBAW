@extends('layouts.app', ['title' => 'Log In'])

@section('content')
    
    <div class="container-fluid" style="flex:auto;">
        <section class="d-flex align-items-center justify-content-center">
            <div class="container-lg text-center">
                <form class="form-forgot-password" method="POST" action="{{ route("password.email") }}">
                    @csrf
                
                    <h1 class="mb-3">Forgot your password?</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <label for="inputEmail" class="sr-only float-start">Email</label>
                    <input type="text" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" required>

                    <button class="mt-2 mb-4 btn btn-lg btn-primary btn-block" type="submit">Send recovery email</button>

                    <div class="auth-pages-link">
                        <p>Already have an account? <a href="{{ route('login') }}" class="text-secondary">Sign in</a></p>
                        <p>Don't have an account? <a href="{{ route('register') }}" class="text-secondary">Sign up</a></p>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
