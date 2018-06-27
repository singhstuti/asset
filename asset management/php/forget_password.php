<?php
	if(isset($_POST['next']) && isset($_POST['username'])){
		include("connection.php");
		$username=$_POST['username'];
		$sql = "select username from users where username='$username'";
		$run=mysqli_query($con,$sql);
		$row = $run->fetch_assoc();

		if($row==0){
			header('location:../html/forget_password.html?invalidUsername=true');
		}
		else{
			session_start();
			$sql1 = "select security_question from user_details where user_name='$username'";
			$result=mysqli_query($con,$sql1);
			while ($row=mysqli_fetch_row($result)){
				$question = $row[0];
			}
			$_SESSION['Question'] = $question;
			$_SESSION['username'] = $username;
			header('location:../php/check_answer.php');
		}
	}else{
		header('location:../html/login.html');
	}
?>