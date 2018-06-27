<?php
	require("connection.php");

	$username=$_POST["username"];

	$sql="SELECT * FROM users WHERE username = '$username'";
	$run= mysqli_query($con,$sql);
	$count = mysqli_num_rows($run);
	if($count==0){
		echo "<span id='msg' style=\"color: Green; font-size: 10pt;\">Valid Username</span>";
	}else if($count>0){
		echo "<span id='msg' style=\"color: red; font-size: 10pt;\">Username already exist. Please try another one!!!!</span>";
	}
?>