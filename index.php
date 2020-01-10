<?php
session_start();

//prendre les valeurs du formulaire de login si rempli:
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}

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
    case "trylogin":
        trylogin();
        break;
    case "disconnect":
        disconnect();
        break;
    default:
        home();
        break;
}
?>
