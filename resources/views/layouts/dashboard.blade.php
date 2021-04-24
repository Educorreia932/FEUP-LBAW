<?php
$current_page = "search_users";
?>

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    @include("partials.dashboard_sidebar")
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield("subpage")
            </main>
        </div>
    </div>
@endsection
