<?php
require_once 'model/model.php';

// This file contains nothing but functions

function home()
{
    $store = getStoreInfo();
    require_once 'view/home.php';
}
?>
