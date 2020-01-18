<?php
require_once 'model/model.php';

// This file contains nothing but functions

function home()
{

    $news = getNews();
    require_once 'view/home.php';
}

function products()
{
    $title = "Liste des snowboards";
    $description = "Voici la liste de nos snowbards actuellement proposés. Certains sont loués mais vous pouvez voir jusqu'à quelle date et ainsi savoir si le snow souhaité sera disponible pour votre location.";
    $listproducts = getProducts();

    require_once 'view/products.php';
}

function trylogin($email, $password)
{
    $_SESSION['failed'] = false;
    $listUsers = getUsers();
    foreach ($listUsers as $userinrun) {    //scanner toutes les personnes inscrites.
        if ($email == $userinrun['email'] && $password == $userinrun['password']) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $userinrun['firstname'] . " " . $userinrun['lastname'];
        }
    }
    if (isset($_SESSION['user']) == false) {
        $_SESSION['failed'] = true;
    }

    home(); //au lieu d'afficher la vue home on utilise la fonction home() pour avoir les news avec.
}

function disconnect()
{
    unset($_SESSION['user']);
    unset($_SESSION['name']);
    home();
}

function createaccount()
{
    $title = "Créer un compte chez RentASnow";
    $description = "3 minutes pour remplir ce formulaire. Veuillez rentrer les informations suivantes qui serviront à créer votre compte...";

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && $_POST['password'] == $_POST['password2'] && isset($_POST['birthdate']) && $_POST['haslawsaccepted'] == true) {    //si tous les champs sont remplis et corrects alors on a recu les informations du formulaire envoyé et les informations sont valides.

        //Vérifier qu'un utilisateur n'a pas la meme adresse mail.
        $_SESSION['error'] = "";
        $listUsers = getUsers();
        foreach ($listUsers as $userinrun) {    //scanner toutes les personnes inscrites.
            if ($_POST['email'] == $userinrun['email']) {   //si un user actuel a déjà la meme adresse email:
                $_SESSION['error'] = "emailalreadytaken";   //il y a une erreur de mail.
            }
        }

        if ($_SESSION['error'] != "emailalreadytaken") {
            //On peut donc les stocker dans la liste des utilisateurs:
            addUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $_POST['wantnews']);

            trylogin($_POST['email'], $_POST['password']);  //on peut directement connecter l'utilisateur
        } else {
            require_once 'view/createaccount.php';  //on doit recommencer le formulaire si erreur de mail.
        }

    } else {
        require_once 'view/createaccount.php'; //sinon le formulaire n'a pas été rempli donc on affiche le formulaire
    }

}

function detailsproductsshow()
{
    $listproducts = getProducts();
    if (isset($_GET['model']) == true) {
        $modelesnow = $_GET['model'];
        $title = "Détails de $modelesnow";
        $description = "Et vous pouvez ensuite louer !";
    }

    require_once 'view/detailsproducts.php';
}

?>
