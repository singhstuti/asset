



<?php
	session_start();
	if(isset($_SESSION['userName'])){
	$aid = $_POST['assetId'];
	require("connection.php");
	
	$sql="select * from asset_details where aid = '$aid'";
	$result=mysqli_query($con,$sql) or die("error getting data");
	
	$row=mysqli_fetch_row($result);

	echo 'data:image/jpeg;base64,'.base64_encode( $row[6] );
	
	}else{
		header('location:../html/login.html');
	}
?>