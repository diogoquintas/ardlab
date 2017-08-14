<!DOCTYPE html>
<?php session_start();
	if(!isset($_SESSION['username'])){
   header("Location:/arduinoLAB/index.php");
}
?>
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
	<a id="linkNav" href="/arduinoLAB/pages/about.php">about</a> • <a id="linkNav" href="/arduinoLAB/pages/userpage.php">user page</a>
	• <a id="linkNav" href="/arduinoLAB/pages/lab.php">lab</a>
	
	</p>
	</div>
	<section>
		<div id="img">
		<img src="/arduinoLAB/others/arduino_uno.png"></img>
		</div>
		<div id="login">
		<form action="/arduinoLAB/php/server.php" method="POST" autocomplete="on">
		  	
		  	actual password: <br><input type="password" placeholder="" name="oldPwd" required><br>
		  	new password: <br><input type="password" placeholder="" name="newPwd" required><br>
		    repeat new password: <br><input type="password" placeholder="" name="newPwd2" required><br>
		    <br>
		    <input type="submit" name="submit" value="change"> 
		</form>
		<br>
		<?php 
		   if( isset($_GET['info']) ){
		    	
				echo '<div id="infoText" style="background: white; border-radius: 8px; padding: 6px; color:#00979D;">'.$_GET['info'].'</div>';
		    } 
		?> 
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
