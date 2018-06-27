<?php
	session_start();
	ob_start();
	if(isset($_SESSION['userName'])){
		$asset_id = $_GET['id'];
		require("connection.php"); 
		
		$sql="select * from asset_details where aid='$asset_id'";
		$result=mysqli_query($con,$sql) or die("error getting data");
		$count = mysqli_num_rows($result);
		if($count!=0){
			$row=mysqli_fetch_row($result);
	
			$asset_name = $row[1];
			$asset_details = $row[2];
			$vendor_name = $row[3];
			$date = $row[4];
			$file_name = $row[5];
	
			
?>
<html lang="en">
<head>
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Update Details</title>
<link rel="icon" href="../images/AMS3.ico" type="image/ico">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="../css/menu.css"> 
<link rel="stylesheet"  href="../css/loginregister.css">
  <!-- For Sweet alert-->
	<script src="../sweetalert/sweetalert.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">
</head>
<body>

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
			<h2>Update Details Here</h2>
			<p class="lead"></p>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input id="asset_name" type="text" class="form-control" name="asset_name" placeholder="Asset Name" value="<?php echo $asset_name ?>" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
					<input id="asset_details" type="text" class="form-control" name="asset_details" placeholder="Asset Details" value="<?php echo $asset_details ?>" required >
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="date" class="form-control"  placeholder="Date" name="date" value="<?php echo $date ?>" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
					<input id="vendor_name" type="text" class="form-control"  placeholder="Vendor Name" name="vendor_name" value="<?php echo $vendor_name ?>" required>
				</div>
			</div>
			
			 <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-image"></i></span>
					<input type="text" id="file_name" name="file_name" class="form-control" disabled placeholder="<?php echo $file_name ?>">
					<span  style="display: -webkit-box;cursor:pointer;" onclick="uploadFile()"><i  class="fa fa-upload"></i></span>
				</div>
			</div>
			
			<input type="file" id="file_id" name="upload_bill" style="visibility:hidden">
			  <div class="form-group" >
			
				<button type="submit" id="btnSubmit" style="width:100px" class="btn btn-primary pull-right" name="update_asset_details">Update <i class="fa fa-angle-right"></i></button>
			</div>

		</form>
	</div>
	
	<script>
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
		
		
		 function successMessage(){
			 swal({
					title:"Updated", 
					text:"Record has been updated successfully.", 
					type:"success"
			 }, function (){
				 	location='view_asset_details.php';
			 });
		 }
		 
		 	 function errorMessage(){
			 swal({
					title:"Error", 
					text:"Error while updating record.", 
					type:"error"
			 }, function (){
				 	location='view_asset_details.php';
			 });
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
			if(isset($_POST['update_asset_details'])){
				
	
				$new_asset_name = $_POST['asset_name'];
				$new_asset_details = $_POST['asset_details'];
				$new_date = $_POST['date'];
				$new_vendor_name = $_POST['vendor_name'];
				$new_file=$_FILES['upload_bill']['tmp_name'];
				$new_image=addslashes(file_get_contents($_FILES['upload_bill']['tmp_name']));
				$new_image_name=addslashes($_FILES['upload_bill']['name']);
				$new_image_size=getimagesize($_FILES['upload_bill']['tmp_name']);
				
				echo $new_asset_name;
				echo $new_asset_details;
				echo $new_date;
				echo 'file'.$new_file;
				
				$sql_update = "update asset_details set asset_name='$new_asset_name', asset_details='$new_asset_details', date='$new_date', vendor_name='$new_vendor_name', file_name='$new_image_name',bill_image='$new_image' where aid='$asset_id' ";
				if(!$result_update = $con->query($sql_update)){
					echo "<script type='text/javascript'>
					errorMessage();
				
					</script>";
					die('There was an error running the query [' . $con->error . ']');
				}else{
					echo "<script type='text/javascript'>
					successMessage();
				
					</script>";
					//header('location:view_asset_details.php');
				}
			}
			
			
		}else{
			header('location:menu.php');
		}
			ob_flush();
	}else{
		header('location:../html/login.html');
	}
?>