<?php
/**
 *  Projet: page products.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */

ob_start(); //départ du buffer.
echo "<div class='row ' id='listsnows'>";
foreach ($listproducts as $product) {
    ?>
    <div class="divSnow col-sm-12 col-md-6 col-lg-4">
        <a href='/?action=detailsproducts&model=<?= $product['modele'] ?>'><h3><?= $product['modele'] ?></h3>
            <h4><?= $product['marque'] ?></h4>
            <img src="view/images/<?= $product['smallimage'] ?>" alt="<?= $product['modele'] ?>">
            <?php if ($product['disponible'] == false) {
                echo "<code>Loué jusqu'au  " . date("d M Y", strtotime($product['dateretour'])) . "</code>";
            } ?>
        </a></div>
    <?php
}
echo "</div>";
$content = ob_get_clean();
require "gabarit.php";
?>

