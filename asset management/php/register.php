	

<?php
	require("connection.php");
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	$email_id=$_POST['email_id'];
	$phone_no=$_POST['phone_no'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];
	$security_question=$_POST['security_question'];
	$security_answer=$_POST['security_answer'];
	$sql = "insert into user_details (user_name,email_id,phone_no,gender,address,security_question,security_answer) values ('$user_name', '$email_id','$phone_no','$gender','$address','$security_question','$security_answer')";
	if(!$result = $con->query($sql)){
		die('There was an error running the query [' . $con->error . ']');
	}else{
		$encrypt_password=md5($password);
		$insert_login = "INSERT INTO `users`(`username`, `password`) VALUES ('$user_name','$encrypt_password')";
		if(!$insert_login_result = $con->query($insert_login)){
			die('There was an error running the query [' . $con->error . ']');
		}else{
			session_start();
			$_SESSION['userName']=$user_name;
			header('location:../php/menu.php');
		}
	}
?>
