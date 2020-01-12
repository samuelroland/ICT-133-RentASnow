<?php
/**
 *  Projet: page products.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */

require_once 'model/model.php';
$title = "RentASnow - Produits";
$listproducts = getProducts();
ob_start();
echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor eu diam nec interdum. Curabitur lacinia sit amet quam eu suscipit. Fusce eu nisl imperdiet, finibus ex sed, lobortis sapien. Mauris ut consectetur lacus. Suspendisse nec lorem id est malesuada convallis id vitae libero. Donec eget mi et ante sagittis. ";
echo "<div class='row ' id='listsnows'>";
foreach ($listproducts as $product){
    ?>
    <div class="divSnow col-sm-12 col-md-6 col-lg-4" >
        <h3><?= $product['modele']?></h3>
        <h4><?= $product['marque']?></h4>
        <img src="view/images/<?php echo $product['modele']."_small.jpg"?>" alt="<?= $product['modele']?>">
    <?php  if ($product['disponible']==false){
        echo "<code>Loué jusqu'au  ".date("d M Y" ,strtotime($product['dateretour']))."</code>";
    } ?>
    </div>
<?php
}
echo "</div>";
$content = ob_get_clean();
require "gabarit.php";
?>

