<?php
session_start();
if(!isset($_SESSION['id'])){
	header("Location:/arduinoLAB/pages/userpage.php");
}
$func = $_POST['funcVal'];
$divStart = '<pre style="color: white;">';
$divEnd = '<br><br>---console end---<br></pre>';


switch ($func){
	case 'Build':
	$file = "./src/sketch.ino";
	$codetext = $_POST['code'];
	file_put_contents($file, $codetext);

	$output = shell_exec('sudo ano build 2>&1');
	$output = "<b>arduino sketch build log:</b><br>" . $output ;
	echo $divStart;
	echo $output;
	echo $divEnd;
	break;
	
	case 'Upload':
	$output = shell_exec('sudo ano upload');
	$output = "<b>arduino sketch update log:</b><br>" . $output ;
	echo $divStart.$output.$divEnd;
	break;
}
?>


