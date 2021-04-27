@extends('layouts.app')

@section('content')
<div class="container-fluid big-boy">
    <div class="row big-boy flex-row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-light sidebar">
            <div class="position-sticky pt-3">

                <h4>Settings</h4>

                <ul class="nav flex-column">
                    @include("partials.sidebar_anchor", ['active' => $active == 'account', 'url' => route('settings_account'), 'name' => 'Account'])
                    @include("partials.sidebar_anchor", ['active' => $active == 'privacy', 'url' => route('settings_privacy'), 'name' => 'Privacy & Notifications'])
                    @include("partials.sidebar_anchor", ['active' => $active == 'security', 'url' => route('settings_security'), 'name' => 'Security'])
                </ul>
            </div>
        </nav>

        <section class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-4">
            @yield("subpage")
        </section>
    </div>
</div>
@endsection
