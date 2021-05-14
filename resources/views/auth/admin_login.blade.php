@extends('layouts.app')

@section('content')
    
    <div class="container-fluid" style="flex:auto;">

        <section class="d-flex align-items-center justify-content-center">
            <div class="container-lg text-center">
                <form class="form-signin" method="POST" action="{{ route("admin.login") }}">
                    @csrf
                
                    <h1 class="mb-3">Sign In</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <label for="inputEmail" class="sr-only float-start">Username</label>
                    <input type="text" id="inputEmail" class="form-control" name="username" value="{{ old('username') }}" required>

                    <label for="inputPassword" class="sr-only float-start">Password</label>
                    <input type="password" id="inputPassword" class="form-control" name="password" required>

                    <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Sign in</button>
                </form>
            </div>
        </section>
    </div>
@endsection
