<?php
require_once 'model/model.php';

// This file contains nothing but functions

function home()
{
    $title = "Accueil de RentASnow";
    $description = "Bonne visite et locations ...";
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
        }
    }
    if (isset($_SESSION['user']) == false) {
        $_SESSION['failed'] = true;
    }

    require_once "view/home.php";
}

function disconnect()
{
    unset($_SESSION['user']);
    require_once "view/home.php";
}

function createaaccount()
{
    $title = "Créer un compte chez RentASnow";
    $description = "3 minutes pour remplir ce formulaire. Veuillez rentrer les informations suivantes qui serviront à créer votre compte...";
    require_once 'view/createaccount.php';
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
