<?php

	if(!session_id()) session_start();
	include("connection.php");
	date_default_timezone_set('America/Chicago');
	
	$user_ID = $_SESSION['id'];
	
	if ($_GET['logout']==1 AND $_SESSION['id']) {
		$loggedout = "UPDATE `users` SET `isLoggedIn` = 0 WHERE `id` = $_SESSION[id] LIMIT 1";
        mysqli_query($link, $loggedout);
		session_destroy();
		$message="You have been logged out! Come back soon!";
		mysqli_close($link);
		
	}

	if ($_POST['time']==="clockin") {
			
		if ($error) $error = "There was an error clocking you in.".$error;
		else {
	
			if (mysqli_connect_error()) {
				die("Could not connect to DB.");
			} else {
				$today = date("n-j-Y");
				$ifDate = mysqli_query("SHOW COLUMNS FROM `times` WHERE `user_id` = $_SESSION[id] AND `date` = $today");
				$result = mysqli_query($link, $ifDate);
				$exists = mysqli_num_rows($result);
				
					$time = date("h:i:s");
					$query = "INSERT INTO `times` (`clock_in`,`user_id`,`date`) VALUES ('$time', $_SESSION[id], CURDATE())";
					mysqli_query($link, $query);
					$isClockedIn = 1;
				
	
			}	
		}	
							
	} elseif ($_POST['time']=="clockout") {
		
		if ($error) $error = "There was an error clocking you out.".$error;
		else {
	
			if (mysqli_connect_error()) {
				die("Could not connect to DB.");
			} else {
				$time = date("h:i:s");
				$today = date("n-j-Y");
				$lastId = mysql_insert_id($link);
				$query1 = "UPDATE `times` SET `clock_out` = '$time' WHERE `date`= CURDATE() AND `user_id` = $_SESSION[id] ORDER BY `id` DESC LIMIT 1";
				mysqli_query($link, $query1);
				$isClockedIn = 0;
			}	
		}	
				
	} elseif ($_POST['time']=="lunchout") {
		
		if ($error) $error = "There was an error clocking you out.".$error;
		else {
	
			if (mysqli_connect_error()) {
				die("Could not connect to DB.");
			} else {
				$time = date("h:i:s");
				$query = "UPDATE `times` SET `clock_out_lunch`='$time' WHERE `date`= CURDATE() AND `user_id` = $_SESSION[id] ORDER BY `id` DESC LIMIT 1";
				$isOnLunch = 1;
				
				mysqli_query($link, $query);
			}	
		}		
	} elseif ($_POST['time']=="lunchin") {
		
		if ($error) $error = "There was an error clocking you in.".$error;
		else {
	
			if (mysqli_connect_error()) {
				die("Could not connect to DB.");
			} else {
				$time = date("h:i:s");
				$query = "UPDATE `times` SET `clock_in_lunch`='$time' WHERE `date`= CURDATE() AND `user_id` = $_SESSION[id] ORDER BY `id` DESC LIMIT 1";
				$isOnLunch = 0;
				
				mysqli_query($link, $query);
			}	
		}
	}
?>