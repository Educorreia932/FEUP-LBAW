<ul class="nav flex-column">
    @include("partials.sidebar_anchor", [ "name" => "Created Auctions", "url" => route("dashboard_created_auctions")])
    @include("partials.sidebar_anchor", [ "name" => "Bidded Auctions", "url" => route("dashboard_bidded_auctions")])
    @include("partials.sidebar_anchor", [ "name" => "Bookmarked Auctions", "url" => route("dashboard_bookmarked_auctions")])
    @include("partials.sidebar_anchor", [ "name" => "Followed", "url" => route("dashboard_followed")])
</ul>
