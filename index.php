<?php
session_start();
//prendre l'action voulue de la querystring
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
unset($_SESSION['error']);
if (isset($_SESSION['user']) == false) {
    unset($_SESSION['employe']);
}

//prendre les valeurs du formulaire de login si rempli:
if (isset($_POST['email']) && isset($_POST['password']) && $action=="trylogin") {
    $email = $_POST['email'];

    $password = $_POST['password'];

}
//Valeurs page accueil par défaut:
$title = "Accueil de RentASnow";
$description = "Bonne visite et locations ...";

require "controler/controler.php";  //récupère les fonctions du controler.



//détails d'un produit
if (isset($_GET['model'])) {
    $modelinget = $_GET['model'];
}
//Création d'un produit
if (isset($_POST['newmodele']) && isset($_POST['newmarque'])) {
    $newmodele = $_POST['newmodele'];
    $newmarque = $_POST['newmarque'];
}
//Création d'un compte
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['birthdate']) && isset($_POST['haslawsaccepted'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $birthdate = $_POST['birthdate'];
    $haslawsaccepted = $_POST['haslawsaccepted'];
    $wantnews = $_POST['wantnews'];
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
        createaccount($firstname, $lastname, $email, $password, $password2, $birthdate, $haslawsaccepted, $wantnews);
        break;
    case "detailsproducts";
        detailsproductsshow($modelinget);
        break;
    case "createsnowmodele":
        createsnowmodele($newmodele, $newmarque);
        break;
    case "myaccount":
        myaccount();
        break;
    default:
        home();
        break;
}

?>
