<?php
    include("connection.php");
	session_start();
	
	if ($_GET['logout']==1 AND $_SESSION['id']) {
		
        $loggedout = "UPDATE `users` SET `isLoggedIn` = 0 WHERE `id` = $_SESSION[id] LIMIT 1";
        mysqli_query($link, $loggedout);
		session_destroy();
		$message="You have been logged out! Come back soon!";
        mysqli_close($link);
		
	}

	if ($_POST['submit']=="Sign Up") {
		
		if (!$_POST['email']) $error.="<br />Please enter your e-mail.";
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="<br />Please enter a valid e-mail address.";
		
		if (!$_POST['fullname']) $error.="<br />Please enter your name.";
		
		if (!$_POST['company']) $error.="<br />Please enter your company name.";
		
		if (!$_POST['password']) $error.="<br />Please enter your password.";
			else {
				
				if (strlen($_POST['password'])<8) $error.="<br />Your password must be able least 8 characters long.";
				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Your password must contain a capital letter.";
			}
			
		if ($error) $error = "There were error(s) in your sign-up details.".$error;
		else {
	
			if (mysqli_connect_error()) {
				die("Could not connect to DB.");
			}
			
			$query="SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($link, $_POST['email'])."'";
			
			$result = mysqli_query($link, $query);
			
			$results = mysqli_num_rows($result);	
			
			if ($results) $error = "That e-mail address is already registered. Do you want to log in?";
			else {
			
				$query = "INSERT INTO `users` (`company`, `name`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['company'])."', '".mysqli_real_escape_string($link, $_POST['fullname'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";
				
				mysqli_query($link, $query);
				
				echo "You've been signed up!";
				$_SESSION['id']=mysqli_insert_id($link);
                $loggedin = "UPDATE `users` SET `isLoggedIn` = 1 WHERE `id` = $_SESSION[id] LIMIT 1";
                mysqli_query($link, $loggedin);
				header("Location:http://www.clockm.in/user/");
				
			}	
		}						
	}
	
	if ($_POST['submit'] == "Log In") {	
	
		$query = "SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($link, $_POST['loginEmail'])."'AND 
		password='" .md5(md5($_POST['loginEmail']) .$_POST['loginPassword']). "'LIMIT 1";

		$result = mysqli_query($link, $query);
		
		$row = mysqli_fetch_array($result);
		
		if ($row) {
			$_SESSION['id']=$row['id'];
            $loggedin = "UPDATE `users` SET `isLoggedIn` = 1  WHERE `id` = $_SESSION[id] LIMIT 1";
            mysqli_query($link, $loggedin);
			header("Location:http://www.clockm.in/user/");
			
		} else {
			
			$error = "We could not find that e-mail and/or password combo! Please try again!";
			
		}
		
	}
	
?>