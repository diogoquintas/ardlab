<?php
	session_start();

	$submit = $_POST['submit'];
	
	if($submit == 'Admin'){
		$val = $_POST['minutes'];
	}
	else{
		date_default_timezone_set('Europe/Lisbon');
		$name = $_SESSION['username'];
		$mail = $_SESSION['email'];
		$id = $_SESSION['id'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$dateSv = date('Y-m-d');
		$timeSv = date('H:i');
	}
/*	
	echo '<script>alert("date: '.$dateSv.', time: '.$timeSv.', submit: '.$submit.'")</script>';
	echo '<script>alert("date: '.$date.', time: '.$time.', id: '.$id.'")</script>';
*/
	
	$mysql = new mysqli("127.0.0.1","root","HARDuino123","arduinoLAB_database"); 


	if($mysql->connect_errno){
		echo '<script>alert("problem connecting to mysqli")</script>';
	}
	if($submit == 'Admin'){
		$query = "UPDATE members SET datetime = '0000-00-00 00:00:00'";
			if(!$mysql->query($query)){
				echo 'Error 1 on changing schedule limit time (database connection problem)';	
				die;
			}
			else{
				$query = "UPDATE admin SET labtime = '".$val."' WHERE admin.id = '1'";
				if(!$mysql->query($query)){
					echo 'Error 2 on changing schedule limit time (database connection problem)';	
					die;
				}
				else {
					echo 'Schedule time limit is now: '.$val.' minutes.';
					die;
				}
			}
	}
	if($submit == 'Request'){
		if($date > 0 || $time > 0){
			if($date < $dateSv){
				echo '<script>alert("Please select a date above '.$dateSv.' (actual server date)")</script>';
				die;
			}
			if(strtotime($time) < time() AND $date <= $dateSv){
				echo '<script>alert("Please select a time above '.$timeSv.' for '.$dateSv.' (actual server datetime)")</script>';
				die;
			}
			
			if( $query = $mysql->prepare("SELECT labtime FROM admin WHERE id='1'")){
				$query->execute();
				$query->bind_result($limit);
				$query->fetch();
				$query->close();
			}
			
			$limitStrPlus = 'PT'.$limit.'M';
			
			$timeObj = new DateTime($date.' '.$time);
			$timeObj->add(new DateInterval($limitStrPlus));
			$timePlus = $timeObj->format('Y-m-d H:i:s');
			
			$limit2 = 2 * $limit;
			$limitStrLess = 'PT'.$limit2.'M';
			$timeObj->sub(new DateInterval($limitStrLess));
			$timeLess = $timeObj->format('Y-m-d H:i:s');
			

			
			$query = "SELECT * FROM members WHERE datetime BETWEEN '".$timeLess."' AND '".$timePlus."'";
			
				if($result = $mysql->query($query)){
					$num_rows = $result->num_rows;
				}
				else{
					die(mysqli_error($conn));
				}

			if($num_rows > 0){
				$query = "SELECT * FROM members WHERE id = '".$id."' AND datetime BETWEEN '".$timeLess."' AND '".$timePlus."'";
					if($result = $mysql->query($query)){
						$num_rows = $result->num_rows;
					}
					else {
						die(mysqli_error($conn));
					}

				if($num_rows >0){
					$query = "UPDATE members SET datetime = '".$date." ".$time.":00' WHERE members.id = '".$id."'";
					if(!$mysql->query($query)){
						echo '<script>alert("There was an error 1, please try again")</script>';	
						die;
					}
					else {
						$query = "UPDATE members SET duration = '".$limit."' WHERE members.id ='".$id."'";
						if(!$mysql->query($query)){
							echo '<script>alert("There was an error 2, please try again")</script>';	
							die;	
						}
						else {
							$timeObj->add(new DateInterval($limitStrPlus));
							$datetime = $timeObj->format('Y-m-d H:i:s');
							$_SESSION['datetime'] = $datetime;
							$_SESSION['datetimeEnd'] = $timePlus;
							echo '<script>alert("Congratulations! Your reservation was successful.");</script>';
							echo '<script>parent.reload();</script>';
							die;
						}
					}
				}
				else {
					echo '<script>alert("UPS! Between '.$date.' '.$time.':00 and '.$timePlus.' its already reserved")</script>';
					die;
				}
			}
			else {
				$query = "UPDATE members SET datetime = '".$date." ".$time.":00' WHERE members.id = '".$id."'";
				
				if(!$mysql->query($query)){
					echo '<script>alert("There was an error 3, please try again")</script>';	
					die;
				}
				else {
						$query = "UPDATE members SET duration = '".$limit."' WHERE members.id ='".$id."'";
						if(!$mysql->query($query)){
							echo '<script>alert("There was an error 4, please try again")</script>';	
							die;	
						}
						else {
							$timeObj->add(new DateInterval($limitStrPlus));
							$datetime = $timeObj->format('Y-m-d H:i:s');
							$_SESSION['datetime'] = $datetime;
							$_SESSION['datetimeEnd'] = $timePlus;
							echo '<script>alert("Congratulations! Your reservation was successful.");</script>';
							echo '<script>parent.reload();</script>';
							die;
						}
					}
			}
		}	
		else {
			echo '<script>alert("Please fill the date and time!")</script>';
			die;
		}
	}
	else {
		die;
	}
?>
