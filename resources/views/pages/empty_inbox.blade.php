@extends('layouts.app', ['title' => 'Inbox'])

@section("content")

<div class="row m-2">
    {{-- Breadcrumbs --}}
    <h1>Inbox</h1>
    @include("partials.breadcrumbs", [ "pages" => [
        ["title" => "Home", "href" => route('home')],
        ["title" => "Users", "href" => route('search_users')],
        ["title" => "me", "href" => route('user_profile', ['username' => Auth::user()->username])],
        ["title" => "Inbox", "href" => route('inbox')]
    ]])

    <hr>

</div>

<div class="big-boy align-items-center justify-content-center">
    <i class="bi bi-inbox" style="font-size: 10rem"></i>
    <h4>Your inbox seems to be empty!</h4>
    <h5 class="text-muted">Start a conversation by going to someone's profile and contacting them</h5>
</div>

@endsection
