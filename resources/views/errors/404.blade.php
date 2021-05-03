@extends("layouts.app")

@section('content')

<section class='big-boy text-center d-flex flex-column justify-content-center'>
    <h1>404</h1>
    <h3>These are not the droids you're looking for<h3>

    {{-- <img class="pt-4" src='{{ asset('images/jerry.png') }}'
        style="width: 5em; height: 5em; clip-path: circle(49%);"> --}}

    <img class="pt-4" src='{{ asset('images/rick_roll.gif') }}'
        style="width: 10em; height: auto; clip-path: circle(50%);">

</section>

@endsection
