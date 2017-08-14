<!DOCTYPE html>
<?php session_start();
	include 'enterlab.php';
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/arduinoLAB/css/index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script language="javascript" type="text/javascript" src="/arduinoLAB/others/code_examples.txt"></script>
<script language="javascript" type="text/javascript" src="/arduinoLAB/edit_area/edit_area_full.js"></script>
<script type="text/javascript" src="/arduinoLAB/js/jsmpeg.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
	var timeLeftMs = Number("<?php echo $_SESSION['timeCoins']; ?>");
	var id = "<?php echo $_SESSION['id']; ?>";
		var username = "<?php echo $_SESSION['username']; ?>";
	
	var interval = window.setInterval(function(){
			if(timeLeftMs <= 0){
				window.alert('Time out! I hope you come back!');
				window.location='/arduinoLAB/pages/userpage.php';
				die;
			}
			else{
				timeLeftMs = timeLeftMs-1000;
				var sec = ( timeLeftMs / 1000 ) % 60 ;
				var minutes = (timeLeftMs/1000-sec)/60;
				if(sec < 10){
					sec = '0'+sec;
				}
				
				if( id == 1){
					document.getElementById('timer').innerHTML = ' admin ['+timeLeftMs+']';
					return;
				}
				document.getElementById('timer').innerHTML = ' time left = '+minutes.toFixed(0)+':'+sec+' min';
			}
			
	},1000);
</script>
<script>
$(document).ready( function(){
	$("#write").click(function(){
		var data = prompt("Message to send via serial:");
		if (data == '') {
			alert('Invalid data');
			return;
		}
		$.ajax({
			type: "POST",
			url: "/arduinoLAB/php/serial.php",
			data: {
				serial: 'Write',
				data: data
			 },
			success: function (data) {
				var myFrame = $('#console').contents().find('body');
				myFrame.html(data);
				},
			dataType: 'text'
			});
		});
	$("#read").click(function(){
		var time = prompt("Read duration(in seconds):");
		if ((time == '') || isNaN(time)) {
			alert('Invalid data');
			return;
		}
		$.ajax({
		type: "POST",
		url: "/arduinoLAB/php/serial.php",
		data: {
			serial: 'Read',
			time: time
		 },
		success: function (data) {
			var myFrame = $('#console').contents().find('body');
			myFrame.html(data);
			},
		dataType: 'text'
		});
	});
	$("#pwm").click(function(){
		var dutyData = prompt("Select the duty-cycle:");
		var timeData = prompt("Select the duration in seconds:");
		var freqData = prompt("Select the frequency in Hertz:");
		if ((dutyData == 0) || (timeData == 0) || isNaN(dutyData) || isNaN(timeData) || (freqData == 0) || isNaN(freqData)) {
			alert('Invalid insert');
			return;
		}
		$.ajax({
			type: "POST",
			url: "/arduinoLAB/php/input.php",
			data: {
				duty: dutyData,
				time: timeData,
				freq: freqData,
				type: 'pwm'
			 },
			success: function (data) {
				var myFrame = $('#console').contents().find('body');
				myFrame.html(data);
				},
			dataType: 'text'
			});
		});
	$("#switch1").click(function(){
		$.ajax({
			type: "POST",
			url: "/arduinoLAB/php/input.php",
			data: {
				type: 'switch1'
			 },
			success: function (data) {
				var myFrame = $('#console').contents().find('body');
				myFrame.html(data);
				},
			dataType: 'text'
			});
		});
	$("#switch2").click(function(){
		$.ajax({
			type: "POST",
			url: "/arduinoLAB/php/input.php",
			data: {
				type: 'switch2'
			 },
			success: function (data) {
				var myFrame = $('#console').contents().find('body');
				myFrame.html(data);
				},
			dataType: 'text'
			});
		});
	$("#lab").click(function(){
		var myFrame = $('#console').contents().find('body');
		var string = '<pre style="color: white;">Please wait! Running Build/Upload...</pre>';
		myFrame.html(string);
	});
	$.each( selectList, function(i, val){
		$("select#sketchList").append($('<option>',{
				value: i+1,
				text: val
		}));
	});
});
</script>
<title> ArdLab </title>
</head>
<body>
	<div id="bar">
	<p id="barTitle"><b>Ard</b><span style="font-size:28px">uino</span><b>Lab</b><span style="font-size:28px">oratory</span></p>
	<p id="barOpt"><a id="linkNav" href="/arduinoLAB/pages/about.php">about</a> • <a id="linkNav" href="/arduinoLAB/pages/userpage.php">user page</a> • lab </p>
	</div>
	<section style="margin-top:100px;">
	
		<section id="painel">
			
			<div id="left1">
				<p id="module">Console</p>
				<iframe id="console" name="console"></iframe>
			</div>
			
			<div id="right1">
					<p id="module">Control Panel</p>
					<br><br>
					<select id="sketchList" onchange="updateList()">
							<option value="0">click to open a sketch</option>
					<!--		
							<option value="1">LED blinking</option>
							<option value="2">Serial to 7 segment display</option>
							<option value="3">Control servo with a random number</option>
							<option value="4">Temperature sensor on LCD and serial</option>
					-->
					</select>
					
					<section style="padding:0;">
					<br>	
					<div id="left2">
						Serial Port Communication<br>
						<button id="read" >Read</button>
						<button id="write" >Write</button><br>
					</div>
					
					<div id="right2">
						Inputs from server to Arduino<br>
						<button id="switch1">Switch 1</button>
						<button id="switch2">Switch 2</button>
						<button id="pwm">PWM</button>
					</div>
					
					
					
					<br><br><br><br>
					
					<button id="scheme">check lab scheme</button>
					
					<div id="schemeModal" class="modal">
						<span id="omg" class="close">&times;</span>
						<img class="modal-content" id="schemeImg">
						<div id="caption"></div>
					</div>
					
					<script>
					var modalx = document.getElementById('schemeModal');
					var img = document.getElementById('scheme');
					var modalImg = document.getElementById('schemeImg');
					var captionText = document.getElementById('caption');
					img.onclick = function () {
						modalx.style.display = "block";
						modalImg.src = "/arduinoLAB/others/scheme.png";
						captionText.innerHTML = "arduino board, the raspberrypi I/O and all the components";
					}
					var span = document.getElementsByClassName("close")[0];
					span.onclick = function () {
						modalx.style.display = "none";
					}
					</script>
			</div>
			
		</section>
	
	
		<div id="stream">
			
			<canvas id="video-canvas"></canvas>
			<script type="text/javascript">
			var canvas = document.getElementById('video-canvas');
			var url = 'ws://'+window.location.hostname+':8082/';
			var player = new JSMpeg.Player(url, {canvas: canvas});
			</script>
		</div>
	</section>
	
	<div id="editor">
		
		<form id="editor" action="/arduinoLAB/upload.php" method="POST" target="console">
			<textarea id="code" name="code" onclick="alert(this.value)">/*QUICK START:
select a sketch example, 
build the sketch and wait for the build log in console,
in the end upload to the arduino.*/</textarea>
<input id="lab" type="submit" name="funcVal" value="Build">
			<input id="lab" type="submit" name="funcVal" value="Upload">
		</form>
			
			<div id="timer"></div><br>
			
			<script language="javascript" type="text/javascript">
				editAreaLoader.init({
					id : "code"		
				,syntax: "cpp"			
				,start_highlight: true
				,allow_resize: false
				,allow_toggle: false
				});
			</script>
			
			<script language="javascript" type="text/javascript">
			function updateList() {
				var val = document.getElementById("sketchList").value;
				
				editAreaLoader.openFile("code", {
					id: selectList[val-1],
					text: codeList[val-1]
				});
			}
			</script>

	</div>
	
	</section>
	
</body>
</html>
