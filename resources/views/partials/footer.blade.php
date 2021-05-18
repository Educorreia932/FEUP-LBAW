<footer class="container-fluid mt-auto bg-dark py-2 d-flex flex-row justify-content-between align-items-end">
    <div class="ms-2">
        <a href="/" class="row align-items-center justify-content-start text-decoration-none">
            <img class="col-auto pe-0" src={{ asset('images/logo.svg') }} height="30">
            <h5 class="col-6 m-0 text-light">Trade-a-Bid</h5>
        </a>
        <span class="row text-muted" style="font-size: smaller">&copy; Copyright 2021 Trade-a-Bid. All rights reserved</span>
    </div>

    <div class="navbar navbar-dark text-end">
        <ul class="navbar-nav d-flex flex-row align-items-center">
            <li class="navbar-item">
                <a class="nav-link hover-scale" href={{route('faq')}}>FAQ</a>
            </li>
            <li class="navbar-item mx-2"><span class="nav-link">|</span></li>
            <li class="navbar-item">
                <a class="nav-link hover-scale" href={{route('about')}}>About</a>
            </li>
        </ul>
    </div>
</footer>
