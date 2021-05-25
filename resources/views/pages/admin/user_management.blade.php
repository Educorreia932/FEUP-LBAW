@extends('layouts.admin_dashboard', ['sub' => 'user_management'])

@section('page_head')

    <script defer type="module" src={{ asset("js/admin_dashboard_users.js") }}></script>

    <div class="my-4">
        @include("partials.breadcrumbs", [
            "title" => "User Management",
            "pages" => [
                ["title" => "Home", "href" => route('home') ],
                ["title" => "Dashboard", "href" => route('admin.dashboard') ],
                ["title" => "User Management", "href" => "."]
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
        <th scope="col">Username</th>
        <th scope="col">Restrictions</th>
        <th scope="col">Restricted for</th>
        <th scope="col">Account created</th>
    </tr>
@endsection

@section('table_body')
    {{-- Reported user entries --}}
    @foreach ($reports as $report)
        <tr class="user-entry align-middle" user_id="{{$report->member_id}}">
            <th scope="row">
                <a href="{{route("user_profile", ["username" => $report->username])}}" class="text-decoration-none text-dark">{{$report->username}}</a>
            </th>
            <td class="master-checkbox-reverse">
                @include('partials.check_admin_entry', ["name" => "Banned", "group" => "actions", "value" => "banned", "state" => $report->banned, "master" => true])
                @include('partials.check_admin_entry', ["name" => "Create Auctions", "group" => "actions", "value" => "sell", "state" => $report->sell_permission, "disabled" => $report->banned])
                @include('partials.check_admin_entry', ["name" => "Participate on auctions", "group" => "actions", "value" => "bid", "state" => $report->bid_permission, "disabled" => $report->banned])
            </td>
            <td>
                <div class="d-flex flex-column">
                    @if ($report->reason)
                        <span>{{$report->reason}}</span>
                        <a class="text-decoration-none" href="{{route('admin.user_reports', ['username' => $report->username])}}">
                            <i class="bi bi-box-arrow-right"></i> See details
                        </a>
                    @else
                        <span class="text-muted">No reports</span>
                    @endif
                </div>
            </td>
            <td>{{\Carbon\Carbon::parse($report->joined)->format('d M Y')}}</td>
        </tr>
    @endforeach
@endsection
