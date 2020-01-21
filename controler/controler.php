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
    $description = "Voici la liste de nos 10 modèles de snowbards actuellement proposés. Le principe ? Nous avons plusieurs snowboard du meme modèle et vous pouvez ainsi louer le modèle qui vous intéresse, si un des snowboards du modèle souhaité est disponible.";
    $listproducts = getProducts();

    require_once 'view/products.php';
}

function getsnowimg()
{
    var_dump($_FILES);

    /************************************************************
     * Script realise par Emacs
     * Crée le 19/12/2004
     * Maj : 23/06/2008
     * Licence GNU / GPL
     * webmaster@apprendre-php.com
     * http://www.apprendre-php.com
     * http://www.hugohamon.com
     *
     * Changelog:
     *
     * 2008-06-24 : suppression d'une boucle foreach() inutile
     * qui posait problème. Merci à Clément Robert pour ce bug.
     *
     *************************************************************/

    /************************************************************
     * Definition des constantes / tableaux et variables
     *************************************************************/

// Constantes
    define('TARGET', 'C:\Users\PC_Samuel_01\AppData\Local\Temp');    // Repertoire cible
    define('MAX_SIZE', 100000);    // Taille max en octets du fichier
    define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
    define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels

// Tableaux de donnees
    $tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
    $infosImg = array();

// Variables
    $extension = '';
    $message = '';
    $nomImage = '';

    /************************************************************
     * Creation du repertoire cible si inexistant
     *************************************************************/
    if (!is_dir(TARGET)) {
        if (!mkdir(TARGET, 0755)) {
            exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
        }
    }
    var_dump(is_dir(TARGET));
    var_dump($_POST);
    /************************************************************
     * Script d'upload
     *************************************************************/
    if (!empty($_POST)) {
        // On verifie si le champ est rempli
        if (!empty($_FILES['fichier']['name'])) {
            // Recuperation de l'extension du fichier
            $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $tabExt)) {
                // On recupere les dimensions du fichier
                $infosImg = getimagesize($_FILES['fichier']['tmp_name']);

                // On verifie le type de l'image
                if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                    // On verifie les dimensions et taille de l'image
                    if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
                        // Parcours du tableau d'erreurs
                        if (isset($_FILES['fichier']['error'])
                            && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                            // On renomme le fichier
                            $nomImage = md5(uniqid()) . '.' . $extension;

                            // Si c'est OK, on teste l'upload
                            if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {
                                $message = 'Upload réussi !';
                            } else {
                                // Sinon on affiche une erreur systeme
                                $message = 'Problème lors de l\'upload !';
                            }
                        } else {
                            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                        }
                    } else {
                        // Sinon erreur sur les dimensions et taille de l'image
                        $message = 'Erreur dans les dimensions de l\'image !';
                    }
                } else {
                    // Sinon erreur sur le type de l'image
                    $message = 'Le fichier à uploader n\'est pas une image !';
                }
            } else {
                // Sinon on affiche une erreur pour l'extension
                $message = 'L\'extension du fichier est incorrecte !';
            }
        } else {
            // Sinon on affiche une erreur pour le champ vide
            $message = 'Veuillez remplir le formulaire svp !';
        }
    }
    move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage);
    $title = $message;
    $description = var_dump($_POST);

    require_once 'view/createsnowboard.php';
}

function trylogin($email, $password)
{
    $_SESSION['failed'] = false;
    $listUsers = getUsers();
    foreach ($listUsers as $userinrun) {    //scanner toutes les personnes inscrites.
        if ($email == $userinrun['email'] && $password == $userinrun['password']) {
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $userinrun['firstname'] . " " . $userinrun['lastname'];
            $_SESSION['employe'] = $userinrun['employe'];
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

    //Si des champs sont remplis alors on a recu les informations du formulaire envoyé
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && $_POST['password'] == $_POST['password2'] && isset($_POST['birthdate']) && $_POST['haslawsaccepted'] == "on") {    //si tous les champs ont une valeur et qu'ils sont cohérent alors les informations sont valides.

        //Vérifier qu'un utilisateur n'a pas la meme adresse mail.
        $listUsers = getUsers();
        foreach ($listUsers as $userinrun) {    //scanner toutes les personnes inscrites.
            if ($_POST['email'] == $userinrun['email']) {   //si un user actuel a déjà la meme adresse email:
                $_SESSION['error'] = "emailalreadytaken";   //il y a une erreur de mail.
            }
        }

        //Traitement des valeurs booléen avec case à cocher:
        if ($_POST['wantnews'] == "on") {
            $wantnews = true;
        } else {
            $wantnews = false;
        }
        if ($_SESSION['error'] != "emailalreadytaken") {
            //On peut donc les stocker dans la liste des utilisateurs:
            addUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $wantnews);
            trylogin($_POST['email'], $_POST['password']);  //on peut directement connecter l'utilisateur
        } else {
            require_once 'view/createaccount.php'; //on doit recommencer le formulaire si erreur de mail.
        }

    } else {
        require_once 'view/createaccount.php';//sinon le formulaire n'a pas été rempli donc on affiche le formulaire
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
