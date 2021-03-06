<?php

function sidebar_anchor($subpage, $desired, $name, $href) { ?>
    
    <li class="nav-item">
    <a <?=$subpage == $desired ?
        'class="nav-link active" aria-current="page" href="#"' : 
        'class="nav-link" href="' . $href . '?subpage=' . $desired . '"'?>>
        <?= $name ?>
    </a>
    </li>

<?php } ?>