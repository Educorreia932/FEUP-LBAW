<?php function site_footer() { ?>
    <footer class="container-fluid mt-auto bg-dark py-2">
        <div class="row">
            <div class="ms-2 col">
                <div class="row align-items-center justify-content-start">
                    <img class="col-auto" src="../../static/logo.svg" height="60">
                    <h4 class="col-6 text-light">Trade-a-Bid</h4>
                </div>
                <span class="row text-muted">&copy; Copyright 2021 Trade-a-Bid. All rights reserved</span>
            </div>

            <div class="navbar navbar-dark col d-flex flex-column align-items-end text-end">    
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a class="nav-link" href="../pages/faq.php">FAQ</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="../pages/about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
<?php } ?>