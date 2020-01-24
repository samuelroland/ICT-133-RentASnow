<?php
/**
 *  Projet: page createaccount.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */
ob_start();
$TheUser = getOneUser($_SESSION['user']);
$title = "Mon compte";
$description = "Les informations de mon compte";

?>
<h3>Prénom: <?= $TheUser['firstname'] ?></h3>
<h3>Nom de famille: <?= $TheUser['lastname'] ?></h3>
<h3>Email: <?= $TheUser['email'] ?></h3>
<h3>Date de naissance: <?= date("d M Y", strtotime($TheUser['birthdate'])) ?></h3>
<h3>Inscrit à la newsletter: <?php if ($TheUser['wantnews'] == true) echo "Oui";
    else echo "Non"; ?></h3>
<h3>Employé de RentASnow: <?php if ($TheUser['employe'] == true) echo "Oui";
    else echo "Non"; ?></h3><br>
<form action="/?action=deleteaccount" method="POST">
    <div class="" id="btndelete"><h2>Supprimer le compte ...</h2></div>
    <br>
    <p>Pour cela nous avons besoin de confirmer votre identité.</p>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Supprimer définitivement mon compte" class="container btn-danger">
</form>
<?php
$content = ob_get_clean();

require "view/gabarit.php";
?>

