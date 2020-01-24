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

function createsnowmodele($modele, $marque)
{
    unset($message);
    $formtype = 0;
    if (isset($modele) == false && isset($marque) == false && isset($_SESSION['snowincreation']) == false) {   //si rien n'est envoyé alors première page.
        //Afficher formulaire pour modèle et marque:
        $title = "Ajouter un nouveau modèle de snowboard";
        $description = "Fonctionnalité uniquement pour les employés, qui sont autorisés à gérer le stock.";
        $formtype = 1;
    }
    if (isset($modele) && isset($marque) && isset($_SESSION['snowincreation']) == false) {
        //si le modèle n'existe pas dans sa marque:
        $listSnowsModeles = getProducts();
        foreach ($listSnowsModeles as $onemodel) {
            if ($onemodel['modele'] == $modele) {
                $formtype = 1;
                $title = "Erreur: le modèle " . $modele . " existe déjà !";
                $description = "";
                $message = "Vous ne pouvez pas insérer deux fois le même modèle, même sur une marque différente...";
            }
        }
        if ($formtype != 1) {
            //On peut enregistrer les valeurs.
            $_SESSION['snowincreation'] = [
                "modele" => $modele,
                "marque" => $marque,
                "filename" => "random"
            ];
            $title = "Ajout d'images au modèle " . $_SESSION['snowincreation']['modele'];
            $description = "Le modèle " . $_SESSION['snowincreation']['modele'] . " est en cours de création. Remplissez les dernières informations.";
            //Afficher formulaire pour l'image:
            $formtype = 2;
        }


    }
    if (isset($modele) == false && isset($marque) == false && isset($_SESSION['snowincreation'])) {
        $title = "Ajout d'images au snowboard " . $modele;
        $description = "Le modèle " . $modele . " est en cours de création. Remplissez les dernières informations.";
        //Afficher formulaire pour l'image:
        $formtype = 2;
    }
    if (isset($_SESSION['snowincreation']) && isset($_FILES[$_SESSION['snowincreation']['filename']])) {
        $title = "Nouveau modèle " . $_SESSION['snowincreation']['modele'] . " créé !";
        $description = "Le nouveau modèle de snow " . $_SESSION['snowincreation']['modele'] . " de la marque " . $_SESSION['snowincreation']['marque'] . " a été ajouté à la liste des modèles des snows.";
        $formtype = 3;  //le modèle a été créé. message de succès.

//Uploader l'image et déplacer vers dossier image:
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
        define('TARGET', $_SERVER['DOCUMENT_ROOT'] . "/view/images/");    // Repertoire cible
        define('MAX_SIZE', 10000000);    // Taille max en octets du fichier
        define('WIDTH_MAX', 3000);    // Largeur max de l'image en pixels
        define('HEIGHT_MAX', 3000);    // Hauteur max de l'image en pixels
        define('NOMUPLOAD', $_SESSION['snowincreation']['filename']);    //nom de l'upload. nom entrée dans $_FILES
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
        /************************************************************
         * Script d'upload
         *************************************************************/
        if (!empty($_FILES[NOMUPLOAD]['name'])) {
            // Recuperation de l'extension du fichier
            $extension = pathinfo($_FILES[NOMUPLOAD]['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $tabExt)) {
                // On recupere les dimensions du fichier
                $infosImg = getimagesize($_FILES[NOMUPLOAD]['tmp_name']);

                // On verifie le type de l'image
                if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                    // On verifie les dimensions et taille de l'image
                    if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES[NOMUPLOAD]['tmp_name']) <= MAX_SIZE)) {
                        // Parcours du tableau d'erreurs
                        if (isset($_FILES[NOMUPLOAD]['error'])
                            && UPLOAD_ERR_OK === $_FILES[NOMUPLOAD]['error']) {
                            // On renomme le fichier
                            $nomImage = $_SESSION['snowincreation']['modele'] . '.' . $extension;
                            if (file_exists(TARGET . $nomImage) == false) {
                                if (move_uploaded_file($_FILES[NOMUPLOAD]['tmp_name'], TARGET . $nomImage)) {
                                    $message = 'Upload réussi !';
                                    unset($_FILES[NOMUPLOAD]);  //ce fichier on en a plus besoin.
                                } else {
                                    // Sinon on affiche une erreur systeme
                                    $message = 'Problème lors de l\'upload !';
                                }
                            } else {
                                $message = "Une photo du même nom se trouve déjà dans le dossier de destination... Le modèle est déjà existant.";
                            }
                            // Si c'est OK, on teste l'upload
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

        }

        //Ajouter le modèle de snowboard:
        addSnowModel($_SESSION['snowincreation']['modele'], $_SESSION['snowincreation']['marque'], $_SESSION['snowincreation']['modele'] . $extension, $_SESSION['snowincreation']['modele'] . $extension);
        unset($_SESSION['snowincreation']);
    }


    require_once 'view/createsnowboard.php';
}

function trylogin($email, $password)
{
    $_SESSION['failed'] = false;
    $TheUser = getOneUser($email);
    if ($TheUser != "") {
        //si le mot de passe haché correspond au mot de passe donné:
        if (password_verify($password, $TheUser['password'])) {   //si le mot de passe correspond à l'adresse email
            $_SESSION['user'] = $email; //alors on enregistre la connexion dans la session.
            $_SESSION['name'] = $TheUser['firstname'] . " " . $TheUser['lastname']; //on prend aussi son prénom et nom
            $_SESSION['employe'] = $TheUser['employe'];   //on se enregistre si il est employé ou pas.
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
    unset($_SESSION['employe']);
    home();
}

function createaccount($firstname, $lastname, $email, $password, $password2, $birthdate, $haslawsaccepted, $wantnews)
{
    $title = "Créer un compte chez RentASnow";
    $description = "3 minutes pour remplir ce formulaire. Veuillez rentrer les informations suivantes qui serviront à créer votre compte...";

    //Si des champs sont remplis alors on a recu les informations du formulaire envoyé
    if (isset($firstname) && isset($lastname) && isset($email) && isset($password) && $password == $password2 && isset($birthdate) && $haslawsaccepted == "on") {    //si tous les champs ont une valeur et qu'ils sont cohérent alors les informations sont valides.
        $hash = password_hash($password, PASSWORD_DEFAULT); //hash du mot de passe
        //Vérifier qu'un utilisateur n'a pas la meme adresse mail.
        $listUsers = getUsers();
        foreach ($listUsers as $userinrun) {    //scanner toutes les personnes inscrites.
            if ($email == $userinrun['email']) {   //si un user actuel a déjà la meme adresse email:
                $_SESSION['error'] = "emailalreadytaken";   //il y a une erreur de mail.
            }
        }

        //Traitement des valeurs booléen avec case à cocher:
        if ($wantnews == "on") {
            $wantnews = true;
        } else {    //si wantnews n'est pas coché alors la valeur n'est pas envoyée.
            $wantnews = false;
        }
        if ($_SESSION['error'] != "emailalreadytaken") {
            //On peut donc les stocker dans la liste des utilisateurs:
            addUser($firstname, $lastname, $email, $hash, $birthdate, $wantnews);
            trylogin($email, $password);  //on peut directement connecter l'utilisateur
        } else {
            require_once 'view/createaccount.php'; //on doit recommencer le formulaire si erreur de mail.
        }

    } else {
        require_once 'view/createaccount.php';//sinon le formulaire n'a pas été rempli donc on affiche le formulaire
    }

}

function detailsproductsshow($modelesnow)
{
    $listproducts = getProducts();
    $title = "Détails de $modelesnow";
    $description = "Et vous pouvez ensuite louer !";

    require_once 'view/detailsproducts.php';
}

?>
