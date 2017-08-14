<!DOCTYPE html>
<?php session_start();
	if($_SESSION['id'] != 1 ){
   header("Location:/arduinoLAB/pages/userpage.php");
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
	<p id="barTitle"><b>Ard</b><span style="font-size:28px">uino</span><b>Lab</b><span style="font-size:28px">oratory</span>   <span style="font-size:18px">(admin page)</span></p>
		
	<p id="barOpt"><a id="linkNav" href="/arduinoLAB/pages/about.php">about</a> • user page • <a id="linkNav" href="/arduinoLAB/pages/lab.php">lab</a></p>
</div>
	
	
<section style="margin-top:100px;">
	<div id="left">
	
		<div id="adminContent">
			
			<div id="Schedule">
				Change the labsession duration for next schedules:
				(ATENTION: this will delete all schedule sessions)<br><br>
				<input id="duration" type="number" placeholder="in minutes">
				<button id="admin" name="setTime">send</button>
				<br>
				<br>
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
				
				
			
		<br><br>		
		</div>
		<div>
				<textarea id="adminText"> load here the file to make changes </textarea>
				<br>Edit lab's sketch examples:
				<button id="admin" name="load">Load file</button>
				<button id="admin" name="save">Save file</button>
				
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
	
	</div>
		<div id="right">

		<div id="userdata">
			<?php  
				echo '<img id="user" src="/arduinoLAB/others/userwhite.png" ></img>';
				echo '<br>username  <div id="userstats">'.$_SESSION['username']."</div><br>";
				echo 'id number  <div id="userstats">['.$_SESSION['id']."]</div><br>";
				echo 'email  <div id="userstats">'.$_SESSION['email']."</div><br><br><br>";
				
				
				echo '<div id="userstats"> <a id="user" href="http://laboris.isep.ipp.pt:8085/phpmyadmin">Access database</a>';
				echo '<br><a  id="user" href="/arduinoLAB/pages/changePwd.php">Change your password</a>'; 
				echo '<br><a  id="user" href="/arduinoLAB/php/logout.php">Log Out</a>';
				echo '</div>';
			
			?>
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


	<script>
	$(document).ready(function(){
		$("button[name='load']").click(function(){
			var path = "/arduinoLAB/others/code_examples.txt";
			$.ajax({
				type: "POST",
				url: path,
				success: function(data){
					$("textarea#adminText").val(data);
				}
			});
		});
		$("button[name='save']").click(function(){
			var path = "/arduinoLAB/php/admin.php";
			var data = $("textarea#adminText").val();
			
			$.ajax({
				type: "POST",
				url: path,
				data: {
					file: data
				},
				success: function(){
					$("textarea#adminText").val("text file successful saved.");
				}
			});
		});
		$("button[name='setTime']").click(function(){
			var val = $("input#duration").val();
			$.ajax({
				type: "POST",
				url: "/arduinoLAB/php/sendDate.php",
				data:{
					submit: "Admin",
					minutes: val
				},
				success: function(data){
					$("textarea#adminText").val(data);
				}
			});
		});
	});
	</script>
</body>
</html>
