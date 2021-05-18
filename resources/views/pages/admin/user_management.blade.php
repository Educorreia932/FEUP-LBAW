@extends('layouts.dashboard', ['sub' => 'user_management'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>User Management</h2>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => "/"],
                ["title" => "Me", "href" => "/users/me"],
                ["title" => "Dashboard", "href" => "/dashboard"]
            ]])
        </div>

        <div>
            {{-- @each("partials.auction_entry", $auctions, "auction") --}}
            <div class="table-responsive">
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
                    {{-- @php for ($i = 0; $i < 5; $i++) {
                        <tr class="align-middle">
                            <th scope="row">markhamill69</th>
                            <td class="master-checkbox-reverse">
                            <
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span>Fraudulent Behaviour</span>
                                    <a href="#">See details »</a>
                                </div>
                            </td>
                            <td>12 feb 2021</td>
                        </tr>
                    }
                    @endphp --}}
                </tbody>
                </table>
            </div>
        </div>
    
    </div>
@endsection