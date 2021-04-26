<?php
$current_page = "search_users";
?>

@extends("layouts.search")

@section("results")
    @each("partials.user_entry", $members, "member")
@endsection
