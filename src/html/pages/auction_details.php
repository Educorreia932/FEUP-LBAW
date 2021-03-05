<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_components.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head('Home', $stylesheets); ?>

<body>
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <script defer src="../js/auction.js"></script>
    <script defer src="../js/bookmark.js"></script>
    <script defer src="../js/tooltip_initializer.js"></script>

    <main>
        <section class="container-fluid p-4">
            <div class="row">
                <span class="d-flex align-items-end">
                    <h3 class="m-0 p-0">Hollow Knight Steam Key</h3>
                    <a class="ms-2" style="font-size: smaller;" href="../pages/auction.php">Go back</a>
                </span>
                <hr class="my-1">

                <?php
                    auction_detail("Time remaining", "24 minutes 39 seconds", true);
                    auction_detail("Duration", "1 week");

                    auction_detail("Bidders", "3 different bidders", true);
                    auction_detail("Total Bids", "7 bids");

                    auction_detail("Starting Bid", "75.00 €", true);
                    auction_detail("Mandatory Bid Increment", "1.00 €");
                    auction_detail("Average Bid Increment", "15.00 €");
                ?>
            </div>
        </section>

        <section class="container-fluid p-4">
            <div class="row d-flex flex-row">
                <span class="d-flex align-items-end">
                    <h3 class="m-0 p-0">Bid History</h3>
                </span>
                <hr class="my-1">

                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="row col-lg-8 col-xl-6">
                            <canvas class="mt-4" id="bid-history-chart"></canvas>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="row col-lg-10 col-xl-8">
                            <table id="bid-history" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">Bid No</th>
                                    <th scope="col">Bidder</th>
                                    <th scope="col">Bid</th>
                                    <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        bid_table_entry_indexed(76, "Me", 180, "20 sec");

                                        for ($i = 0; $i < 75; $i++) {
                                            bid_table_entry_indexed(75 - $i, $i % 2 == 0 ? 'Y**p' : 'a**U', 15 + (10 - $i) * 15, strval($i + 1) . " hour");
                                        }

                                        bid_table_entry_indexed(0, "Starting Bid", 75, "1 week");
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php site_footer(); ?>
</body>

</html>
