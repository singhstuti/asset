
<?php
if(isset($_POST['login'])){
	
	$user=$_POST['username'];
	$password=$_POST['password'];
		require("connection.php");
		$encrypt_password=md5($password);
	$sql="SELECT * FROM users WHERE username = '$user' AND password = '$encrypt_password'";
	$run=mysqli_query($con,$sql);
	$row = $run->fetch_assoc();
		if($row==0){
		header('location:../html/login.html?loginFailed=true');
		}
		else{
		$userName=$row['username'];
		session_start();
		$_SESSION['userName']=$userName;
		header('location:../php/menu.php');
		}
}
else{
	
	
	header('location:../html/login.html');
}
?>
