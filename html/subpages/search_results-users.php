<?php
include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/user_entry.php");


function search_results_users_filters() { ?>
    
<?php } 


function search_results_users_results() {?>
    <div>
        <?php
        for ($i = 0; $i < 5; $i++) {
            draw_user_entry();

            if ($i < 4)
                echo "<hr>";
        }
        ?>
    </div>
<?php } ?>
