@extends('layouts.admin_dashboard', ['sub' => 'auction_management'])

@section('page_head')

    <script type="module" src={{ asset("js/admin_dashboard_auctions.js") }}></script>

    <div class="my-4">
        @include("partials.breadcrumbs", [
            "title" => "Auction Management",
            "pages" => [
                ["title" => "Home", "href" => route('home') ],
                ["title" => "Dashboard", "href" => route('admin.dashboard') ],
                ["title" => "Auction Management", "href" => "."]
            ]
        ])
    </div>
@endsection

@section('filter_options')
    {{-- filter options --}}
    <div class="col-md-2">
        <select class="form-select input-sm" name="filter">
            <option {{ old('filter') ? "" : "selected" }}>All</option>
            <option value="report" {{ old('filter') === "report" ? "selected" : "" }}>Reported</option>
        </select>
    </div>
@endsection

@section('columns')
    <tr>
        <th scope="col">Auction</th>
        <th scope="col">Status</th>
        <th scope="col">Restricted for</th>
        <th scope="col">Schedule</th>
    </tr>
@endsection

@section('table_body')
    {{-- Reported user entries --}}
    @foreach ($reports as $report)
        <tr class="auction-entry align-middle" id="{{$report->auction_id}}">
            <th scope="row" class="col-md-4 col-lg-4 col-3">
                <a href="{{route("auction", ["id" => $report->auction_id])}}" class="text-decoration-none text-dark">{{$report->title}}</a>
            </th>
            <td>
                {{-- Auction actions --}}
                <div class="form-check">
                    <input class="form-check-input active-input" id="{{"radio_active_" .$report->auction_id}}" type="radio" name="status_radio_{{$report->auction_id}}"
                    value="active" {{ $report->status === "Active" ? "checked" : ""}}>
                    <label class="form-check-label" for="{{"radio_active_" .$report->auction_id}}">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input term-input" type="radio" id="{{"radio_term_" . $report->auction_id}}" name="status_radio_{{$report->auction_id}}"
                    value="teminated" {{ $report->status === "Terminated" ? "checked" : ""}}>
                    <label class="form-check-label" for="{{"radio_term_" . $report->auction_id}}">
                        Terminated
                    </label>
                </div>
            </td>
            <td>
                {{-- Report details --}}
                <div class="d-flex flex-column">
                    @if ($report->reason)
                        <span>{{$report->reason}}</span>
                        <a class="text-decoration-none" href="{{ route('admin.auction_reports', ['id' => $report->auction_id]) }}">
                            <i class="bi bi-box-arrow-right"></i>  See details
                        </a>
                    @else
                        <span class="text-muted">No reports</span>
                    @endif
                </div>
            </td>
            <td>
                {{-- Start and end dates --}}
                <div class="d-flex flex-row" aria-labelledby="start_header">
                    <h6 id="start_header" class="me-2 fw-bold">Starts</h6>
                    {{\Carbon\Carbon::parse($report->start_date)->format('d M Y')}}
                </div>
                <div class="d-flex flex-row" aria-labelledby="end_header">
                    <h6 id="end_header" class="me-3 fw-bold">Ends</h6>
                    {{\Carbon\Carbon::parse($report->end_date)->format('d M Y')}}
                </div>
            </td>
        </tr>
    @endforeach
@endsection
