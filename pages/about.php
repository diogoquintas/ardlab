<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/arduinoLAB/css/index.css">
<title> ArdLab </title>
</head>
<body>
	<div id="bar">
	<p id="barTitle"><b>Ard</b><span style="font-size:28px">uino</span><b>Lab</b><span style="font-size:28px">oratory</span></p>
	<p id="barOpt">
	about • <a id="linkNav" href="/arduinoLAB/pages/register.php">create account</a> • <a id="linkNav" href="/arduinoLAB/index.php">login</a>
	</p>
	</div>
<?php 
if(isset($_SESSION['id'])){
	$javascriptString = 'about • <a id="linkNav" href="/arduinoLAB/pages/userpage.php">user page</a> • <a id="linkNav" href="/arduinoLAB/pages/lab.php">lab</a>'; 
	echo '<script>document.getElementById("barOpt").innerHTML='."'".$javascriptString."'"."</script>";
	};
?>
	

	<section>
		<div id="img">
		<img src="/arduinoLAB/others/arduino_uno.png"></img>
		</div>
		<div id="about">
		<h2>	Hello everyone and welcome to ArduinoLAB! </h2>
		<h2>	What is Arduino? </h2>
		<h3>	<a href="https://www.arduino.cc/">Arduino</a> started with the ideia of creating low budget boards using microcontrollers (atmel avr in this case) and end up as a huge platform with their own programming language based on C/C++. With a simple syntax and flexible tools, Arduino is the perfect place for beginners to start learning electronics. It grew, over the years, into a huge community where inspiring projects are made and shared everyday. </h3>
		<h2>	About this website.</h2>
		<h3>	This website incorporates my graduation project in <a href="https://www.isep.ipp.pt/">ISEP</a>, this project was suggested by Eng. <a href="http://ave.dee.isep.ipp.pt/~rjc/">Ricardo Costa</a>. The ideia behind the project is to provide lessons on Arduino using web technologies. In this website you can interact with an Arduino Uno board (the one in the picture) and a variety of components. This is possible with a livestream, a set of controls and an embedded code editor that allows building and uploading to the arduino using the internet. The fun part is that you dont need any equipment except a computer and internet connection.</h3>
		<h2>	So, where to start? </h2>
		<h3>	It's easy! To start just <a href="/arduinoLAB/pages/register.php">create an account</a> or <a href="/arduinoLAB/index.php">login</a>!</h3>


		If you have any question or suggestion, please contact <a href="mailto:odiogoribeiroq@gmail.com">odiogoribeiroq@gmail.com</a>.
		<br><br>
		</div>
	</section>
	<footer>
		<section id="footer" >
		
			<div id="images">
				in association with:<br><br>
				<a id="imagess" href="http://isep.ipp.pt/" ><img id="isep" src="/arduinoLAB/others/isep.png"/></a>
				<a id="imagess" href="http://www.cieti.isep.ipp.pt/index.php?page=laboris-2" ><img id="laboris" src="/arduinoLAB/others/laboris.png"/></a>
				<a id="imagess" href="https://www.ipp.pt/" ><img id="ipp" src="/arduinoLAB/others/ipp.png"/></a>
				
				
			</div>
			
			
			
			<div id="credits"><br>
			a solution for e-learning arduino<br>
			by <a id="link" href="https://www.facebook.com/quiintas">Diogo Quintas</a><br>
			online since: 14-06-2017
			</div>
			
		</section>
	</footer>
</body>
</html>
