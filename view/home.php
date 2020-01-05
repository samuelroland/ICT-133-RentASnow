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
                <div data-src="view/images/slider/5.jpg">
                    <div class="camera_caption fadeFromBottom cap1">Les derniers modèles toujours à disposition.</div>
                </div>
                <div data-src="view/images/slider/1.jpg">
                    <div class="camera_caption fadeFromBottom cap2">Découvrez des paysages fabuleux avec des sensations.</div>
                </div>
                <div data-src="view/images/slider/2.jpg"></div>
            </div>
            <br style="clear:both"/>
            <div style="margin-bottom:40px"></div>
        </div>
        <div id="headerSeparator2"></div>
    </div>
</div>

<script src="assets/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
<script type="text/javascript">$('#list_photos').carouFredSel({responsive: true, width: '100%', scroll: 2, items: {width: 320, visible: {min: 2, max: 6}}});</script>
<script src="assets/camera/scripts/camera.min.js" type="text/javascript"></script>
<script src="assets/easing/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">function startCamera()
    {
        $('#camera_wrap').camera({fx: 'scrollLeft', time: 2000, loader: 'none', playPause: false, navigation: true, height: '35%', pagination: true});
    }

    $(function () {
        startCamera()
    });</script>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
