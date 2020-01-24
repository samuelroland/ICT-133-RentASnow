<?php
/**
 *  Projet: page myaccount.php pour afficher les informations du compte et ses options
 *  Author: Samuel Roland
 *  Creation date: Janvier 2020.
 */
ob_start();

$title = "Mon compte";
$description = "Affichage des informations de mon compte. La majorité de ces informations ont été données lors de l'inscription sur le site de RentASnow...";

?>
<br>
<h3>Informations :</h3>
<h4>Prénom: <?= $TheUser['firstname'] ?></h4>
<h4>Nom de famille: <?= $TheUser['lastname'] ?></h4>
<h4>Email: <em><?= $TheUser['email'] ?></em></h4>
<h4>Date de naissance: <?= date("d M Y", strtotime($TheUser['birthdate'])) ?></h4>
<h4>Inscrit à la newsletter: <?php if ($TheUser['wantnews'] == true) echo "Oui";
    else echo "Non"; ?></h4>
<h4>Employé de RentASnow: <?php if ($TheUser['employe'] == true) echo "Oui";
    else echo "Non"; ?></h4>
<a href="/?action=changeaccountpage">
    <div class="btn bg-info">Changer des informations</div>
</a>
<br><br>
<form action="/?action=deleteaccount" method="POST">
    <div class="" id="btndelete"><h2>Supprimer le compte ...</h2></div>
    <br>
    <p>Attention cet action est irréversible et nous avons donc besoin de confirmer votre identité.</p>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Supprimer définitivement mon compte" class="container btn-danger">
</form>
<?php
$content = ob_get_clean();

require "view/gabarit.php";
?>

