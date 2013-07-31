<?php
    session_start();
    include "autologout.php";
    if(!isset($_SESSION['UserID'])) {	
        header('Location: index.php');
        exit;
    } else {
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Termine
		</title>
		
		<link href="hastyle.css" rel="stylesheet">
		
		<style>	
			a {
				color: black;
				text-decoration: none;
			}
			
			.termin_data {
				position: relative;
				background-color: white;
				text-align: center;
				width: 4.5em;
			}
			
			.termin_data:hover {
				background-color: #55BBFF;
			}
			
			.termin_data_number {
				margin: 0.1em;
				font-size: 5em;
				color: #CACACA;
			}
			
			.termin_data_info_short {
				color: rgb(230,255,255);
				top: 0%;
				position: absolute;
			}
			
			.termin_data_event {
				background-color: #FF2222;
			}
			
			.heute {
				border: 0.2em solid blue;
			}
			
			.termin_days {
				text-align: center;
				padding: 0.2em 1.5em;
				width: 4.5em;
			}
			.anderer_monat {
				background-color: #EEE;
			}
			.monat_wahl_vorher {
				font-size: 1.4em;
			}
			.monat_wahl_weiter {
				float: right;
				font-size: 1.4em;
			}
		</style>
	</head>
	<body>
		<div id="alle">
			<?php
				include "includes/menue_kopf.php";
			?>
			<div id="menue">
				<? include "Menue.php"; ?>
			</div> 
			<div id="loginmenue">
				<? include "Loginmenue.php"; ?>
			</div>
			<div id="hauptteil">
<?php


class Monat {
	function __construct($monat, $jahr){
		//1 bis 12
		$this->monat = $monat;
		//1999 - 2000
		$this->jahr = $jahr;
		$this->tage = date('t', mktime(0, 0, 0, $this->monat, 1, $this->jahr ));
		$this->erster_tag = date('w', mktime(0, 0, 0, $this->monat, 1, $this->jahr ));
	}
}

$days = array(
	"Sonntag",
	"Montag",
	"Dienstag",
	"Mittwoch",
	"Donnerstag",
	"Freitag",
	"Samstag"
);

$month = array(
	"Januar",
	"Februar",
	"März",
	"April",
	"Mai",
	"Juni",
	"Juli",
	"August",
	"September",
	"Oktober",
	"November",
	"Dezember"
);


if( (isset($_GET['monat']) && is_numeric($_GET['monat']) && $_GET['monat'] <= 12 && $_GET['monat'] >= 1) && isset($_GET['jahr']) && is_numeric($_GET['jahr'])){
	$dieser_monat = new Monat($_GET['monat'], $_GET['jahr']);
} else {
	$dieser_monat = new Monat(date('n'), date('Y'));
}

if ( $dieser_monat->monat == 1){
	$voriger_monat = new Monat(12, date('Y') - 1);
} else {
	$voriger_monat = new Monat($dieser_monat->monat - 1, date('Y'));
}

if ( $dieser_monat->monat == 12){
	$folgender_monat = new Monat(1, date('Y') + 1);
} else {
	$folgender_monat = new Monat($dieser_monat->monat + 1, date('Y'));
}

for( $monats_tag = 1; $monats_tag <= $dieser_monat->erster_tag; $monats_tag++){
	$kalender[$monats_tag] = array( 'tag' => $monats_tag + $voriger_monat->tage - $dieser_monat->erster_tag, 'info_short' => '', 'style' => 'anderer_monat');
}

for( $monats_tag = 1; $monats_tag <= $dieser_monat->tage; $monats_tag++){
	$kalender[$dieser_monat->erster_tag + $monats_tag] = array( 'tag' => $monats_tag, 'info_short' => '', 'style' => '');
}


$Resttage = $dieser_monat->tage + $dieser_monat->erster_tag;

if( $Resttage > 35 ){
	$zeilen = 6;
} else {
	$zeilen = 5;
}

for( $monats_tag = 1; $monats_tag <= ($zeilen * 7) - $Resttage; $monats_tag++){
	$kalender[$monats_tag + $Resttage] = array('tag' => $monats_tag, 'info_short' => '', 'style' => 'anderer_monat');
}

//Ereignisse in Kalender eintragen

$ereignisse = array( array('tag' => 2, 'monat' => 3, 'info_short' => "Englisch-Arbeit", 'info_long' => 'M�ndliche Arbeit', 'style' => ''), array('tag' => 2, 'monat' => 3, 'info_short' => "Deutsch-Arbeit", 'info_long' => 'Schriftliche Arbeit', 'style' => ''));
$ereignisse[] = array('tag' => date('j'), 'monat' => date('n'), 'style' => 'heute');

foreach( $ereignisse as $ereigniss ){
	if( $ereigniss['monat'] == $dieser_monat->monat ){
		$kalender[($dieser_monat->erster_tag + $ereigniss['tag'])]['info_short'] .= $ereigniss['info_short'] . '<br>';
		if( $ereigniss['style'] != '')
			$style = $ereigniss['style'];
		else 
			$style = 'termin_data_event';
		$kalender[($dieser_monat->erster_tag + $ereigniss['tag'])]['style'] .= ' ' . $style;
	}
}

echo '<h2 align="center">' . $month[$dieser_monat->monat - 1] . ' ' . $dieser_monat->jahr . '</h2>';

echo '<div style="width: 100%"><a class="monat_wahl_vorher" href="?screen=calendar&monat=' . $voriger_monat->monat . '&jahr=' . $voriger_monat->jahr . '">' . $month[$voriger_monat->monat - 1] . '</a>';
echo '<a class="monat_wahl_weiter" href="' . $_SERVER['PHP_SELF'] . '?screen=calendar&monat=' . $folgender_monat->monat . '&jahr=' . $folgender_monat->jahr . '">' . $month[$folgender_monat->monat - 1] . '</a></div>';

echo '<table cellspacing="10" border="2" align="center">';
echo '<tr>';
foreach( $days as $day ) {
	echo '<td class="termin_days">' . $day . '</td>';
}
echo '</tr>';

for ($z = 0; $z < $zeilen; $z++){
	echo '<tr>';
	for ($s = 1; $s <= 7; $s++){
		echo '<td class="termin_data ' . $kalender[$s + ($z * 7)]['style'] . '"><div class="termin_data_info_short">' . $kalender[$s + ($z * 7)]['info_short'] . '</div><div class="termin_data_number">' . $kalender[$s + ($z * 7)]['tag'] . '</div></td>';
	}
	echo '</tr>';
}
echo '</table>';

?>
			</div>
		<?php
			include "includes/menue_fuss.php";
		?>
		</div>
	</body>
</html>
<?php
}
?>