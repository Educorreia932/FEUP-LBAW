<div class="d-flex mx-1 flex-column justify-content-between" style="min-width: 160px;">
    <div>
        <div style="width: 140px; height: 140px;">
            <img src="{{ $img }}" class="h-100 w-100" style="border-radius: 50%; object-fit: cover;">
        </div>

        <div class="mb-2">
            <h2 class="m-0">{{ $name }}</h2>
            <span>&commat;{{ $username }}</span>
        </div>
        <h6>Developer & Designer</h6>
    </div>
    <p>
        <a class="btn btn-secondary w-100" href={{ "https://github.com/" . $username }}>
            <i class="bi bi-github me-1"></i>
            View Profile »
        </a>
    </p>
</div>
