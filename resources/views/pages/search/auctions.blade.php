<?php
$current_page = "search_auctions";
?>

@extends("layouts.search")

@section("results")
    @each("partials.auction_entry", $auctions, "auction")
@endsection

