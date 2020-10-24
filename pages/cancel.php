<?php
session_start();
$location=$_SESSION['location'];
	include('../dist/includes/dbcon.php');
	$result=mysqli_query($con,"DELETE FROM temp_trans where location_id='$location'")	or die(mysqli_error());
	 echo "<script>document.location='home.php'</script>";  
?>