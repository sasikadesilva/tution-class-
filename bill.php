<?php require_once('database.php');
session_start();
if(!$_SESSION['user_name'] && !$_SESSION['password']){
	header('location:main_home.php');
	exit();
	}
 ?>

<html>

<head>
	
	
	<title>Editable Invoice</title>
	
	

</head>

<body>
<?php
$student_id = $_SESSION['student_id']; 
 
 					 $cr_data_select = "SELECT * FROM critical";
					 $cr_query = mysqli_query($connection,$cr_data_select);
							if($cr_query == false){
								die(mysqli_error($connection));
							}
							else{
								?>
								<center>
								
									<table  width="600">
									
									<form method="POST"><input type="submit" name="pdf" value="      සිසු නැන         " style="font-size: 30px; background-color:white;" width=""></form><br><br><br><br>
									<?php
										$student_detail = "SELECT * FROM student_registration WHERE student_id =$student_id";
										 $student_query = mysqli_query($connection,$student_detail);
											if($student_query == false){
												die(mysqli_error($connection));
											}
											else{
												
												foreach ($student_query as $key => $value) {
													?>
														<tr>
															<td><b>Student ID:</b></td>
															<td><?php echo $value['student_id']; ?></td>
															<td align="right"><?php echo date("Y/m/d"); ?></td>
														</tr>
														<tr>
															<td><b>Name:</b></td>
															<td><?php echo $value['student_name']; ?></td>
														</tr>
														<tr>
															<td><b>Phone No:</b></td>
															<td><?php echo $value['tele_phone']; ?></td>
														</tr>
														<tr>
															<td><b>Address:</b></td>
															<td><u><?php echo $value['address']; ?></u></td>
														</tr>
														<tr><td></td></tr>
														<tr><td></td></tr>



													<?php
												}
												?> </table> <?php
											}
									?>
									<table width="500">
										<tr>
											<td><b>Transaction ID</b></td>
											<td><b>Month</b></td>
											<td><b>Subject Name</b></td>
											<td align="right"><b>Amount</b></td>
										</tr>
								<?php
								$total_amount_categary = 0;
								foreach ($cr_query as $key => $value) {

									 $cr_transaction_select = "SELECT * FROM amounts WHERE id=".$value['tr_id']."";
									 $transaction_query = mysqli_query($connection,$cr_transaction_select);

									 foreach ($transaction_query as $key => $value) {
												
											
										?>

										<tr>
											<td> <?php echo $value['id']; ?></td>
											<td> <?php echo $value['month']; ?></td>
											<td> <?php echo $value['subject_name']; ?></td>
											<td align="right"> <?php echo $value['amount']; ?></td>
										</tr>
												<?php $total_amount_categary+=$value['amount']; ?>
										<?php
										}

								}
									?> <?php
							}


								?>	<tr><td colspan="3" align="right"><b>Total:</b></td>
										<td align="right"><b> <?php echo $total_amount_categary; ?> </b></td></tr>
									</table> </div></div></center>

								<?php
?>

	
						<?php
							if(isset($_POST['pdf'])){
								?>
								<script type="text/javascript">

			                                print();


		                        </script> <?php
				 						}
mysqli_close($connection);
							?>

</body>

</html>