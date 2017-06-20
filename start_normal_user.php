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
 <meta charset="UTF-8">
	<title></title>
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

<form method="POST" action="<?php  $_PHP_SELF ?>">
	<table align="right">
	<tr>
	<div class="btn-group">
 				<td> <input type="submit" value="NEW Student" name="register" class="btn btn-success" ></td>
				 <td><input type="submit" value="Log out" name="log_out" class="btn btn-danger"></td>
 				
	</div>
	</tr>
	</table>
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
	<td>Student Id:</td>
	<td>
		 <input type="text" name="student_id" id="barcode">
		 	 
	</td>
	<td>
		<input type="submit" name="search">
	</td>
</tr>
	</table>
	
</form>

 <?php

                     	
						
                   





    	if(isset($_POST['search'])){
    		$student_id = $_POST['student_id'];

    		$id_select = "SELECT * FROM student_registration";
			$id_query = mysqli_query($connection,$id_select);
			if($id_query == false){
				die(mysqli_error($connection));
			}
			else{
			 foreach ($id_query as $key => $value) {
				 if($student_id == $value['student_id']){
				
					session_start();
					session_regenerate_id();
						$_SESSION['student_id'] = $value['student_id'];
						header('location:enter_amount.php');
						exit();
					session_destroy(); 
					

					
			}
			}
    	}
    }


    if(isset($_POST['register'])){
    	
		?><iframe src="student_register.php" width="100%" height="500">
			
		</iframe><?php

		
	}


    if(isset($_POST['log_out'])){
		header('location:home.php');
		session_destroy();
			session_regenerate_id();

	}

mysqli_close($connection);

    ?>
</body>
</html>