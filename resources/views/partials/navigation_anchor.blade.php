<li class="nav-item col-6 col-md-auto px-0">
    @if (isset($current_page) and $current_page == $page_name)
        <a class="nav-link active" aria-current="page" href={{ route($route) }}>{{ $title }}</a>
    @else
        <a class="nav-link" href={{ route($route) }}>{{ $title }}</a>
    @endif
</li>
