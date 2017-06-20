<?php 
require_once('database.php');

	session_start();
if(!$_SESSION['user_name'] && !$_SESSION['password']){
	header('location:home.php');
	exit();
	}

	
			

		
	
		//unset($_SESSION['transaction_id']);
		//	unset($_SESSION['month']);
			//unset($_SESSION['student_id']);
			//unset($_SESSION['subject_name']);

		


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
				<td> <input type="submit" class="btn btn-primary" name="back" value="New Transaction"></td>
 				
				
 				
	</div>
	</tr>
	</table>
</form>

<form method="POST" enctype="multipart/form-data" action="<?php  $_PHP_SELF ?>" >
<table  class="table" border="1">
<tr width="50%" >
	<td><div class="col-sm-4" style="background-color:lavender;">MONTH:</div></td>
	<td><input type="month" name="month"></td>
</tr>
<tr class="success">
	<td><div class="col-sm-4" style="background-color:lavender;">Student ID:</div></td>
	<td> <input type="text" name="student_id" value="<?php  echo $_SESSION['student_id'];   ?> " readonly></td>
		
	


		
</tr>	
<tr>
	<td><div class="col-sm-4" style="background-color:lavender;">Subject Name:</div></td>
	<td><input type="text" name="subject_name"></td>
</tr>
<tr>
	<td><div class="col-sm-4" style="background-color:lavender;">Class:</div></td>
	<td><input type="text" name="class_text"></td>
</tr>
<tr>
	<td><div class="col-sm-4" style="background-color:lavender;">Amount:</div></td>
	<td><input type="text" name="amount"></td>
</tr>
<tr>
	<td></td>
	<td>
		
	</td>
	
</tr>
</table>
<center><table>
	<tr>
		<td>
			<div class="btn-group">
 				 <input type="submit" value="ENTER" name="save" class="btn btn-primary" style="font-size:24px;">
				 <input type="submit" value="DELETE" name="delete" class="btn btn-primary" style="font-size:24px; color:red";>
 				
			</div>
		</td>
		
	</tr>
</table></center>
<br><br><br>


<?php


if(isset($_POST['delete'])){
	
?>
<div class="alert alert-warning">
  <strong>Warning!</strong> Please Enter administrator password..
</div>
	<script>
		window.alert(
						</script>
						<center>
						
							<table>
								<tr>
									<td>delete ID:</td>
									<td>
										<input type="text" name="delete_id" size="5">
									</td>
								</tr>
								<tr>
									<td>User Name:</td>
									<td><input type="text" name="pending_username"></td>

								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="pending_password"></td>
								</tr>
								<tr>
									<td colspan="2"> <center><input type="submit" name="pending" value="Ok"></center></td>
								</tr>
							</table>
						</form>
						</center>
						<script>

					);
	</script>

<?php
}

		if(isset($_POST['pending'])){
			$delete_id = $_POST['delete_id'];
			$user_name = $_POST['pending_username'];
			$password = $_POST['pending_password'];
			$today_date = date("Y/m/d");
			
			$select_user = "SELECT * FROM user_loging WHERE user_name='$user_name' AND password='$password'";
			$user_query = mysqli_query($connection,$select_user);
			if($user_query == false){
				die(mysqli_error($connection));
			}
			else{
				foreach ($user_query as $key => $value) {
					if($value['user_role'] == "admin" || $value['user_role'] == 'admin2'){

						$select_data = "SELECT * FROM amounts WHERE id='$delete_id'";
									$select_data_query = mysqli_query($connection,$select_data);
										
											
											foreach ($select_data_query as $key => $value) {
												var_dump($value);
												$delete_month= $value['month'];
												$delete_subject_name=$value['subject_name'];
												$delete_class =$value['class'];
												$delete_amount = $value['amount'];
												$delet_enter_date =$value['today_date'];
											$insert_delete = "INSERT INTO deleted_transactions(tr_id,today_date,subject,class,amount,user_name,month,enter_date)VALUES('$delete_id','$today_date','$delete_subject_name','$delete_class','$delete_amount','$user_name','$delete_month','$delet_enter_date')";
											$de_in_query = mysqli_query($connection,$insert_delete);
											if($de_in_query == false){
												die(mysqli_error($connection));
											}
											else{
												echo "okk";
											}
											
									}
							

						$delete_id = "DELETE FROM amounts WHERE id='$delete_id'";
						$delete_query = mysqli_query($connection,$delete_id);
							if($delete_query== false){
								die(mysqli_error($connection));
							}
							else{
								?>
								<div class="alert alert-success">
 									 <strong>Success!</strong> Transaction Deleted Suc...<br>
 								</div>
 								<?php
							}
					}
					else{
						?><div class="alert alert-warning">
 									 <strong>Wrong!</strong> User Name Or Password Wrong Can't Delete it...<br>
 								</div><?php
					}
				}
					
			}
		}
	





	if(isset($_POST['save'])){
		$month = $_POST['month'];
		$student_id = $_SESSION['student_id'];
		$subject_name = $_POST['subject_name'];
		$class_now = $_POST['class_text'];
		$amount = $_POST['amount'];
		$today_date = date("Y/m/d");

			if($month == "" || $student_id == "" || $subject_name == "" || $amount == "" || $class_now == ""){
			?><div class="alert alert-info">
 				<strong>Info!</strong> Please Enter Values.......</div>
 				 
 				<?php
			exit();
			}

		
				 	
				 	
				

		$phone_select = "SELECT * FROM student_registration WHERE student_id=$student_id";
		$phone_query = mysqli_query($connection,$phone_select);


		 foreach ($phone_query as $key => $value) {
				 $phone = $value['tele_phone'];
			
		 }
		
		 
		 $Transaction = "$month$student_id$subject_name$class_now$amount$phone";
		  
							
	

		if($month == "" || $student_id == "" || $subject_name == "" || $amount == "" || $class_now == ""){
			?><div class="alert alert-info">
 				<strong>Info!</strong> Please Enter Values.......</div>
 				 
 				<?php
			exit();
		}
		else{
				$send_data = "INSERT INTO amounts(month,student_id,subject_name,class,amount,phone_number,sum,today_date)VALUES('$month','$student_id','$subject_name','$class_now','$amount','$phone','$Transaction','$today_date')";

					$query = mysqli_query($connection,$send_data);
						if($query==false){
							die(mysqli_error($connection));
						}
						else{
		   				 	?>
		   				 	<div class="alert alert-success">
 									 <strong>Success!</strong> Transaction successfuly...<br>
 									 							<table>
 									 								<tr>
 									 									<td><?php echo $month; ?> </td><td></td>
 									 									<td><?php echo $student_id; ?> </td><td></td>
 									 									<td><?php echo $subject_name; ?> </td><td></td>
 									 									<td><?php echo $amount; ?> </td>
 									 								</tr>
 									 							</table>
							</div>
		   				 <?php

		   				 	$student_id = $_SESSION['student_id'];
							$last_transaction = "SELECT * FROM amounts WHERE student_id='$student_id' AND subject_name='$subject_name'";
							$last_query = mysqli_query($connection,$last_transaction);
							if($last_query==false){
								die(mysqli_error($connection));
							}
							else{
								?><div id="data_table"><center><table class="table">
								<?php
								foreach ($last_query as $key => $value) {
									?><tr><td><?php echo $value['id']; ?></td>
										<td><font color="red"><?php echo $value['month']; ?></font></td>
									 <td><?php echo $value['subject_name']; ?></td>
									 <td><?php echo $value['class']; ?></td>
									  <td><?php echo $value['amount']; ?></td></tr>


									<?php
								}
								?></table></center></div><?php
							}





		   				 	$tr_select = "SELECT * FROM amounts WHERE sum='$Transaction'";
							$tr_query = mysqli_query($connection,$tr_select);
							if($tr_query == false){
								die(mysqli_error($connection));
							}
							else{
								foreach ($tr_query as $key => $value) {
									
									$critical_data = "INSERT INTO critical(tr_id)VALUES(".$value['id'].")";

									$critical_query = mysqli_query($connection,$critical_data);
											if($critical_query==false){
												die(mysqli_error($connection));
											}
											else{
											}
								}
								
							}


		}



				
		}

	 

	}
	if(isset($_POST['total'])){
		$select = "SELECT * FROM amounts ";
		$query = mysqli_query($connection,$select);
		if($query==false){
			die(mysqli_error($connection));
		}
		else{
			?>
					<table>
						<tr>
							<td>Total Amount: Rs.</td>
			<?php
			$total_amount = 0;
			foreach ($query as $key => $value) {
				
					?>		<td> <?php
									$total_amount+=$value['amount'];
												
			}
			?>
								<?php echo $total_amount; ?>
							</td>
						</tr>
						
					</table> <?php
			

			
		}
		
	}
	?>
		<iframe src="bill.php" width="100%" height="200">
			
		</iframe>



	<?php
	if(isset($_POST['back'])){
			$data = "DELETE FROM critical";
			$data_query = mysqli_query($connection,$data);
				if($data_query==false){
				 die(mysqli_error($connection));
				 }
				else{
				 							
				 }


		session_start();

		
		header('location:start_normal_user.php');
		

	}

	

	

	
mysqli_close($connection);
?>
</body>
</html>