<?php
	session_start();

	if($_SESSION['id'] == 0){
		header("Location:/arduinoLAB/index.php");
	}

	$id = $_SESSION['id'];

	if($_SESSION['datetime'] == 0 && $id != 1){
		$info = urlencode("You have to schedule a session first!");
		header("Location:/arduinoLAB/pages/userpage.php?info=".$info);
	}
	$mysqli = new mysqli("127.0.0.1","root","HARDuino123","arduinoLAB_database"); 

	if($mysqli->connect_errno){
		echo "Problem with connection to mysql";
	}
	$query = "SELECT * FROM members WHERE id='" . $id . "'";
	$result = $mysqli->query($query);
	$num_rows = $result->num_rows;

	if($num_rows > 0){
		if( $query = $mysqli->prepare("SELECT datetime FROM members WHERE id='".$id."'")){
			$query->execute();
			$query->bind_result($datetime);
			$query->fetch();
			$query->close();
		}
		if( $query = $mysqli->prepare("SELECT duration FROM members WHERE id='".$id."'")){
			$query->execute();
			$query->bind_result($duration);
			$query->fetch();
			$query->close();
		}
	}
	else {
		echo "id not found";
		die;
	}

	date_default_timezone_set('Europe/Lisbon');
	$limitStr = 'PT'.$duration.'M';
	$datetimeServer = date('Y-m-d H:i:s');
	$timeObj = new DateTime($datetimeServer);
	$timeObj->add(new DateInterval($limitStr));
	$datetimeServerPlus30 = $timeObj->format('Y-m-d H:i:s');
	$timeObj = new DateTime($datetime);
	$timeObj->add(new DateInterval($limitStr));
	$datetimePlus30 = $timeObj->format('Y-m-d H:i:s');

	$startSess = strtotime($datetime);
	$endSess = strtotime($datetimePlus30);
	$svTime = strtotime($datetimeServer);
	$svTimePlus30 = strtotime($datetimeServerPlus30);
	
	if($startSess > $svTime || $endSess > $svTime){
		$val1 = 1;
	}
	else{
		$val1 = 0;
	}
	if($startSess < $svTimePlus30 || $endSess < $svTimePlus30){
		$val2 = 1;
	}
	else{
		$val2 = 0;
	}  

	if($val1 == 1 && $val2 == 1){
		$_SESSION['keys']  = 1;
		$timeLeftMs = $endSess - $svTime;
		$_SESSION['timeCoins'] = $timeLeftMs*1000;
	}
	else if($_SESSION['id'] == 1){
		$_SESSION['keys']  = 1;
		$_SESSION['timeCoins'] = 999999999;
	}
	else {
		$string = "You don't have a session scheduled to ".$datetimeServer;
		$info = urlencode($string);
		header("Location:/arduinoLAB/pages/userpage.php?info=".$info);
	}

?>
	
	
	
		
	
