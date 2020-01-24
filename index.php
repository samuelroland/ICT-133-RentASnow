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
if (isset($_POST['email'])){
    $email = $_POST['email'];
}else{
    $email = $_SESSION['user'];
}

//prendre les valeurs du formulaire de login si rempli:
if (isset($_POST['email']) && isset($_POST['password']) && $action == "trylogin") {
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
//fonction deleteaccount
if (isset($_POST['password']) && $action == "deleteaccount") {
    $password = $_POST['password'];
}
switch ($action) {
    case "displaySnows":    //Affichage de la liste de snowboards
        products();
        break;
    case "trylogin":    //tentatives de login
        trylogin($email, $password);
        break;
    case "disconnect":  //logout
        disconnect();
        break;
    case "createaccount":   //création d'un compte sur le site
        createaccount($firstname, $lastname, $email, $password, $password2, $birthdate, $haslawsaccepted, $wantnews);
        break;
    case "detailsproducts"; //affichage des détails d'un snow
        detailsproductsshow($modelinget);
        break;
    case "createsnowmodele":    //créer un nouveau modèle de snows
        createsnowmodele($newmodele, $newmarque);
        break;
    case "myaccount":   //Affichage des informations de mon compte.
        myaccount($email);
        break;
    case "deleteaccount":   //Suppression de mon compte
        var_dump($password);
        if (isset($_SESSION['user'], $password)) {
            deleteaccount($_SESSION['user'], $password);
        }
        var_dump($_SESSION);
        break;
    case "changeaccountpage":   //Affichage de la page pour modifier des informations de mon compte.
        changeaccountpage($email);
        break;
    case "changeaccountdata":
        changeaccountdata();
    default:
        home();
        break;
}

?>
