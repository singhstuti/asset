<?php
	session_start();
		if(isset($_SESSION['userName'])){
			ob_start();
?>

<html lang="en">
<head>
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Create Details</title>
<link rel="icon" href="../images/AMS3.ico" type="image/ico">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<link rel="stylesheet"  href="../css/loginregister.css">

  <!-- For Sweet alert-->
	<script src="../sweetalert/sweetalert.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>


	

<body onload="asset()">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li class="active"><a href="../php/menu.php">Acuiti Labs</a></li>
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
  
<div class="signup-form">	
    <form action="#" method="POST" enctype="multipart/form-data">
		<h2>Enter Details Here</h2>
		<p class="lead"></p>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input id="asset_name" type="text" class="form-control" name="asset_name" placeholder="Asset Name" required>
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
				<input id="asset_details" type="text" class="form-control" name="asset_details" placeholder="Asset Details" required >
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="date" class="form-control"  placeholder="Date" name="date" required>
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
				<input id="vendor_name" type="text" class="form-control"  placeholder="Vendor Name" name="vendor_name" required>
			</div>
        </div>
		 
		  <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-image"></i></span>
					<input type="text" id="file_name" name="file_name" class="form-control" disabled placeholder="Upload Image">
					<span  style="display: -webkit-box;cursor:pointer;" onclick="return uploadFile()"><i  class="fa fa-upload"></i></span>
				</div>
		  </div>
		  
		<input type="file" id="file_id" name="upload_bill" style="visibility:hidden">
		
		<button type="submit" class="btn btn-primary btn-block btn-lg" name="add_asset_details" value="SAVE">Submit</button>

	  </form>
 </div>
  		<div class="form-group" id="details" style="display:none" align="center">
         Details Added Successfully.
        </div>
  <script>
		function asset(){
			var url_string =  window.location.href;
			var url = new URL(url_string);
			var Msg = url.searchParams.get("sucessfull");
			
			if(Msg!=null){

				swal("Record Added Successfully","","success");

			}
		}
		
		function uploadFile(){
			var file = document.getElementById('file_id');
			
			var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
			var file_path = document.getElementById('file_name');
			file.click();
			
			if ('files' in file) {
				file.onchange = function () {
					var inputFilePath = file.value;
					if(!allowedExtensions.exec(inputFilePath)){
					swal("File format not supported","","warning");
						file.value = '';
						return false;
					}else{
						var file_name = file.files[0].name;
						file_path.placeholder = file_name;
					}
				}
			}
		}
	
	$(document).ready(function() {
	  $('#asset_name').blur(function(){
		var asset_name = $(this).val().replace(/[^A-Z0-9_]/ig, '');
		$('#asset_name').val(asset_name);
	  });
	});
	
	$(document).ready(function() {
	  $('#asset_details').blur(function(){
		var asset_details = $(this).val().replace(/[^A-Z0-9_]/ig, '');
		$('#asset_details').val(asset_details);
	  });
	});
	
	$(document).ready(function() {
	  $('#vendor_name').blur(function(){
		var vendor_name  = $(this).val().replace(/[^A-Z]/ig, '');
		$('#vendor_name').val(vendor_name);
	  });
	});
	</script>
  

</body>

</html>
<?php

			require("connection.php");
			if(isset($_POST['add_asset_details'])){
				
				$asset_name=$_POST['asset_name'];
				$asset_details=$_POST['asset_details'];
				$date=$_POST['date'];
				$vendor_name=$_POST['vendor_name'];
				$file=$_FILES['upload_bill']['tmp_name'];
				$image=addslashes(file_get_contents($_FILES['upload_bill']['tmp_name']));
				$image_name=addslashes($_FILES['upload_bill']['name']);
				$image_size=getimagesize($_FILES['upload_bill']['tmp_name']);
				
				if($asset_name!=null && $asset_details!=null && $date!=null && $vendor_name!=null){
					$sql = "insert into asset_details (asset_name,asset_details,date,vendor_name,file_name,bill_image) values ('$asset_name', '$asset_details', '$date', '$vendor_name','$image_name','$image')";
					if(!$result = $con->query($sql)){
					 die('There was an error running the query [' . $con->error . ']');
					}
					else{
						header('location:../php/create_asset_details.php?sucessfull=true');
					}
				}
				ob_flush();
			}
?>
<?php
		}else{
			header('location:../html/login.html');
		}
?>