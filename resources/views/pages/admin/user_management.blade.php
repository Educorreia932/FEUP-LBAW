@extends('layouts.admin_dashboard', ['sub' => 'user_management'])

@section('subpage')
    <script defer src={{ asset("js/admin_dashboard_users.js") }}></script>

    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>User Management</h2>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => "/"],
                ["title" => "Dashboard", "href" => "/dashboard"]
            ]])
        </div>

        <div class="row">
            {{-- search section --}}
            <section class="col-12">
                {{-- search text input --}}
                <form action="{{route("admin.user_management")}}" id="search-form" method="GET" role="search" class="row">
                    <nav class="mb-4 col-10 d-flex flex-row">
                        {{-- Search bar --}}
                        <section class="container input-group w-50">
                            <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" name="fts" value="{{ old('fts') }}">
                            <button type="submit" class="input-group-text border-0" id="search-addon" >
                                <i class="bi bi-search"></i>
                            </button>
                        </section>
                    </nav>

                    {{-- filter options --}}
                    <div class="col-md-2">
                        <select class="form-select input-sm" name="filter">
                            <option {{ old('filter') ? "" : "selected" }}>All</option>
                            <option value="report" {{ old('filter') === "report" ? "selected" : "" }}>Reported</option>
                        </select>
                    </div>
                </form>
            <section>

            {{-- @each("partials.auction_entry", $auctions, "auction") --}}
            <div class="table-responsive col-12">
                <table class="table table-hover table-striped">
                <thead>
                    <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Restrictions</th>
                    <th scope="col">Restricted for</th>
                    <th scope="col">Account created</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Reported user entries --}}
                    @foreach ($reports as $report)
                        <tr class="user-entry align-middle" user_id="{{$report->member_id}}">
                            <th scope="row">{{$report->username}}</th>
                            <td class="master-checkbox-reverse">
                                @include('partials.check_admin_entry', ["name" => "Banned", "group" => "actions", "value" => "banned", "state" => $report->banned, "master" => true])
                                @include('partials.check_admin_entry', ["name" => "Create Auctions", "group" => "actions", "value" => "sell", "state" => $report->sell_permission, "disabled" => $report->banned])
                                @include('partials.check_admin_entry', ["name" => "Participate on auctions", "group" => "actions", "value" => "bid", "state" => $report->bid_permission, "disabled" => $report->banned])
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if ($report->reason)
                                        <span>{{$report->reason}}</span>
                                        <a href="#">See details »</a>
                                    @else
                                        <span class="text-muted">No reports</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{\Carbon\Carbon::parse($report->joined)->format('d M Y')}}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>  
        </div>  


        <nav class="d-flex justify-content-center my-4">
            {!! $reports->appends(request()->except('page'))->links() !!}
        </nav>
    </div>
@endsection