<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:16
 */

$timestamp = time('F');                                     //get current system date and time
$currentMonth = date('m', $timestamp);               //
$currentYear4Digits =  date("Y", $timestamp);       //current Year (sample : 2018)
$currentDay = date('j',$timestamp);                  //current day
$lastDayOfMonth = date('t',$timestamp);              //last day of current month
$lastDayOfPreviousMonth = date('t', strtotime('01-'.($currentMonth-1).'-'.$currentYear4Digits));
$daysFrench = array('Lun','Mar','Mer','Jeu','Ven','Sam','Dim');


$choosenMonth= @$_GET['month'];
$choosenYear= @$_GET['year'];

// tampon de flux stocké en mémoire
ob_start();
$title="RentASnow - Accueil";
?>

<div class="span12" id="divMain">
  <h1>Nos activités</h1>

	<p><strong>Rent A Snow</strong> est spécialisée dans la location de snows. Nous avons tout types de modèles :
  <ul>
    <li>des plus récents au plus anciens,
    <li>pour débutants ou confirmés,
    <li>pour de la piste ou du hors-piste
  </ul>
  La location peut se faire au jour, à la semaine, au mois ou à la saison.
  </p>
            <p>
  Nous proposons aussi des cours privés ou en petits groupe (4 personnes maximum) pour tous les niveaux avec des moniteurs certifiés par l'école suisse de snowboard au prix de 60.- /heure.
            </p>

                    <br />
                    <br />

	<div class="row-fluid">
    <div class="span3">
			<div class="box">
				<i class="icon-wrench"></i>
				<h4 class="title">Entretien</h4> <hr/>
				<p>
					Le matériel est toujours contrôlé avant d'être mis à disposition des clients. A chaque fois que vous louerez un snow, vous pouvez partir surfer tranquille.
				</p>
			</div>
	</div>

	<div class="span3">
			<div class="box">
				<i class="icon-leaf"></i>
				<h4 class="title">Environnement</h4> <hr/>
				<p>
Nous veillons à respecter l'environnement en utilisant au maximum du matériel recyclable et en prenant de consommer un minimum d'énergie lors de nos activités au magasin,
				</p>
			</div>
	</div>

	<div class="span3">
			<div class="box">
				<i class="icon-edit"></i>
				<h4 class="title">Contrat</h4> <hr/>
				<p>
Un contrat sera signé à chaque location. D'autre part nous travaillons en étroite collaboration avec la Rega et garantissons des conditions de sauvetage optimales.
				</p>
			</div>
	</div>

	<div class="span3">
			<div class="box">
				<i class="icon-signal"></i>
				<h4 class="title">Signal</h4> <hr/>
				<p>
					Pour ceux qui aiment les sensations forte, nous louons du matériel de protection d'avalanches.
				</p>
			</div>
	</div>    </div>

    <div class="month">
        <ul>
            <li class="prev">&#10094;</a></li>
            <li class="next">&#10095;</li>
            <li>
                <?php
                if (isset($choosenMonth))
                    echo monthsInFrench($choosenMonth);
                else
                    echo monthsInFrench($currentMonth);
                ?> <br>
                <span style="font-size:18px">
                <?php
                if (isset($choosenYear))
                    echo $choosenYear;
                else
                    echo $currentYear4Digits;
                ?>
            </span>
            </li>
        </ul>
    </div>

    <ul class="weekdays">
        <?php
        for ($i =0; $i<7 ;$i++)
        {
            echo "<li>".$daysFrench[$i]."</li>";
        }
        ?>
    </ul>

    <ul class="days">
        <?php
        //Get Querystring values
        if (isset ($choosenMonth))
            $month = $choosenMonth;
        else
            $month = $currentMonth;
        if (isset ($choosenYear))
            $year = $choosenYear;
        else
            $year = $currentYear4Digits;

        // Fill the calendar
        for ($i=1; $i<getFirstDay($month,$year); $i++)
        {
            echo "<li></li>";
        }
        for ($i=1; $i<=31; $i++)
        {
            if ($i==$currentDay && $year ==$currentYear4Digits)
                echo "<li><span class='active'>$i</span></li>";
            else
                echo "<li>$i</li>";
        }
        ?>
    </ul>


</div>

<?php
  $content = ob_get_clean();
  require "gabarit.php";
