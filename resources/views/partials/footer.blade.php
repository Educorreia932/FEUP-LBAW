<footer id="footer" class="container-fluid mt-auto bg-dark py-2 d-flex flex-row justify-content-between align-items-stretch">
    <div class="ms-1">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <h5 class="m-0 text-light">Trade-a-Bid</h5>
        </a>

        <div class="d-flex flex-column flex-sm-row">
            <p id="footer-copyright" class="m-0 text-muted font-weight-light" style="font-size: small;">&copy; Copyright 2021 Trade-a-Bid</p>
            <p class="m-0 text-muted font-weight-light" style="font-size: small;">All rights reserved</p>
        </div>
    </div>

    <div class="navbar navbar-dark text-end py-0">
        <ul class="navbar-nav d-flex flex-column flex-sm-row align-items-end justify-content-end">
            <li class="navbar-item my-1 mx-3">
                <a class="nav-link hover-scale py-0" href={{route('faq')}}>FAQ</a>
            </li>
            <li class="navbar-item my-1 mx-3">
                <a class="nav-link hover-scale py-0" href={{route('about')}}>About</a>
            </li>
        </ul>
    </div>
</footer>
