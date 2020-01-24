<?php
/**
 *  Projet: page changeaccountpage.php pour afficher la page pour changer les informations du compte
 *  Author: Samuel Roland
 *  Creation date: Janvier 2020.
 */
ob_start();

$title = "Modification du compte";
$description = "Effectuer les modifications des informations de mon compte. Certaines informations ne sont pas possibles de modifier, tel que l'email et si la personne est un employé ou pas";

?>

<form action="/?action=changeaccountdata" method="POST">
    <h3>Modifications :</h3>
    <div class="row">
        <h4 class="col-6 ">Prénom: <?= $TheUser['firstname'] ?></h4><input class="col-6 form-control" type="text"
                                                                           name="firstname">
        <h4 class="col-6">Nom de famille: <?= $TheUser['lastname'] ?></h4><input class="col-6 form-control" type="text"
                                                                                 name="lastname">
        <h4 class="col-6 ">Email: <em><?= $TheUser['email'] ?></em></h4><span
                class="col-6 form-control">Non modifiable</span>
        <h4 class="col-6 ">Date de naissance: <?= date("d M Y", strtotime($TheUser['birthdate'])) ?></h4><input
                class="col-6 form-control" type="date"
                name="birthdate">
        <h4 class="col-6 ">Inscrit à la newsletter: <?php if ($TheUser['wantnews'] == true) echo "Oui";
            else echo "Non"; ?></h4><input class="col-6 form-control" type="checkbox" name="wantnews">
        <h4 class="col-6">Employé de RentASnow: <?php if ($TheUser['employe'] == true) echo "Oui";
            else echo "Non"; ?></h4><span class="col-6 form-control">Non modifiable</span>
        <input type="submit" class="btn-info form-control" value="Enregistrer les nouvelles informations">
    </div>
</form>
<?php
$content = ob_get_clean();

require "view/gabarit.php";
?>

