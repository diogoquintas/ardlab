<?php
	session_start();
	
	$data = $_POST['file'];
	if($data == 0){
		header("Location:/arduinoLAB/index.php");
	}
	
	$path = "/var/www/html/arduinoLAB/others/code_examples.txt";
	file_put_contents( $path, $data);
	
	
?>
