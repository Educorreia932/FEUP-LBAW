<?php

function sidebar_anchor($subpage, $desired, $name, $href)
{ ?>

    <li class="nav-item">
        <a <?= $subpage == $desired ?
                'class="nav-link active hover-right" aria-current="page" href="#"' :
                'class="nav-link hover-right" href="' . $href . '?subpage=' . $desired . '"' ?>>
            <?= $name ?>
        </a>
    </li>

<?php } ?>