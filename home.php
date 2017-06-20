<?php
	require_once('database.php');
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>home_page</title>
	<link rel="stylesheet" type="text/css" href="css/a.css">
	<link rel="stylesheet" type="text/css" href="css/main_menu.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	
</head>
<body style="background-color: rgb(184,180,184);">
 <form method="POST" enctype="multipart/form-data" action="" role="form">
 		<?php
 				if(isset($_POST['check'])){
						?>
						<script type="text/javascript">
											window.alert(
													</script>
													<div id='box1'>
													<table class="table">
														<tr>
															<td>MONTH:</td>
															<td><input type="month" name="month"></td>
														</tr>
														<tr>
															<td>SUBJECT:</td>
															<td><input type="text" name="subject"></td>
														</tr>
														<tr>
															<td>CLASS:</td>
															<td><input type="text" name="class"></td>
															<td><input type="submit" name="confirm_data" value="confirm" color="blue">
														</tr>

													</table>
													</div>		
													<script>
											);
						</script>


	<?php
}

if(isset($_POST['confirm_data'])){
	$month = $_POST['month'];
	$subject_name = $_POST['subject'];
	$class = $_POST['class'];

	if($month == '' || $subject_name == '' || $class == ''){
		
	
	}
	else{
	session_start();
	$_SESSION['month'] = $_POST['month'];
	$_SESSION['subject_name'] = $_POST['subject'];
	$_SESSION['class'] = $_POST['class'];
	header('location:search_user.php');
}
}


 		?>


 <input type="submit" class="btn btn-primary" name="check" value="CHECK">
 <center>
 		<table  width="700" height="500">
 			<tr>
 				<td></td>
 			</tr>
 			<tr>
 				<td> <center><table width="300" height="200" style="box-shadow:0px 0px 3px 3px black;">
 					<tr>
 						</center><td style="color:blue;"><center>User Name:</center></td>
 						<td><input type="text" name="user_name"></td>
 					</tr>
 					<tr>
 						<td style="color:blue;"><center>Password:</center></td>
 						<td><input type="password" name="password"></td>
 					</tr>
 					<tr>
 						<td colspan="2"><center><input type="submit" name="login" value="Login" style="color:blue; width: 100px; height: 40px; "></center></td>
 					</tr>
				</table></center></td>
 	
 	
 			
 			</tr>
 		</table>
 </center>
 </form>
<?php 



  
  if(isset($_POST['login'])){
  	$user_name = $_POST['user_name'];
  	$u_password = $_POST['password'];

  	$send_user = "SELECT * FROM user_loging where user_name='$user_name' and password='$u_password'";
  	
  	$query1 = mysqli_query($connection,$send_user); 
							
		if($query1==false){
			die(mysqli_error($connection));
									}

		else {
			foreach ($query1 as $key => $value) {
			if($value['user_role'] == 'admin' || $value['user_role'] == 'admin2'){
					session_start();
					session_regenerate_id();
						$_SESSION['admin_user_name'] = $value['user_name'];
						$_SESSION['admin_password']  = $value['password'];
						$_SESSION['id'] = session_id();
						header('location:user_register.php');
						exit();
					session_destroy();
			}
			else if($value['user_role'] == 'normal_user'){
				
					session_start();
					session_regenerate_id();
						$_SESSION['user_name'] = $value['user_name'];
						$_SESSION['password']  = $value['password'];
						$_SESSION['id'] = session_id();
						
						header('location:start_normal_user.php');
						exit();
					session_destroy();
			
			}	
			

		
  }}
 } 



mysqli_close($connection);
 ?>

</body>
</html>