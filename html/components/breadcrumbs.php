<?php

function breadcrumbs($pages, $hrefs) {
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php
                for ($i = 0; $i < count($pages) - 1; $i++) {
                    ?>
                    <li class="breadcrumb-item"><a href="<?=$hrefs[$i]?>"><?=$pages[$i]?></a></li>
                    <?php                
                }
                $final_page = end($pages);
                ?>
                <li class="breadcrumb-item active" aria-current="page"><?=$final_page?></li>
        </ol>
    </nav>
    <?php
}

?>