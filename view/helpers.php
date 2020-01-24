<?php
/**
 *  Projet: page helpers.php pour les fonctions de génération spéciales de contenus
 *  Author: Samuel Roland
 *  Creation date: Janvier 2020.
 */

function flashMessage() //Affichage du message flash. inspiré de christopher.
{
    if (isset($_SESSION["flashmessage"])) { //si il existe un message flash à afficher
        //Selon le numéro du message, on affiche le flashmessage correspondant:
        switch ($_SESSION['flashmessage']) {
            case 1:
                $message = "Les identifiants de connexion ne concordent pas. Veuillez retenter la connexion.";
                break;
            case 2:
                $message = "Cet email est déjà utilisé par un autre utilisateur... Veuillez recommencer avec un autre email.";
                break;
            case 3:
                $message = "Action non autorisée avec ces permissions... mêlez vous de vos oignons.";
                break;
            case 4:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
        }
        $content = "<div id='flashmessage' class='alert alert-danger'>" . $message . "</div>";
    }
    unset($_SESSION["flashmessage"]);   //après avoir affiché le message, le message ne doit pas réapparaitre.
    return $content;
}

?>

