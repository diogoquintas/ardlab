<?php
	session_start();
	
	$mysqli = new mysqli("127.0.0.1","root","HARDuino123","arduinoLAB_database"); 


	if($mysqli->connect_errno){
		echo "Problem with connection to mysql";
	}
	if($_POST['submit'] == 'login'){
		$name = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['psw']);

		$query = "SELECT * FROM members WHERE name='".$name."' AND password='".$password."'"; 
		$result = $mysqli->query($query);
		$num_rows = $result->num_rows;

		if($num_rows > 0){

			if( $query = $mysqli->prepare("SELECT email FROM members WHERE name='".$name."'")){
				$query->execute();

				$query->bind_result($email);
				$query->fetch();
				$query->close();
				
			}
			if( $query = $mysqli->prepare("SELECT id FROM members WHERE name='".$name."'")){
				$query->execute();

				$query->bind_result($id);
				$query->fetch();
				$query->close();
				
			}
			if( $query = $mysqli->prepare("SELECT datetime FROM members WHERE name='".$name."'")){
				$query->execute();

				$query->bind_result($datetime);
				$query->fetch();
				$query->close();
							
			}
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $name;
			$_SESSION['email'] = $email;
			if($id == 1){
				header("Location:/arduinoLAB/pages/adminpage.php");
				die;
			}
			$timeObj = new DateTime($datetime);
			$timeObj->add(new DateInterval('PT30M'));
			$timePlus = $timeObj->format('Y-m-d H:i:s');

			if(isset($datetime)){
				$_SESSION['datetime'] = $datetime;
				$_SESSION['datetimeEnd'] = $timePlus;
			}
			header("Location:/arduinoLAB/pages/userpage.php");
			die;
		}
		else {
			$info = urlencode("Your username or password are wrong, please try again ");
			header("Location:/arduinoLAB/index.php?info=".$info);
			die;
		}
	}
	elseif ($_POST['submit'] == 'register'){
		
			
			if($_POST['psw_signup'] != $_POST['psw_signup_confirm']){
				$info = urlencode("Passwords do not match, please try again");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
	
			$name = $mysqli->real_escape_string($_POST['username_signup']);
			$email = $mysqli->real_escape_string($_POST['email_signup']);
			$password = $mysqli->real_escape_string($_POST['psw_signup']);
			
			if($name == '' OR $email == '' OR $password == ''){
				$info = urlencode("You can't leave spaces empty");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
			
			if(strlen($name) < 4){
				$info = urlencode("Please user more than 4 characters for username");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
			if(strlen($password) < 6){
				$info = urlencode("Please user more than 6 characters for password");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
			$query = "SELECT email FROM members WHERE email='".$email."'";
			if($result = $mysqli->query($query)){
				$num = $result->num_rows;
				$result->close();
			}

			$query = "SELECT name FROM members WHERE name='".$name."'";
			if($result = $mysqli->query($query)){
				$num_2 = $result->num_rows;
				$result->close();
			}
			if($num > 0){
				$info = urlencode("Email already in use");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
			else if($num_2 >0 ){
				$info = urlencode("Username already in use");
				header("Location:/arduinoLAB/pages/register.php?info=".$info);
				die;
			}
			else {
				$query = "INSERT INTO members (name,email,password) VALUES ('$name','$email','$password')";

				if(!$mysqli->query($query)){
					$info = urlencode("There was a problem connecting");
					header("Location:/arduinoLAB/pages/register.php?info=".$info);
					die;
				}
				else {	
					$_SESSION['username'] = $name;
					$info = urlencode("Success! Proceed to login");
					header("Location:/arduinoLAB/index.php?info=".$info);
					die;
				}
			}

	}
	elseif ($_POST['submit'] == 'change') {
		if(!$_SESSION['username']){
			echo "Not logged in";
			die;
		}
		$oldPwd = $_POST['oldPwd'];
		$query = "SELECT * FROM members WHERE password='".$oldPwd."'"; 
		$result = $mysqli->query($query);
		$num_rows = $result->num_rows;
		$newPwd = $_POST['newPwd'];
		$newPwd2 = $_POST['newPwd2'];
		
		if($num_rows > 0){
			
			if($newPwd != $newPwd2){
				$info = urlencode("The new passwords do not match, please try again");
				header("Location:/arduinoLAB/pages/changePwd.php?info=".$info);
				die;
			} 
			
			
			
			if(strlen($newPwd) < 6){
				$info = urlencode("Please user more than 6 characters for password");
				header("Location:/arduinoLAB/pages/changePwd.php?info=".$info);
				die;
			}
			
			$name = $_SESSION['username'];
			$query = "UPDATE members SET password = '".$newPwd."' WHERE members.name = '".$name."'";
			if(!$mysqli->query($query)){
				$info = urlencode("There was a problem connecting");
				header("Location:/arduinoLAB/pages/changePwd.php?info=".$info);
				die;
			}
			else {
				session_destroy();
				$info = urlencode("Success, please log in with your new password");
				header("Location:/arduinoLAB/index.php?info=".$info);
				die;
			}
		}
		else {
			$info = urlencode('Your actual password is wrong, please try again');
			header("Location:/arduinoLAB/pages/changePwd.php?info=".$info);
			die;
		}
	}	
	else {
		echo "Error on submit!";
	}

$mysqli->close();
die;
?>
