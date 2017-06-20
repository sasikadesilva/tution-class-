<?php
session_start();
		
if(!$_SESSION['user_name']){
	header('location:home.php');
	exit();
	}
if($_SESSION['id']!= session_id()){
	header('location:home.php');
	exit();
}
require_once('database.php');

	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form method="POST">
	<input type="submit" name="log_out">
</form>

<href a>aaa</href>
<?php
	if(isset($_POST['log_out'])){
		header('location:home.php');
		session_destroy();

	}
?>
</body>
</html>