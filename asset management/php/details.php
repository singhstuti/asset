<?php
	require("connection.php");
	$asset_name=$_POST['asset_name'];
	$asset_details=$_POST['asset_details'];
	$date=$_POST['date'];
	$vendor_name=$_POST['vendor_name'];
	$sql = "insert into asset_details (asset_name,asset_details,date,vender_name) values ('$asset_name', '$asset_details', '$date', '$vendor_name')";
		if(!$result = $con->query($sql)){
			die('There was an error running the query [' . $con->error . ']');
}
	header('location:../php/create_asset_details.php?sucessfull=true');

?>
