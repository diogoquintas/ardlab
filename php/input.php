<?php

	$duty = $_POST['duty'];
	$time = $_POST['time'];
	$type = $_POST['type'];
	$freq = $_POST['freq'];
	$divStart = '<pre style="color: white;">';
	$divEnd = '<br><br>---console end---<br></pre>';
	if($type == 'pwm'){
		if($duty == 0 || $freq == 0 || $time == 0){
			echo $divStart.'Invalid PWM configuration'.$divEnd;
			die;
		}
	}
	
	if($type == 'pwm'){
		$output = shell_exec('sudo python /var/www/html/arduinoLAB/others/pwm.py '.$duty.' '.$freq.' '.$time);
		echo $divStart.$output.$divEnd;
	}
	if($type == 'switch1'){
		$output = shell_exec('sudo python /var/www/html/arduinoLAB/others/GPIO4.py');
		echo $divStart.$output.$divEnd;
	}
	if($type == 'switch2'){
		$output = shell_exec('sudo python /var/www/html/arduinoLAB/others/GPIO17.py');
		echo $divStart.$output.$divEnd;
	}
	else {
		die;
	}
	
?>
