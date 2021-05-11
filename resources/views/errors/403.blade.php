@extends("layouts.app")

@section('content')

<section class='big-boy text-center d-flex flex-column justify-content-center'>

    <h1 class="mb-0">403</h1>
    <h5 class="text-muted">Forbidden<h5>
    <h3>It's over, @guest Anakin. @endguest @auth{{ Auth::user()->name }}. @endauth I have the High Ground.<h3>

    <img class="pt-4" src='{{ asset('images/errors/jerry.png') }}'
        style="width: 5em; height: 5em; clip-path: circle(50%);">

</section>

@endsection
