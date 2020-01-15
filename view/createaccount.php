<?php
/**
 *  Projet: page createaccount.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */
ob_start();

?> <br>
<form action="/?createaccount" method="post" class="form-group">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" class="form-group form-control">
    <label for="password" >Mot de passe assez sécurisé...</label>
    <input type="password"  class="form-group form-control">
    <label for="password" >Confirmation mot de passe</label>
    <input type="password"  class="form-group form-control">
    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" class="form-group form-control">
    <input type="checkbox" id="chk1" name="wantnews" class="col-1"><label class="col-11" id="infochkwantnews" for="wantnews">J'aimerai recevoir les informations concernant les promotions, réductions et informations générales de RentASnow et j'autorise donc le partage de mon email à leurs tiers.</label><br>

    <br>
    <input type="checkbox" id="chk2" name="haslawsaccepted" class="col-1"><label class="col-11" id="infochkwantnews" for="wantnews">J'ai lu et accepté la déclaration de confidentialité et je déclare comprendre que toutes mes données seront revendues à des publicitaires et entreprises de marketing (entre autre politique) qui feront de moi un produit. Vous déchargez donc RentASnow de toutes responsabilité vis à vis du controle de ces données une fois revendues...</label><br>


    <input type="submit" value="S'inscrire">
</form>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

