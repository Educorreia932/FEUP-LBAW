@extends('layouts.settings', ['active' => 'account', 'title' => 'Account'])

@section('subpage')
    <script defer src={{ asset("js/account_settings.js") }}></script>

    <div class="container-fluid">
        <h2 class="my-4">Account</h2>

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
            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
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

        <div class="row">
            <div class="container-fluid border rounded-3">
                <form id="account_form" action="{{ route('save_account_changes') }}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mt-2 justify-content-between">
                        <div class="col-lg-8 order-lg-2 big-boy">
                            <div class="row flex-grow-1">
                                <div class="col-12 col-sm-4 d-flex flex-column align-items-center justify-content-center">
                                    <img id="image-preview" class="img-fluid rounded-3 mb-2" @profilepic(Auth::user(), medium)>

                                    <input type="file" class="form-control" id="imageFile" name="image"/>
                                </div>

                                <div class="col-12 col-sm-8 d-flex justify-content-between flex-column">
                                    <div>
                                        <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                        <h6 class="mb-4 text-muted">{{ '@' . Auth::user()->username }}</h6>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="bio">Bio</label>
                                        <textarea class="form-control" name="bio" id="bio" rows="4" maxlength="500" placeholder="{{ Auth::user()::$default_bio }}" style="resize: none">{{ Auth::user()->bio }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 order-lg-1 d-flex flex-column justify-content-around">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" autocomplete="off" type="text" id="name" name="name" placeholder="{{ Auth::user()->name }}">
                            </div>

                            <label class="form-label" for="username">Username</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input autocomplete="off" type="text" class="form-control" id="username" name="username" placeholder="{{ Auth::user()->username}}"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group">
                                    <input autocomplete="email" class="form-control" type="text" id="email" name="email" placeholder="{{ Auth::user()->email }}">
                                    @if (!Auth::user()->email_verified_at)
                                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email not verified">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-danger bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        @if (!Auth::user()->email_verified_at)
            <div class="row">
                <div class="container-fluid my-4 border rounded">
                    <div class="row bg-light-grey border-rounded border-bottom">
                        <h4>Verify email</h4>
                    </div>
                    <div class="row">
                        <span>Your email is not verified. Please verify it to gain access to our features, if you can't find the email click the button to resend verification.</span>
                    </div>
                    <form id="email_verification" action="{{ route('verification.send') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger" >Resend Verification</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="container-fluid my-4 border rounded">
                <div class="row bg-light-grey border-rounded border-bottom">
                    <h4>Delete Account</h4>
                </div>
                <div class="row">
                    <span>Deleting your account means you cannot access it again. All your personal information will be lost. Think carefully before doing so.</span>
                </div>
                <div class="row">
                    <form action="{{ route('delete-account') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

