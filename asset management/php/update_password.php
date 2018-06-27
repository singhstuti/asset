<?php
	session_start();
	if(isset($_POST['submit']) && ($_SESSION['username']!=null)){
		$password = $_POST['password'];
		$confirm_password= $_POST['confirm_password'];
		if($password !=null && $confirm_password!=null){
			include('connection.php');
			$encrypt_password=md5($password);
			$username = $_SESSION['username'];
			$sql = "update users set password = '$encrypt_password' where username='$username'";
			
			if (mysqli_query($con, $sql)) {
				session_destroy();
				header('location:../html/login.html');
			} else {
				echo "Error updating Password: " . mysqli_error($conn);
			}
		}
	}else{
		header('location:../html/login.html');
	}
?>