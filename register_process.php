<?php  
	session_start();
	include_once ("files/functions.php");
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
 
	//hashing the password
	$password = password_hash($password, PASSWORD_DEFAULT);
	 
	$u  = get_user_by_username($conn,$username);
 
 
 	if(!empty($u)){
 		message("User with same username already exists on database","danger");
 		header("Location: login.php");
 		die();
 	}

 	$last_seen = time();
 	$reg_date = time();
 
 	$sql_1 = "INSERT INTO users (
 				username,
 				last_seen,
 				reg_date,
 				password,
 				first_name,
 				last_name, 
 				photo
 				) VALUES (
 				'{$username}',
 				'{$last_seen}',
 				'{$reg_date}',
 				'{$password}',
 				'{$first_name}',
 				'{$last_name}',
 				''
 			)";

 	if($conn->query($sql_1)){
		$u  = get_user_by_username($conn,$username);
		message("Your account was created successfully","success");
		$_SESSION['user'] = $u;
		header("Location: my_account.php");
		die();
 	}else{
		message("Something went wrong while creating your account. Please try again.","danger");
		header("Location: login.php");
		die();
 	}

 ?>