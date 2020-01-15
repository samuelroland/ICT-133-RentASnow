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

function trylogin($username, $password)
{
    var_dump($username);
    var_dump($password);
    $listUsers = getUsers();
    foreach ($listUsers as $userinrun) {
        var_dump($userinrun['username']);
        var_dump($userinrun['password']);


        if ($username == $userinrun['username'] && $password == $userinrun['password']) {
            $_SESSION['username'] = $userinrun['username'];

        } else {
            unset($_SESSION['username']);
            home();
            die();
        }
        var_dump($_SESSION['username']);
    }

    require_once "view/home.php";
}

function disconnect()
{
    unset($_SESSION['username']);
    session_abort();
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
    } else {
        $title = "Aucun snow avec $modelesnow comme nom a été trouvé...";
        $description = "Pas tellement possible de louer du coup !";
    }

    require_once 'view/detailsproducts.php';
}

?>
