<?php
session_start();
unset($_SESSION['error']);
unset($_SESSION['employe']);
//prendre les valeurs du formulaire de login si rempli:
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
//Valeurs page accueil par défaut:
$title = "Accueil de RentASnow";
$description = "Bonne visite et locations ...";

require "controler/controler.php";

//prendre l'action voulue de la querystring
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case "displaySnows":
        products();
        break;
    case "trylogin":
        trylogin($email, $password);
        break;
    case "disconnect":
        disconnect();
        break;
    case "createaccount":
        createaccount();
        break;
    case "detailsproducts";
        detailsproductsshow();
        break;
    case "createsnowmodele":
        createsnowmodele();
        break;
    default:
        home();
        break;
}

?>
