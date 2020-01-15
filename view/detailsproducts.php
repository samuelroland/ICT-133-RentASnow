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
    <img src="/view/images/<?php echo "$modelesnow.jpg" ?>" alt="photo du snow"><br><br><br>
    <table class="table">
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
            <td><?= $snowwanted['dateretour'] ?></td>
        </tr>
        </tbody>
    </table>

    <?php
}
$content = ob_get_clean();
require "gabarit.php";
?>

