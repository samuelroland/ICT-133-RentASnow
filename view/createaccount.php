<?php
/**
 *  Projet: page createaccount.php pour la présentation des produits
 *  Author: Samuel Roland
 *  Creation date: 09.01.2020
 */
ob_start();

?> <br>
<form action="/?createaccount" method="post" class="form-group">
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" class="form-group form-control" required>
    </div>
    <div>
        <label for="lastname">Nom de famille</label>
        <input type="text" id="lastname" name="lastname" class="form-group form-control" required>
    </div>
    <div>
        <label for="password">Mot de passe assez sécurisé...</label>
        <input type="password" name="password" id="password" class="form-group form-control" required>
    </div>
    <div>
        <label for="password2">Confirmation mot de passe</label>
        <input type="password" name="password2" id="password2" class="form-group form-control" required>
    </div>
    <div>
        <label for="birthdate">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" class="form-group form-control" required>
    </div>
    <div>
        <input type="checkbox" id="chk1" name="wantnews" class="col-1"><label class="col-11" id="infochkwantnews"
                                                                              for="wantnews">J'aimerai recevoir les
            informations concernant les promotions, réductions et informations générales de RentASnow et j'autorise donc
            le partage de mon email à leurs tiers.</label><br>
    </div>
    <br>
    <div>
        <input type="checkbox" id="chk2" name="haslawsaccepted" class="col-1"><label class="col-11" id="infochkwantnews"
                                                                                     for="wantnews">J'ai lu et accepté
            la
            déclaration de confidentialité et je déclare comprendre que toutes mes données seront revendues à des
            publicitaires et entreprises de marketing (entre autre politique) qui feront de moi un produit. Vous
            déchargez
            donc RentASnow de toutes responsabilité vis à vis du controle de ces données une fois
            revendues...</label><br>
    </div>

    <input type="submit" id="btnsubmit" value="S'inscrire">
</form>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

