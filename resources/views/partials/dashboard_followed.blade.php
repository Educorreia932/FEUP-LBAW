<div class="container-fluid mb-4">
    <div class="my-4">
        <h2>Followed</h2>
    </div>

    <div class="container">
        @include("partials.user_entry", [
            "name" => "Jotaro Kujo",
            "username" => "starplatinum",
            "joined" => "12 feb 2020",
            "image" => "https://static.jojowiki.com/images/c/cd/latest/20201002224021/Jotaro6Av.png",
            "rating" => 1567,
            "is_following" => true
        ])
    </div>
</div>
