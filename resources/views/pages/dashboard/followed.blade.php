@extends('layouts.dashboard', ['sub' => 'followed'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Followed</h2>
        </div>

        <div class="container">
            @each ("partials.user_entry", $followers, "member")
        </div>
    </div>
@endsection

