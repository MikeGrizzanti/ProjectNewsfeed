<?php

function is_loggedIn() {
    $erg = false;
    if (isset($_SESSION['id'])) {
        if (!empty($_SESSION['id']))
            $erg = true;
    }
    return $erg;
}

