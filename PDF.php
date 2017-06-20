<?php
  session_start();




  require_once('database.php');
  			$id = $_SESSION['transaction_id'];
			$month = $_SESSION['month'];
			$student_id = $_SESSION['student_id'];
			$subject_name = $_SESSION['subject_name'];
			$today_date = $_SESSION['today_date'];

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

	<ul class="pager">
    <li><a href="http://localhost/php%20projects/tution%20class/user_register.php">Previous</a></li>
    
  </ul>

<?php

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

							
							     
						
							<?php $total_amount_categary+=$value['amount']; ?>
							
						</tr>
					
				<?php
				
			}
			?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><font color="blue">Total:</font></td>
				<td><font color="blue"> <?php echo $total_amount_categary; ?> </font></td>
				
				</td>
			</tr>
			</table> 
		</div>
		</center>

			<form method="POST"><input type="submit" name="pdf" value="Pdf"></form>
						<?php
							if(isset($_POST['pdf'])){
								?>
								<script type="text/javascript">

			                                print('data_table');

		                        </script><?php
							}
						


			
		}  

}

mysqli_close($connection);

		?>

	<iframe src="EXCEL.php" width="100%" height="200">
			
		</iframe>	

</body>
</html>