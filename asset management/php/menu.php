
<?php

		session_start();
	if(isset($_SESSION['userName'])){

?>
<html lang="en">
<head>
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Menu</title>
<link rel="icon" href="../images/AMS3.ico" type="image/ico">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> 

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
   
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Acuiti Labs</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Asset Management<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../php/create_asset_details.php">Create Asset</a></li>
          <li><a href="../php/view_asset_details.php">View Asset</a></li>
          
        </ul>
      </li>
      <li><a href="#">Invoice</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<img src="../images/assestmanagement.jpg" height="525" width="1250">
</body>
</html>
<?php
}	else{
			header('location:../html/login.html');
		}
?>