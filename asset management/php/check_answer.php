<?php
	session_start();	
	if(isset($_SESSION['Question'])){
		$question = $_SESSION['Question'];
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Check Answer</title>
<link rel="icon" href="../images/AMS3.ico" type="image/ico">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="../css/loginregister.css">
</head>

<body onload="checkLogin()">
<div class="signup-form">	
	<form action="" method="POST">
	<h2>Give Answer</h2>
	
	<div align="center">
		<div class="input-group">
			<span class="input-group-addon" style="border:0;"><i class="fa fa-question-circle"></i></span>
			<label style="font-size:15px;color:black;"><?php echo "$question" ?></label>
		</div>
    </div>
	
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
			<input id="answer" type="text" class="form-control" name="answer" placeholder="Security Answer" required>
		</div>
    </div>
		
	<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Submit</button>
        </div>
		<div id="message" style="display:none" align="center">
		Incorrect Answer.
	</div>
	</form>	
</div>	
	
	
	<script>
		function checkLogin(){
			var url_string =  window.location.href;
			var url = new URL(url_string);
			var errorMsg = url.searchParams.get("wrongAnswer");
			
			if(errorMsg!=null){
				var div = document.getElementById("message");
				div.style.color = "red";
				div.style.display = "block";
			}
		}
		
		$(document).ready(function(){
			$('#answer').keyup(function(){
				if($(this).val().length>0){
					$('#message').hide();
				}
			});
		});
		
	</script>
	
</body>
</html>

<?php
		if(isset($_POST['submit'])&& isset($_SESSION['username'])){
			include('connection.php');
			$username=$_SESSION['username'];
			$answer=$_POST['answer'];
			
			$sql="select security_answer from user_details where user_name='$username'";
			$result=mysqli_query($con,$sql);
			while ($row=mysqli_fetch_row($result)){
				$db_answer = $row[0];
			}
			if (strcasecmp($db_answer, $answer) == 0) {
				$_SESSION['correct_answer'] = "true";
				header('location: change_password.php');
			}else{
				header('location: check_answer.php?wrongAnswer=true');
			}
		}
	}else{
		header('location:../html/login.html');
	}
?>