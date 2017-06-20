<?php
	session_start();
		
if(!$_SESSION['admin_user_name'] && !$_SESSION['admin_password']){
	header('location:home.php');
	exit();
	}

require_once('database.php');
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
</head>
<body>
<form method="POST" action="<?php  $_PHP_SELF ?>">
	<table align="right">
	<tr>
	<div class="btn-group">
				<td><td> <input type="submit" value="DELETE report" name="deletete_report" class="btn btn-success" ></td></td>
						<script type="text/javascript">
							window.alert(
							</script>
									<?php 
										if(isset($_POST['deletete_report'])){
											$select_delete_data = "SELECT * FROM deleted_transactions";
											$de_query = mysqli_query($connection,$select_delete_data);
											if($de_query == false){
												die(mysqli_error($connection));
											}
											else{
												?> <table class="table">
													<tr>
														<td> TR ID </td>
														<td> SUBJECT NAME </td>
														<td> CLASS </td>
														<td> AMOUNT </td>
														<td> USER NAME </td>
														<td> MONTH </td>
														<td> ENTER DATE </td>
														<td> DELETED DATE </td>
													</tr><?php
													foreach ($de_query as $key => $value) {
														?><tr>
															<td> <?php echo $value['tr_id']; ?> </td>
															<td> <?php echo $value['subject']; ?> </td>
															<td> <?php echo $value['class']; ?> </td>
															<td> <?php echo $value['amount']; ?> </td>
															<td> <?php echo $value['user_name']; ?> </td>
															<td> <?php echo $value['month']; ?> </td>
															<td> <?php echo $value['enter_date']; ?> </td>
															<td> <?php echo $value['today_date']; ?> </td>
													</tr><?php
												
													}
													?>	</table><?php

											}
										}?>


						<script>

								);
						</script>
				<td><td> <input type="submit" value="Enter Transaction" name="new_transaction" class="btn btn-success" ></td></td>
				<td><td> <input type="submit" value="Student Detail" name="user" class="btn btn-success" ></td></td>
				<td><td> <input type="submit" value="Change User Name & Password" name="user" class="btn btn-success" ></td></td>
 				<td> <input type="submit" value="NEW Student Register" name="register" class="btn btn-success" ></td>
				 <td><input type="submit" value="Log out" name="log_out" class="btn btn-danger"></td>
 				
	</div>
	</tr>
	</table>
</form>
	<form method="POST" enctype="multipart/form-data" action="">
	
		<center><table>
		<th>
			<center>Search by categary</center>
		</th>
		<tr>
			<td></td>
			<td>id:</td>
			<td>Month:</td>
			<td>Student Id:</td>
			<td>Subject Name:</td>
			<td>Daily Report:</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Categary:</td>
			<td><input type="search" name="id"></td>
			<td><input type="month" name="month"></td>
			<td><input type="search" name="student_id"></td>
			<td><input type="search" name="subject_name"></td>
			<td><input type="text" name="find_date"></td>
            <td> <input type="submit" class="btn btn-info" name="find" value="Search By Categary"></td>
     		<td><span class="glyphicon glyphicon-search"></span> </td>
    		<td><input type="submit" class="btn btn-info" name="delete_categary" value="Delete By"></td>	
    		
		  </tr>

	</table></center>

	<?php if(isset($_POST['user'])){?>
	<script type="text/javascript">
		window.alert(

					</script>
			<center><table>
			<th> Change User Name And Passwords....</th>
			<tr>
				<td>User Role:</td>
				<td><?php
					$select = "SELECT * FROM user_loging";
						$query = mysqli_query($connection,$select);
						if($query==false){
							?><div class="alert alert-warning">
 						 		<strong>Warning!</strong> <?php  die(mysqli_error($connection)); ?>
							</div> <?php
						}
						else{
				?>
						
						<select name="user role">
								<?php foreach ($query as $key => $value) { ?>
									<option><?php echo $value['user_role']; ?></option>>
								<?php } ?>
						</select>
				<?php  } ?>
				</td>
			</tr>
			<tr>
				<td>User Name:</td>
				<td><input type="text" name="new_user_name"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="Password" name="password"></td>
			</tr>
			<tr>
				<td>Re Enter:</td>
				<td><input type="Password" name="Re_password"></td>
			</tr>
			<tr>
				<td colspan="2"><center><input type="submit" name="update" value="Update"></center></td>
			</tr>
		</table></center>
		</form>
		<script>
			);



	</script>
<?php  }

			
						if(isset($_POST['update'])){
							$user_role = $_POST['user_role'];
							$new_uname = $_POST['new_user_name'];
							$password = $_POST['password'];
							$Re_password = $_POST['Re_password'];

							if($password == ""){
								?><div class="alert alert-warning">
 										<strong>Warning!</strong> Please Enter Password...
								</div> <?php
							}
							else{
								if($password!=$Re_password){
									echo "Password Not Matching...";
									exit();
								}
								if($new_uname == ""){
									echo "please enter user name...";
									exit();
								}
								else{
								$send = "UPDATE user_loging SET password = '$password',user_name = '$new_uname' WHERE user_role='$user_role'";

								$query = mysqli_query($connection,$send);
								if($query==false){
									die(mysqli_error($connection));
								}
								else {
					
									?><div class="alert alert-success">
 									 <strong>Success!</strong> User Account Update Successfull..
								</div><?php
						}
				}

			}

			
		}




			






  ?>
	<?php




//if(isset($_POST['delete_all'])){
		
		//$delete_month = $_POST['month'];
			
				//	$data = "DELETE FROM amounts";
				//	$data_query = mysqli_query($connection,$data);
				 	//	if($data_query==false){
				 	//		die(mysqli_error($connection));
					//	 }
					//	else{
				 		//	 </font> <?php
				 		//}
				 			
	//}
	if(isset($_POST['delete_categary'])){
		$id = $_POST['id'];
		$month = $_POST['month'];
		$student_id = $_POST['student_id'];
		$subject_name = $_POST['subject_name'];
		$today_date = $_POST['find_date'];
		
		$data = array();

			if($id || $month || $student_id || $subject_name || $today_date != '' ){



					$result = "";

			if($id != ''){

					$data[] = " id = '".$id."' "; 
			}
			if($month != ''){

					$data[] = " month = '".$month."' ";
			}
			if($student_id != ''){
					$data[] = " student_id = '".$student_id."' ";


			}
			if($subject_name != ''){
					$data[] = " subject_name = '".$subject_name."' ";

			}
			if($today_date != ''){
					$data[] = " today_date = '".$today_date."' ";

			}





					$query2 = array();
						foreach ($data as $key => $value) {
	
								array_push($query2, $value);
								$query2[] = ' AND ';



						}
 					$new2 = array_pop($query2);

					$new_str = "";
							foreach ($query2 as $key => $value) {
	
									$new_str .= $value;

							}



					$find = "SELECT * FROM amounts WHERE {$new_str}";
					$find_query = mysqli_query($connection,$find);
						if($find_query==false){
							die(mysqli_error($connection));
						}
						else{
			
									
				 			
			





			
						?>
							<center>
							<div id="data_table">
								<table class="table">
									<tr><td></td></tr>
									<tr><td></td></tr>
									<tr>
										<td><font color="green">Date Of Entered</font></td>
										<td><font color="green">Transaction ID</font></td>
										<td><font color="green">Month</font></td>
										<td><font color="green">Student Id</font></td>
										<td><font color="green">Student Name</font></td>
										<td><font color="green">Subject Name</font></td>
										<td><font color="green">Amount</font></td>
									</tr>
						

						<?php
								$total_amount_categary = 0;
								foreach ($find_query as $key => $value) {
						 ?>
					
									<tr>
										<td><font color="red"><?php echo $value['today_date']; ?></font></td>
										<td><font color="red"><?php echo $value['id']; ?></font></td>
										<td><font color="red"> <?php echo $value['month']; ?> </font></td>
										<td><font color="red"> <?php echo $value['student_id']; ?> </font></td>
									<?php   
							     	$student_name_add = "SELECT * FROM student_registration WHERE student_id = ".$value["student_id"]."";
							     	$student_query = mysqli_query($connection,$student_name_add);
							     	if($student_query == false){
							     		die(mysqli_error($connection));
							     	}
							     	else{
							     		foreach ($student_query as $key => $value1) {
							     			?><td><font color="red"> <?php echo $value1['student_name']; ?> </font></td><?php
							     		}
							     	}
							     		

							     ?>

									<td><font color="red"> <?php echo $value['subject_name']; ?> </font></td>
									<td><font color="red"> <?php echo $value['amount']; ?> </font></td>
							
						</tr>
					
				<?php
				
			}
			
			?> </table><?php
				 			
			}	
	}
		?>
			<script>
					window.alert(

					</script>				
					?><form method="POST">
							<input type="text" name="delete_value" value="<?php  echo $new_str;   ?> " readonly>
							<input type="submit" name="confirm_de" value="delete">
					  </form><?php
					  	
							
				 	?>	<script>

						);

			</script>
		<?php

		}

			if(isset($_POST['confirm_de'])){
									$delete_confirm = $_POST['delete_value'];
									$data_delete = "DELETE FROM amounts WHERE {$delete_confirm}";
									$data_cat_query = mysqli_query($connection,$data_delete);
								 		if($data_cat_query==false){
								 			die(mysqli_error($connection));
										 }
										else{
							
				 						?>	<div class="alert alert-success">
 												 <strong>Success!</strong> Deleted successful...<?php echo $delete_confirm; ?><br>
 											</div><?php
				 							exit();
				 						}

				 					}

	



		

		if(isset($_POST['log_out'])){
		header('location:home.php');
		session_destroy();

		}


		if(isset($_POST['find'])){
		$id = $_POST['id'];
		$month = $_POST['month'];
		$student_id = $_POST['student_id'];
		$subject_name = $_POST['subject_name'];
		$today_date = $_POST['find_date'];

		session_start();
			$_SESSION['transaction_id'] = $id;
			$_SESSION['month'] = $month;
			$_SESSION['student_id'] = $student_id;
			$_SESSION['subject_name'] = $subject_name;
			$_SESSION['today_date'] = $today_date;

		header('location:EXCEL.php');
		header('location:PDF.php');

	}
	if(isset($_POST['register'])){
		?><iframe src="student_register.php" width="100%" height="500">
			
		</iframe><?php

		
	}

	if(isset($_POST['new_transaction'])){
		
		
		session_start();
		$_SESSION['user_name'] = $_SESSION['admin_user_name'];
		$_SESSION['password'] = $_SESSION['admin_password'];
		header('location:start_normal_user.php');

	}

	
mysqli_close($connection);
	?>

</body>
</html>