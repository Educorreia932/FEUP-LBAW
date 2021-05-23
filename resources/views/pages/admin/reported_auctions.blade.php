@extends('layouts.dashboard', ['sub' => 'reported_auctions'])

@section('subpage')

    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Reported Auctions</h2>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => "/"],
                ["title" => "Dashboard", "href" => "/dashboard"]
            ]])
        </div>

        <div class="table-responsive col-12">
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">Auction</th>
                <th scope="col">Reported for</th>
                <th scope="col">Details</th>
                <th scope="col">Date</th>
                {{-- <th scope="col">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                {{-- Reported user entries --}}
                @foreach ($reports as $report)
                    <tr class="auction-entry align-middle">
                        <th scope="row" class="col-md-4">{{$report->title}}</th>
                        <td>
                            {{$report->reason}}
                        </td>
                        <td>
                            {{ $report->description}}
                        </td>
                        <td>{{\Carbon\Carbon::parse($report->timestamp)->format('d M Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>  


        <nav class="d-flex justify-content-center my-4">
            {!! $reports->appends(request()->except('page'))->links() !!}
        </nav>
    </div>
@endsection