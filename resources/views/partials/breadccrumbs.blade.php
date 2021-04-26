<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach (array_slice($pages, 0, count($pages) - 1) as $page)
            <li class="breadcrumb-item">
                <a href="{{ $page["href"] }}">{{ $page["title"] }}</a>
            </li>
        @endforeach

        <li class="breadcrumb-item active" aria-current="page">{{ end($pages)["title"] }}</li>
    </ol>
</nav>
