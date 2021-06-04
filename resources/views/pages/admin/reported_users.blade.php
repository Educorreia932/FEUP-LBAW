@extends('layouts.admin_dashboard', ['sub' => 'reported_users'])

@section('page_head')
    <div class="my-4">
        @include("partials.breadcrumbs", [
            "title" => "Reported Users",
            "pages" => [
                ["title" => "Home", "href" => route('home') ],
                ["title" => "Dashboard", "href" => route('admin.dashboard') ],
                ["title" => "Reported Users", "href" => "."]
            ]
        ])
    </div>
@endsection

@section('filter_options')
@endsection

@section('columns')
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Reported for</th>
        <th scope="col">Details</th>
        <th scope="col">Date</th>
        {{-- <th scope="col">Action</th> --}}
    </tr>
@endsection
@section('table_body')
    {{-- Reported user entries --}}
    @foreach ($reports as $report)
        <tr class="user-entry align-middle" id="{{$report->member_id}}">
            <th scope="row">
                <a href="{{route("user_profile", ["username" => $report->username])}}" class="text-decoration-none text-dark">{{$report->username}}</a>
            </th>
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