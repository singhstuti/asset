<?php
	session_start();
	if(isset($_SESSION['correct_answer'])){
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Enter New Password</title>
<link rel="icon" href="../images/AMS3.ico" type="image/ico">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="../css/loginregister.css">
<script src="../js/register_validation.js"></script>
</head>

<body>
<div class="signup-form">	
	<form action="../php/update_password.php" method="POST" onSubmit="return validateForm();">
	<h2>Enter New Password</h2>
	
	<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
				<span   style="display: -webkit-box;cursor:pointer;" onclick="showpassword()"><i id="passwordeye" class="fa fa-eye"></i></span>
			</div>
        </div>
		<div class="form-group">
			<div class="input-group" id="password_message" style="display:none">
			</div>
        </div>
	<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-lock"></i>
					<i class="fa fa-check"></i>
				</span>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
					<span style="display: -webkit-box;cursor:pointer;" onclick="showpass()"><i id="confirm_passwordeye" class="fa fa-eye"></i></span>
			</div>
        </div>     
		<div class="form-group">
			<div class="input-group" id="confirm_password_message" style="display:none">
			</div>
        </div>
	<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Submit</button>
        </div>
		
		<div id="messageBox" style="display:none" align="center"></div>
	</form>	
	
	
	
	
	<script>
		function showpassword(){
		
			var x=document.getElementById("password");
				
				if(x.type==="password"){
				x.type="text";
				document.getElementById("passwordeye").className = "fa fa-eye-slash";
				}else{
					x.type="password";
					document.getElementById("passwordeye").className = "fa fa-eye";
				}
				
		}
		
		function showpass(){
			var x=document.getElementById("confirm_password");
				if(x.type==="password"){
				x.type="text";
				document.getElementById("confirm_passwordeye").className = "fa fa-eye-slash";
				
				}else{
					x.type="password";
					document.getElementById("confirm_passwordeye").className = "fa fa-eye";
				}
		}
		
		
		$(document).ready(function(){
			$('#password').keyup(function(){
				if($(this).val().length>0){
					$('#messageBox').hide();
				}
			});
			$("#password").keyup(function(){
			hidePasswordMessage();
		});
		
		$("#confirm_password").keyup(function(){
			hidePasswordMessage();
		});
		
	});
		
		
		
		function hidePasswordMessage(){
		var div1 = document.getElementById("password_message");
		var div2 = document.getElementById("confirm_password_message");
		
		div1.innerHTML = "";
		div1.style.display = "none";
		
		div2.innerHTML = "";
		div2.style.display = "none";
	}	
	</script>
	
</body>
</html>


<?php
	}else{
		header('location:../html/login.html');
	}
?>