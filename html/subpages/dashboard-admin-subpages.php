<?php

include_once(__DIR__ . "/../components/breadcrumbs.php");
include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/user_entry.php");

function dashboard_breadcrumbs() {
    breadcrumbs(array("Home", "Admin"), array("home.php"));
}

function dashboard_user_management() { ?>
    <script defer src="../js/master_checkboxes.js"></script>

    <div class="container-fluid">
        <div class="my-4">
            <h2>User Management</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

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
                <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr class="align-middle">
                    <th scope="row">markhamill69</th>
                    <td class="master-checkbox-reverse">
                    <?php
                        filter_checkbox("Banned", "a", true, true);
                        filter_checkbox("Sell", "b");
                        filter_checkbox("Bid", "c");
                    ?>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span>Fraudulent Behaviour</span>
                            <a href="#">See details »</a>
                        </div>
                    </td>
                    <td>12 feb 2021</td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
<?php }

function dashboard_reported_users() { ?>
    <div class="container-fluid">
        <div class="my-4">
            <h2>Reported Users</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">Username</th>
                <th scope="col">Reported for</th>
                <th scope="col">Details</th>
                <th scope="col">Report Date</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr class="align-middle">
                    <th scope="row">markhamill69</th>
                    <td>Fraudulent Behaviour</td>
                    <td>Improper username</td>
                    <td>12 feb 2021</td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
<?php }

function dashboard_auction_management() { ?>
    <div class="container-fluid">
        <div class="my-4">
            <h2>Auction Management</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">Auction</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Scheduled</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr class="align-middle">
                    <th scope="row">
                        <span>Silksong Steam Key</span>
                    </th>
                    <td>
                    <?php
                        filter_radio("Terminated", "radio-auction-" . $i . "-status", "a");
                        filter_radio("Frozen", "radio-auction-" . $i . "-status", "b");
                        filter_radio("Canceled", "radio-auction-" . $i . "-status", "c", false, true);
                        filter_radio("Active", "radio-auction-" . $i . "-status", "b", true);
                    ?>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="text-muted">No reports</span>
                            <!-- <a href="#">See details »</a> -->
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <span><span class="fw-bold" style="font-size: x-small;">Starts</span> 22 feb 2021 23:59</span>
                            <span><span class="fw-bold" style="font-size: x-small;">Ends</span> 23 feb 2021 23:59</span>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
<?php }

function dashboard_reported_auctions() { ?>
    <div class="container-fluid">
        <div class="my-4">
            <h2>Reported Auctions</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>        

        <div class="table-responsive">
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">Auction</th>
                <th scope="col">Reported for</th>
                <th scope="col">Details</th>
                <th scope="col">Report Date</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr class="align-middle">
                    <th scope="row">Silksong Steam Key</th>
                    <td>Fraudulent Behaviour</td>
                    <td>Attempt to sell an unreleased game key</td>
                    <td>12 feb 2021</td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
<?php } ?>