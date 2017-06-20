<?php
	require_once('database.php');
	session_start();

	echo $_SESSION['month'];
	echo $_SESSION['subject_name'];
	echo $_SESSION['class'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>	</title>
	<link rel="stylesheet" type="text/css" href="css/a.css">
	<link rel="stylesheet" type="text/css" href="css/main_menu.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
	 <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/qrcodelib.js"></script>
  <script type="text/javascript" src="js/webcodecamjquery.js"></script>
</head>
<body>
<form method="POST">
	<input type="submit" value="HOME" name="home" class="btn btn-success" align="left">
</form>

<hr>
        <center><canvas></canvas>
        <hr>
        <select></select></center>
        <hr>
        <ul></ul>

  <script type="text/javascript">
           var arg = {
                resultFunction: function(result) {
                   
                     document.getElementById("barcode").value = result.code; 


                }
            };
            var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
            decoder.buildSelectMenu("select");
            decoder.play();
            /*  Without visible select menu
                decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
            */
            $('select').on('change', function(){
                decoder.stop().play();
            });
        </script>

		<form method="POST" action="<?php  $_PHP_SELF ?>">
		<table>
				<tr>	
						<td>student ID:</td>
						
						
				</tr>
				<tr>	
						<td> <input type="text" name="student_id" id="barcode"> </td>
						
						<td> <input type="submit" name="search" value="SEARCH"></td>
					
				</tr>
		</table>
		</form>

		<?php
 	if(isset($_POST['search'])){
    		$student_id = $_POST['student_id'];
    		$month = $_SESSION['month'];
    		$subject_name = $_SESSION['subject_name'];
    		$class = $_SESSION['class'];

    		$id_select = "SELECT * FROM amounts WHERE month='$month' AND student_id='$student_id' AND subject_name='$subject_name' AND class='$class'";
			$id_query = mysqli_query($connection,$id_select);
			if($id_query == false){
				die(mysqli_error($connection));
			}
			else{
				?> <table class="table" >
						<tr>
							
							<td> Subject </td>
							<td> Class </td>
							<td> Amount </td>
						</tr><?php
			 foreach ($id_query as $key => $value) {
			 		?> <tr>
			 				<td> <?php echo $value['subject_name']; ?> </td>
			 				<td> <?php echo $value['class']; ?> </td>
			 				<td> <?php echo $value['amount']; ?> </td>
			 			</tr><?php
			 }

			 ?></table> <?php

			}
	}



if(isset($_POST['home'])){
	header('location:home.php');
		session_destroy();
			session_regenerate_id();

}
	

mysqli_close($connection);

 ?>

	
 
</body>
</html>