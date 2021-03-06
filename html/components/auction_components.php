<?php

function bid_table_entry($name, $bid, $time) {
    ?>
        <tr>
        <td> <?php
            if ($name != "Starting Bid") {
                echo '<i class="bi bi-person-circle ms-2" style="font-size: 1.2rem;"></i>';
            }
        ?> <?=$name?></td>
        <td><?=number_format($bid, 2)?> &euro;</td>
        <td><?=$time?></td>
        </tr>
    <?php
}

function bid_table_entry_indexed($index, $name, $bid, $time) {
    ?>
        <tr>
        <td><?=$index?></td>
        <td> <?php
            if ($name != "Starting Bid") {
                echo '<i class="bi bi-person-circle ms-2" style="font-size: 1.2rem;"></i>';
            }
        ?> <?=$name?></td>
        <td><?=number_format($bid, 2)?> &euro;</td>
        <td><?=$time?></td>
        </tr>
    <?php
}

function auction_detail($key, $value, $subgroup=false) {
    ?>
        <div class="row <?=$subgroup ? 'mt-3' : ''?>">
            <div class="col-6 col-md-5 col-lg-4 col-xl-3 col-xxl-2">
                <h6><?=$key?></h6>
            </div>
            <div class="col">
                <span><?=$value?></span>
            </div>
        </div>
    <?php
}

?>