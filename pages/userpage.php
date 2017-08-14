<!DOCTYPE html>
<?php session_start();
if(!isset($_SESSION['id'])){
   header("Location:/arduinoLAB/index.php");
}
if($_SESSION['id'] == 1 ){
   header("Location:/arduinoLAB/pages/adminpage.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/arduinoLAB/css/index.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<title> ArdLab </title>
</head>
<body>
	
<div id="bar">
	<p id="barTitle"><b>Ard</b><span style="font-size:28px">uino</span><b>Lab</b><span style="font-size:28px">oratory</span></p>
		
	<p id="barOpt"><a id="linkNav" href="/arduinoLAB/pages/about.php">about</a> • user page • <a id="linkNav" href="/arduinoLAB/pages/lab.php">lab</a></p>
</div>
	
	
<section style="margin-top:100px;">
	<div id="left">
	
		<div id="columns">
			
			<div id="Schedule">
			Pick a date to enter the Lab!  <br><br>
			<form title="this will automaticly update any previous schedule" id="schedule" method="post" action="/arduinoLAB/php/sendDate.php" target="dframe">
			<input type="date" placeholder="select date" name="date"><br><br>
			<input type="time" placeholder="select time" name="time">
			<input id="date" type="submit" name="submit" value="Request">
			</form>
			<iframe style="border:0;overflow: hidden;height:0;" name="dframe"></iframe>
			</div>
			
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
			<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
			<script>
			webshim.activeLang('pt');
			webshims.setOptions('waitReady', false);
			webshims.setOptions('forms-ext', {type: 'date'});
			webshims.setOptions('forms-ext', {type: 'time'});
			webshims.polyfill('forms forms-ext');
			</script>
		
		
		<script type="text/javascript">
			 var now = new Date(<?php echo time() * 1000; ?>);
			 function timedMsg(){
				setInterval("change_time();",1000);
			  }
			  timedMsg();
			 function change_time(){
			   
			   var nowJS = now.getTime();
			   nowJS += 1000;
			   now.setTime(nowJS);
			   
			   var curr_hour = now.getHours();
			   var curr_min = now.getMinutes();
			   var curr_sec = now.getSeconds();
			   var curr_day = now.getDate();
			   var curr_month = now.getMonth() + 1;
			   var curr_year = now.getFullYear();
			   
				if(curr_min < 10)
					curr_min = '0'+curr_min;
				if(curr_sec < 10)
					curr_sec = '0'+curr_sec;
				
			   
			   document.getElementById('day').innerHTML =curr_day+' / ';
			   document.getElementById('month').innerHTML=curr_month+' / ';
			   document.getElementById('year').innerHTML=curr_year;
			   
			   document.getElementById('Hour').innerHTML =curr_hour+' : ';
			   document.getElementById('Minut').innerHTML=curr_min+' : ';
			   document.getElementById('Second').innerHTML=curr_sec;
			   
			 }
			  
		</script>
		
		<div id="datetime">
			
				current server date and time:<br><br>
					<h5 id="day" style="color:white;font-size:x-large;"></h5>
					<h5 id="month" style="color:white;font-size:x-large;"></h5>
					<h5 id="year" style="color:white;font-size:x-large;"></h5>
				<br>
					<h5 id="Hour" style="color:white;font-size:x-large;"></h5>
					<h5 id="Minut" style="color:white;font-size:x-large;"></h5>
					<h5 id="Second" style="color:white;font-size:x-large;"></h5>
				
				
			
				
		</div>
		
	</div>
	<!--
	<div id="guide">
		<select>
			<option>Select a guide here</option>
			<option value="2">Guide 2 - </option>
			<option value="3">Guide 3 - </option>
			<option value="4">Guide 4 - </option>
			<option value="5">Guide 5 - </option>
		</select>
	
	</div>-->
	<br><br>
		<div id="infoOut">
			<div id="info">
			
			
			Must read if it's your first time in the LAB
			<ul>
				<li>The lab is restricted to one person per session.</li>
				<li>The session duration is set by admin, depending on the lessons (5 minutes min).</li>
				<li>You can use the lab multiple times.</li>
				<li>If you don't have any experience with Arduino, read the guides before using the LAB.</li>
				<li>Have in mind that this is not a simulation and every part can be damaged.</li>
			</ul>
			</div> 
		</div>
	</div>
		<div id="right">

		<div id="userdata">
			<?php  
				echo '<img id="user" src="/arduinoLAB/others/userwhite.png" ></img>';
				echo '<br>username  <div id="userstats">'.$_SESSION['username']."</div><br>";
				echo 'id number  <div id="userstats">['.$_SESSION['id']."]</div><br>";
				echo 'email  <div id="userstats">'.$_SESSION['email']."</div><br>";
				if($_SESSION['datetime'] != "0000-00-00 00:00:00"){
					echo "session ";				
					echo 'from <div id="userstats">'.$_SESSION['datetime']."<br>";
					echo '</div> to <div id="userstats">'.$_SESSION['datetimeEnd']."</div><br><br>";
					
				}
				
				echo '<div id="userstats"> <a  id="user" href="/arduinoLAB/pages/changePwd.php">Change your password</a>'; 
				echo '<br><a  id="user" href="/arduinoLAB/php/logout.php">Log Out</a>';
				echo '</div>';
			
			?>
			<script>
			function reload(){
				window.location='/arduinoLAB/pages/userpage.php';
			}
			</script>
		</div>
	
	<div id="enter" onclick="window.location='/arduinoLAB/pages/lab.php';">
	<br>Enter in the lab now<br><br>
	</div>	
	<?php 
	if( isset($_GET['info']) ){
		echo '<script>alert("'.$_GET['info'].'")</script>';
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
