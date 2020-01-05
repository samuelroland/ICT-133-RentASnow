<?php
ob_start();
$title = "RentASnow - Accueil";
?>

    <div class="span12">
        <h1><?= $info['name'] ?></h1>
        <h2><?= $info['email'] ?></h2>
    </div>

    <!-- ________ SLIDER_____________-->
    <div class="row-fluid">
        <div class="span12">
            <div id="headerSeparator"></div>
            <div class="camera_full_width">
                <div id="camera_wrap">
                    <div data-src="view/content/slider-images/5.jpg">
                        <div class="camera_caption fadeFromBottom cap1">Les derniers modèles toujours à disposition.</div>
                    </div>
                    <div data-src="view/content/slider-images/1.jpg">
                        <div class="camera_caption fadeFromBottom cap2">Découvrez des paysages fabuleux avec des sensations.</div>
                    </div>
                    <div data-src="view/content/slider-images/2.jpg"></div>
                </div>
                <br style="clear:both"/>
                <div style="margin-bottom:40px"></div>
            </div>
            <div id="headerSeparator2"></div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
