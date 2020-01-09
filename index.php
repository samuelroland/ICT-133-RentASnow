<?php

require "controler/controler.php";

//prendre l'action voulue de la querystring
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case "home":
        home();
    case "displaySnows":
        products();
        break;
    default:
        home();
        break;
}
?>
