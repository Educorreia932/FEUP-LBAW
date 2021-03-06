<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
<?php site_head('FAQ', $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">

        <?php site_header(null, "page_faq"); ?>

        <main class="container-fluid p-4" style="flex:auto;">
            <h1 class="mb-4">Frequently Asked Questions</h1>
            
            <div class="mx-4">
                <section class="my-2">
                    <h2 id="general">General Questions</h2>

                    <div class="p-1 ps-3">
                        <div class="hover-border ps-2">
                            <h4>Which items can I sell?</h4>
                            <p>You can sell any digital item on this platform. Physical items that might require shipping should NOT be sold here.</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>How do I create an auction?</h4>
                            <p>If you are logged in you can go <a href="../pages/create_auction.php">here</a>, add the name and description of your item, alongside some images to help you stand out and you're good to go!</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>I've won an auction but my product is invalid!</h4>
                            <p>Please report the user using the report system and immediately contact one of our admins.</p>
                        </div>
                    </div>
                </section>

                <section class="my-2">
                    <h2 id="auctions">Auctions</h2>

                    <div class="p-1 ps-2">
                        <div class="hover-border ps-2">
                            <h4>Can I control how long an auction lasts?</h4>
                            <p>When creating an auction you can customize the length of your auction (wihtin certain limits).</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>Is there a minimum bid?</h4>
                            <p>All auctions have a starting bid that must be met.</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>Is there a mandatory minimum increment in bids?</h4>
                            <p>Some auctions may have a mandatory increment in value between bids, in which case that increment must be included in the next bid.</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>Can auctions be sniped?</h4>
                            <p>We have an anti-sniping system implemented, so anytime a bid is made within 30 seconds of an auction closing, its duration will be extended for another minute.</p>
                        </div>
                    </div>
                </section>

                <section class="my-2">
                    <h2 id="account">Account</h2>

                    <div class="p-1 ps-3">
                        <div class="hover-border ps-2">
                            <h4>How can I update my email/password?</h4>
                            <p>You can go to your 'settings > account' page and update them there.</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>I want to delete my account but I can't</h4>
                            <p>Please check if you have any open auctions under your account, as accounts with open auctions may not be deleted. If any other problems surge, please don't hesitate to contact an admin. </p>
                        </div>
                    </div>
                </section>

                <section class="my-2">
                    <h2 id="balance">Balance</h2>

                    <div class="p-1 ps-3">
                        <div class="hover-border ps-2">
                            <h4>How do bids affect my balance?</h4>
                            <p>Each member has a certain number of coins they can spend on bids. After they make a bid, that portion of their balance will be held by the platform until the auction ends. If you are not the winner of the auction, the value of your bid will be returned to your balance.</p>
                        </div>
                        
                        <div class="hover-border ps-2">
                            <h4>How do I add money to my balance?</h4>
                            <p>You don't! Just ask an admin for more :slight_smile:</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>How will I receive the items I bought?</h4>
                            <p>When an auction ends, if you made the winning bid you will receive an email with your download or product key.</p>
                        </div>
                    </div>
                </section>

                <section class="my-2">
                    <h2 id="others">Others</h2>

                    <div class="p-1 ps-3">
                        <div class="hover-border ps-2">
                            <h4>I'm stuck in a paralel dimension HELP</h4>
                            <p>Not much we can do there pal.</p>
                        </div>

                        <div class="hover-border ps-2">
                            <h4>What is the meaning of life?</h4>
                            <p>42.</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <?php site_footer(); ?>

        <script src="https://cdn.jsdelivr.net/npm/anchor-js/anchor.min.js"></script>
        <script>
            anchors.options = {
                placement: 'left',
                visible: 'always'
            };
            anchors.add('h2');
        </script>

    </body>
</html>