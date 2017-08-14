<!DOCTYPE html>
<?php session_start();
	if(isset($_SESSION['id'])){
   		header("Location:/arduinoLAB/pages/userpage.php");
	}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/arduinoLAB/css/index.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		var login = "<?php echo $_SESSION['username']; ?>";
		 $('#username').val(login);
		});
</script>
<title> ArdLab </title>
</head>
<body>
	<div id="bar">
	
	<p id="barTitle"><b>Ard</b><span style="font-size:28px">uino</span><b>Lab</b><span style="font-size:28px">oratory</span></p>
	
	<p id="barOpt"><a id="linkNav" href="/arduinoLAB/pages/about.php">about</a> • <a id="linkNav" href="/arduinoLAB/pages/register.php">create account</a> • login</p>

	</div>
	<section>
		<div id="img">
		<img src="/arduinoLAB/others/arduino_uno.png"></img>
		</div>
		<div id="login">
		<form action="/arduinoLAB/php/server.php" method="POST" autocomplete="on">
		  	
		  	username: <br><input type="text" placeholder="" name="username" id="username" ><br>
		    password: <br><input type="password" placeholder="" name="psw" id="psw" ><br>
		    <br>
		    <input type="submit" name="submit" value="login"> 
		</form><br>
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
