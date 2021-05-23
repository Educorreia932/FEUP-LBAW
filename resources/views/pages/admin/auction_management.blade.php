@extends('layouts.admin_dashboard', ['sub' => 'auction_management'])

@section('page_head')

    <script defer src={{ asset("js/admin_dashboard_auctions.js") }}></script>

    <div class="my-4">
        <h2>Auction Management</h2>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => "/"],
            ["title" => "Dashboard", "href" => "/dashboard"]
        ]])
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
        <tr class="auction-entry align-middle" auction_id="{{$report->auction_id}}">
            <th scope="row" class="col-md-4 col-lg-4 col-3">{{$report->title}}</th>
            <td>
                <div class="form-check">
                    <input class="form-check-input active-input" type="radio" name="status_radio_{{$report->auction_id}}"
                    value="active" {{ $report->status === "Active" ? "checked" : ""}}>
                    <label class="form-check-label" for="radio_active">
                        Active
                    </label>
                </div>
                <input class="form-check-input term-input" type="radio" name="status_radio_{{$report->auction_id}}"
                value="teminated" {{ $report->status === "Terminated" ? "checked" : ""}}>
                    <label class="form-check-label" for="radio_term">
                        Terminated
                    </label>
                <div class="form-check">
                    
                </div>
            </td>
            <td>
                <div class="d-flex flex-column">
                    @if ($report->reason)
                        <span>{{$report->reason}}</span>
                        <a href="{{route('admin.auction_reports', ['id' => $report->auction_id])}}">See details »</a>
                    @else
                        <span class="text-muted">No reports</span>
                    @endif
                </div>
            </td>
            <td>
                <span class="d-flex flex-row">
                    <h6 class="me-2 fw-bold">Starts</h6>
                    {{\Carbon\Carbon::parse($report->start_date)->format('d M Y')}}
                </span>
                <span class="d-flex flex-row">
                    <h6 class="me-3 fw-bold">Ends</h6>
                    {{\Carbon\Carbon::parse($report->end_date)->format('d M Y')}}
                </span>
            </td>
        </tr>
    @endforeach
@endsection