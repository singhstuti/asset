<?php
	session_start();
		if(isset($_SESSION['userName']))

	session_destroy();
		header('location:../html/login.html');
?>



