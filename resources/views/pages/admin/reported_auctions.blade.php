@extends('layouts.admin_dashboard', ['sub' => 'reported_auctions'])

@section('page_head')
    <div class="my-4">
        @include("partials.breadcrumbs", [
            "title" => "Reported Auctions",
            "pages" => [
                ["title" => "Home", "href" => route('home') ],
                ["title" => "Dashboard", "href" => route('admin.dashboard') ],
                ["title" => "Reported Auctions", "href" => "."]
            ]
        ])
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
    </tr>
@endsection

@section('table_body')

    @foreach ($reports as $report)
    <tr class="auction-entry align-middle">
        <th scope="row" class="col-4">
            <a href="{{route("auction", ["id" => $report->auction_id])}}" class="text-decoration-none text-dark">{{$report->title}}</a>
        </th>
        <td>
            {{$report->reason}}
        </td>
        <td class="col-4">
            {{ $report->description}}
        </td>
        <td>
            {{\Carbon\Carbon::parse($report->timestamp)->format('d M Y')}}
        </td>
    </tr>
    @endforeach

@endsection
