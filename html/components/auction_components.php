<?php

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

