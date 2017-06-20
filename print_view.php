<?php
  session_start();

  require_once('database.php');
  			$id = $_SESSION['transaction_id'];
			$month = $_SESSION['month'];
			$student_id = $_SESSION['student_id'];
			$subject_name = $_SESSION['subject_name'];

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

if($id || $month || $student_id || $subject_name != '' ){



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
					<table>
						<tr><td></td></tr>
						<tr><td></td></tr>
						<tr>
							<td><b>Transaction ID</b></td>
							<td><b>Month</b></td>
							<td><b>Student Id</b></td>
							<td><b>Student Name</b></td>
							<td><b>Subject Name</b></td>
							<td><b>Amount</b></td>
						</tr>
						

			<?php
			$total_amount_categary = 0;
			foreach ($find_query as $key => $value) {
				 ?>
					
						<tr>
							<td><?php echo $value['id']; ?></td>
							<td> <?php echo $value['month']; ?> </td>
							<td> <?php echo $value['student_id']; ?> </td>
								<?php   
							     	$student_name_add = "SELECT * FROM student_registration WHERE student_id = ".$value["student_id"]."";
							     	$student_query = mysqli_query($connection,$student_name_add);
							     	if($student_query == false){
							     		die(mysqli_error($connection));
							     	}
							     	else{
							     		foreach ($student_query as $key => $value1) {
							     			?><td> <?php echo $value1['student_name']; ?> </td><?php
							     		}
							     	}
							     		

							     ?>

							<td><?php echo $value['subject_name']; ?> </td>
							<td> <?php echo $value['amount']; ?> </td>

							
							     
						
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
				<td><b>Total:</b></td>
				<td><b> <?php echo $total_amount_categary; ?> </b></td>
				
				</td>
			</tr>
			</table> 
		</div>
		</center>

			<form method="POST"><input type="submit" name="pdf" value="Pdf"></form>

			<button onclick="window.open('data:application/vnd.ms-excel,'+document.getElementById('data_table').innerHTML);">Excel Sheet..</button>
						<?php
							
						


			
		}  

}

mysqli_close($connection);

		?>

		<iframe src="test.php" width="100%" height="200">
			
		</iframe>

</body>
</html>