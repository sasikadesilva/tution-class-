<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

	function critical_data(){
		$critical_data = "INSERT INTO critical(student_id,month,subject_name,class,amount)VALUES('$student_id','$month','$subject_name','$class_now','$amount')";

		$critical_query = mysqli_query($connection,$critical_data);
						if($query==false){
							die(mysqli_error($connection));
						}
						else{
								}
	}

?>
</body>
</html>