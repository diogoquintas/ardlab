<?php
include 'PhpSerial.php';

$form = 0;
$form = $_POST['serial'];
$data = $_POST['data'];
$time = $_POST['time'];
$divStart = '<pre style="color: white;">';
$divEnd = '<br><br>---console end---<br></pre>';

if(empty($form)){
	echo $divStart.'Invalid usage'.$divEnd;
	die;
}
if(empty($data) && ($form == 'Write')){
	echo $divStart.'No data to send.'.$divEnd;
	die;
}
if($time == 0){
	$time = 3;
}

$serial = new PhpSerial; 

$serial->deviceSet("/dev/ttyACM0"); 
$serial->confBaudRate(9600); //Baud rate: 9600
$serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
$serial->confCharacterLength(8); //Character length     (this is the "8" in "8-N-1")
$serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
$serial->confFlowControl("none");

$serial->deviceOpen(); 
sleep($time);

if($form == 'Read'){
	$read = $serial->readPort(); 
	$line = '-----------------------------------------';
	$string = '<b></b>serial port : /dev/ttyACM0<br>baud rate : 9600<br>duration : '.$time.' s<br>'.$line.'<br><br></b>';
	$read =  $divStart . $string . $read . $divEnd;
	echo $read;
}
if($form == 'Write'){
	$serial->sendMessage($data);
	echo $divStart."' ".$data." '"." was successfully sent.".$divEnd;
	
}
$serial->deviceClose(); 

?>
