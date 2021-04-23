@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="flex:auto;">
        <div class="row h-100">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">

                    <h4>Settings</h4>

                    <ul class="nav flex-column">

                    </ul>
                </div>
            </nav>

            <section class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield("subpage")
            </section>
        </div>
    </div>
@endsection
