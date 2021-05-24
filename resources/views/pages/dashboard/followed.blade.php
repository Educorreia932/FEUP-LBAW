@extends('layouts.dashboard', ['sub' => 'followed', 'title' => 'Followed Users'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            @include("partials.breadcrumbs", [
                "title" => "Followed Users",
                "pages" => [
                    ["title" => "Home", "href" => route('home')],
                    ["title" => "Me", "href" => route('my_profile')],
                    ["title" => "Dashboard", "href" => route('dashboard')],
                    ["title" => "Followed Users", "href" => route('dashboard_followed')]
                ]
            ])
        </div>

        <div class="container">
            @foreach ($followers as $member)
                @include('partials.user_entry', ['member' => $member, 'last' => $loop->last])
            @endforeach
        </div>
    </div>
@endsection

