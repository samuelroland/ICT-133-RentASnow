<?php
/**
 *  Projet: page createaccount.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */
ob_start();
unset($snowwanted); //rendre vide la valeur.
foreach ($listproducts as $product) {
    if ($product['modele'] == $modelesnow) {
        $snowwanted = $product;
    }
}

if (isset($snowwanted)) {
    ?>
    <div class="container">
        <img class="imgsnowdetails" src="/view/images/<?= $snowwanted['bigimage'] ?>" alt="photo du snow"><br><br><br>
    </div>
    <h3>Informations détaillées sur <?= $snowwanted['modele'] ?></h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Propriété</th>
            <th>Valeur</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Modèle</td>
            <td><?= $snowwanted['modele'] ?></td>
        </tr>
        <tr>
            <td>Marque</td>
            <td><?= $snowwanted['marque'] ?></td>
        </tr>
        <tr>
            <td>Disponible</td>
            <td><?php if ($snowwanted['disponible'] == true) {
                    echo "Oui";
                } else {
                    echo "Non";
                } ?>
            </td>
        </tr>
        <tr>
            <td>Date de retour (si indisponible)</td>
            <td><?= date("d.m.Y", strtotime($snowwanted['dateretour'])); ?></td>
        </tr>
        </tbody>
    </table>

    <?php
} else if ($modelesnow != "") {
    $title = "Aucun snow avec $modelesnow comme nom a été trouvé...";
    $description = "Pas tellement possible de louer du coup !";

} else {
    $title = "Aucun snow n'a été demandé ...";
    $description = "Pas tellement possible de louer du coup !";
}
$content = ob_get_clean();
require "gabarit.php";
?>

