@extends('layouts.admin_dashboard', ['sub' => 'reported_auctions'])

@section('page_head')
    <div class="my-4">
        <h2>Reported Auctions</h2>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => "/"],
            ["title" => "Dashboard", "href" => "/dashboard"]
        ]])
    </div>
@endsection

@section('filter_options')
@endsection

@section('columns')
    <tr>
        <th scope="col">Auction</th>
        <th scope="col">Reported for</th>
        <th scope="col">Details</th>
        <th scope="col">Date</th>
        {{-- <th scope="col">Action</th> --}}
    </tr>
@endsection

@section('table_body')

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

@endsection