<?php
session_start();    //démarrage du système de session.
var_dump($_SESSION['flashmessage']);
require "controler/controler.php";  //récupère les fonctions du controler.

//Récupérer l'action à executer de la querystring par GET
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

//Valeurs courantes et utilisées dans plusieurs fonctions:
if (isset($_POST['email'])) {   //email envoyé par POST
    $email = $_POST['email'];
} else {
    $email = $_SESSION['user']; //sinon l'email de la personne connecté.
}

if (isset($_POST['password'])) {    //mot de passe envoyé
    $password = $_POST['password'];
}


//Autres données propres aux actions:

//Détails d'un produit
if (isset($_GET['model'])) {
    $modelsnow = $_GET['model'];
}
//Création d'un produit
if (isset($_POST['newmodele']) && isset($_POST['newmarque'])) {
    $newmodele = $_POST['newmodele'];
    $newmarque = $_POST['newmarque'];
}
//Création d'un compte - extraction de tout $_POST
extract($_POST);    //extraire toutes les valeurs de $_POST, converti les clés en variables et met dedans les valeurs liées à ces clés.


//Selon l'action:
switch ($action) {
    case "displaySnows":    //Affichage de la liste de snowboards
        products();
        break;
    case "trylogin":    //tentatives de login
        trylogin($email, $password);
        break;
    case "disconnect":  //logout and unset the $_SESSION informations
        disconnect();
        break;
    case "createaccount":   //création d'un compte sur le site: affichage du formulaire ou traitement des données recues.
        if (isset($firstname, $lastname, $email, $password, $password2, $birthdate, $haslawsaccepted)) {    //si toutes les valeurs sont set.
            //Préparation des données des checkbox "on" ou rien (si off alors pas envoyé):
            $wantnews = isset($_POST['wantnews']);  //la checkbox n'est envoyée que si elle est cochée ! true si set, false si not set
            $haslawsaccepted = isset($_POST['haslawsaccepted']);    //vaut true de toute facon...

            //Ajout d'un utilisateur:
            createaccount($firstname, $lastname, $email, $password, $password2, $birthdate, $haslawsaccepted, $wantnews);
        } else {
            //sinon le formulaire n'a pas été envoyé donc rempli alors on affiche le formulaire
            require_once 'view/createaccount.php';
        }
        break;
    case "detailsproducts"; //affichage des détails d'un snow
        detailsproductsshow($modelsnow);
        break;
    case "createsnowmodele":    //créer un nouveau modèle de snows
        if (isset($newmarque)) { //si un des deux est set (les deux sont set car condition du GET)
            createsnowmodele($newmodele, $newmarque);
        }
        break;
    case "myaccount":   //Affichage des informations de mon compte.
        myaccount($email);
        break;
    case "deleteaccount":   //Suppression de mon compte
        if (isset($_SESSION['user'], $password)) {
            deleteaccount($_SESSION['user'], $password);
        }
        break;
    case "changeaccountpage":   //Affichage de la page pour modifier des informations de mon compte.
        changeaccountpage($email);
        break;
    case "changeaccountdata":
        changeaccountdata();
        break;
    default:
        home();
        break;
}
?>
