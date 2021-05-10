@extends("layouts.app")

@section('content')

<section class='big-boy text-center d-flex flex-column justify-content-center'>
    <h1>404</h1>
    <h3>These are not the droids you're looking for<h3>

    <img class="pt-4" src='{{ asset('images/errors/rick_roll.gif') }}'
        style="width: 10em; height: auto; clip-path: circle(50%);">

</section>

@endsection
