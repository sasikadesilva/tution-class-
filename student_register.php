<?php 
require_once('database.php');
  session_start();
 
if(!$_SESSION['user_name'] && !$_SESSION['password']){
	header('location:home.php');
	exit();
	}





 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" type="text/css" href="css/a.css">
	<link rel="stylesheet" type="text/css" href="css/main_menu.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="dist/JsBarcode.all.js"></script>
</head>
<body style="background-color: rgb(184,184,184);">

<center><table  width="700" height="500" class="table">
	
	</tr>
	<tr>
		<td><center><form method="POST" enctype="multipart/form-data" action="<?php  $_PHP_SELF ?>">
		<table class="table table-condensed" style="background-color:rgb(177, 211, 183);">
			<tr>
				<td>Student Id:</td>
				<td><input type="text" name="student_id" id="text"></td>
			</tr>
			<tr>
				<td>Student Name:</td>
				<td><input type="text" name="student_name"></td>
			</tr>
			<tr>
				<td>Scheme:</td>
				<td><input type="text" name="scheme"></td>
			</tr>
			<tr>
				<td>Tele Phone:</td>
				<td><input type="text" name="tele_phone"></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type="text" name="address"></td>
			</tr>
			<tr><td colspan="2">
								<center><input type="submit" name="register" value="Register"></center>
				</td></tr>
		</table>
		
		</form></center></td>
	</tr>


	<?php


		if(isset($_POST['register'])){
			$student_id = $_POST['student_id'];
			$student_name = $_POST['student_name'];
			$scheme = $_POST['scheme'];
			$tele_phone = $_POST['tele_phone'];
			$address = $_POST['address'];

			$send_data = "INSERT INTO student_registration(student_id,student_name,scheme,tele_phone,address)VALUES('$student_id','$student_name','$scheme','$tele_phone','$address')";

			$query = mysqli_query($connection,$send_data);
			if($query == false){
				?> 
					<div class="alert alert-warning">
 						 <strong>Warning!</strong> <?php  die(mysqli_error($connection)); ?>
					</div> 
				<?php
				
			}
			else{

				?>	<form method="POST">
				<div class="alert alert-success">
 						 <strong>success!</strong> Registration successfull....; ?>
					</div> 
					<input type="submit" name="b_save" value="save">
						<div>
						<img id="barcode1" name='image'>
								<script>JsBarcode("#barcode1", "<?php echo $student_id ?>");</script>
						</div></form><?php

					
							

		
		
			}


			
		}

		if(isset($_POST['b_save'])){
						$image_name = $_FILES['image']['name'];
						$image_tmp_name = $_FILES['image']['tmp_name'];

						if($image_name){
								move_uploaded_file($image_tmp_name,"profile_picture/$image_name"); //save the picture to external folder

							}

					}	

		if(isset($_POST['log_out'])){
			header('location:home.php');
			session_destroy();
			session_regenerate_id();
		}

mysqli_close($connection);
	?>
</table></center>
</body>
</html>