<li class="nav-item">
    @if ($current_page == $page_name)
        <a class="nav-link active" aria-current="page" href={{ route($page_name) }}>{{ $title }}</a>
    @else
        <a class="nav-link" href={{ route($page_name) }}>{{ $title }}</a>
    @endif
</li>
