<?php
	session_start();
	if(isset($_SESSION['userName'])){
?>

<html>
<head>
	<title> View</title> 
	<link rel="icon" href="../images/AMS3.ico" type="image/ico">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../jquery/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
  
  <!-- For Sweet alert-->
	<script src="../sweetalert/sweetalert.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">
  
  
    <script>
		function confirmDelete(x){
			var asset_id = x
			
			swal({
				title: "Are you sure you want to delete this record!!!?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "CONFIRM",
				cancelButtonText: "CANCEL",
				closeOnConfirm: false,
			},
				function(){
					$.ajax({
						type : 'POST',
						data : 'assetId='+asset_id,
						url  : '../php/delete_asset.php',
						success:function(responsedata){
							swal({
								title:"Deleted!", 
								text:"Record has been deleted successfully.", 
								type:"success"
							},function(){
									location.reload()
								}
							);
						}
					});
				}		
			);
		}
		
		function showimage(x){
			var modal = document.getElementById("myModal");
			var modalImg = document.getElementById("modalImg");
			var aid = x;
			$.ajax({
				type : 'POST',
				data : 'assetId='+aid,
				url  : '../php/getblob.php',
				success:function(responsedata){
				
					modal.style.display = "block";
					modalImg.src = responsedata;
				}
			});	
		}
		
		  
			$(document).ready(function(){
				$('#query').on('keyup',function(){
				var searchTerm = $(this).val().toLowerCase();
				$('#data tbody tr').each(function(){
					var lineStr = $(this).text().toLowerCase();
					if(lineStr.indexOf(searchTerm) === -1){
						$(this).hide();
					}else{
						$(this).show();
					}
				});
				});
			});
			
			 $(document).ready(function () {
			$("#selectAll").click(function () {
				$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
			});
			
			$("#deleteAll").click(function (){
				
				var deleteArray = [];
				$( "input:checked" ).each(function(){
					
					var checkBoxId = $(this).attr("id");
					if(checkBoxId != "selectAll"){
						deleteArray.push(checkBoxId);
					}
				});
				
				if(deleteArray.length > 0){
				
					
					swal({
						title: "Are you sure you want to delete multiple records?",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "CONFIRM",
						cancelButtonText: "CANCEL",
						closeOnConfirm: false,
					},
						function(){
							deleteArray.forEach(function(deleteElement) {
							 
							  $.ajax({
									type : 'POST',
									data : 'assetId='+deleteElement,
									url  : '../php/delete_asset.php',
									success:function(responsedata){
									}
								});
							});
							swal({
								title:"Deleted", 
								text:"All selected Record has been deleted successfully.", 
								type:"success"
							},function(){
									location.reload();
								}
							);
						}		
					);
				}
				
			});
			
		});
		 
		 

  </script>
  

</head>
<style>
.modal-body{
  height: 490px;
  overflow-y: auto;
}
</style>
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
				
		<div>
			<input class="form-control" style="	margin-left: 375px; margin-bottom: 10px;width: 40%;" type="text" id="query" placeholder="Search" aria-label="Search">
		</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Image</h4>
      </div>
      <div class="modal-body">
		<img id="modalImg" src="">  
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End of Modal -->

<div class="container">
	<div class="row">

	<?php
		require("connection.php");
		/********************************Pagination Logic**********************************/
		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
		
		$total_pages_sql = "SELECT COUNT(*) FROM asset_details";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM asset_details LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);
		
		/********************************Pagination Logic**********************************/
		
		echo "<table class='table table-bordred table-striped' id='data' >";
		echo " <thead >
		<tr>
			<th style='text-align:center'><input type='checkbox'  id='selectAll' /></th>
			<th style='text-align:center' >ASSET NAME</th>
			<th style='text-align:center' >ASSET DETAILS</th> 
			<th style='text-align:center' >VENDOR NAME</th>
			<th style='text-align:center' >DATE</th>
			<th style='text-align:center' >BILLS</th>
			<th style='text-align:center' >Action</th>
			</tr> 
		</thead>
		<tbody>";
		while ($row=mysqli_fetch_row($res_data)){
			$row_id = $row[0];
			echo "<tr>";
			echo "<td style='text-align:center;width:10%'>"; 
			echo "<input type='checkbox' id='$row_id' /> ";
			echo "</td>";
			echo "<td style='text-align:center' >";
			echo $row[1];
			echo "</td><td style='text-align:center' >";
			echo $row[2];
			echo "</td><td style='text-align:center' >";
			echo $row[3];
			echo "</td><td style='text-align:center' >";
			echo $row[4];
			echo "</td><td style='text-align:center' ><button onclick=\"showimage($row_id)\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">";
			echo "<i class='fa fa-file' aria-hidden=\"true\"></i></button></td>";
			echo "<td style='cursor:pointer;text-align:center'  >
						<a href='../php/update_details.php?id=$row_id' style='color:black'><i class='fa fa-pencil'></i></a> | 
						<span onclick='confirmDelete($row_id)'><i class='fa fa-trash'></i></span> 
					</td>
				</tr>";
			
		}
		
		echo "</tbody></table>";
		
	?>	
		<!--<button id="deleteAll"> Delete </button>-->


<div class="bs-example">
		<button id="deleteAll" class="pull-left"> Delete </button>
    <ul class="pagination pull-right">

        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
			<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</div>
	</div>
</div>

</body>
</html>
<?php
	}else{
		header('location:../html/login.html'); 
	}
?>