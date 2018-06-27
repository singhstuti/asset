<?php

	

	$assetId = $_POST['assetId'];
	
	require("connection.php");
	
	$sql = "delete from asset_details where aid = '$assetId'";

	if(!$result = $con->query($sql)){
		echo "error while deleting";
	}else{
		echo "deleted successfully";
	}
	
	

?>