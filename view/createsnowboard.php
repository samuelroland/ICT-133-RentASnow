<?php
/**
 *  Projet: page createaccount.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */
ob_start();
var_dump($formtype);
var_dump($_SESSION['snowincreation']);
if ($message != "Upload réussi !" && isset($message)) {
    echo "<p class='alert alert-danger'>$message</p>";
    if (isset($title) == false) {
        $title = "Erreur avec l'image du snowboard";
    }

    $description = "";
} else {

    switch ($formtype) {
        case 2:
            ?>
            <form action="/?action=createsnowmodele" method="POST" enctype="multipart/form-data">
                <input type="file" name="<?= $_SESSION['snowincreation']['filename'] ?>"/>
                <input type="submit" value="Téléverser"/>
            </form>
            <?php
            break;
        case 3:
            ?>
            <img src="view/images/<?= $_SESSION['snowincreation']['nomimage'] ?>">
            <?php
            break;
        default:
            ?>

            <form action="/?action=createsnowmodele" method="POST" class="form-group">
                <br>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="newmodele">Modèle</label>
                        <input type="text" id="newmodele" name="newmodele" class="form-group form-control" required
                               maxlength="4">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="newmarque">Marque</label>
                        <input type="text" id="newmarque" name="newmarque" class="form-group form-control" required
                               maxlength="25">
                    </div>
                </div>
                <input type="submit" id="btnsubmit" value="Ajouter">
            </form>
            <?php
            break;

    }

}
?>




<?php
$content = ob_get_clean();
require "gabarit.php";
?>
