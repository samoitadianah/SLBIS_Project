<?php 
session_start();
$id=$_SESSION['id'];
$location=$_SESSION['location'];	

include('../dist/includes/dbcon.php');

	$cid = $_POST['cid'];
	$name = $_POST['prod_name'];
	$qty = $_POST['qty'];
		
			
		$query=mysqli_query($con,"select prod_price,prod_id from product where prod_id='$name'")or die(mysqli_error());
		$row=mysqli_fetch_array($query);
		$price=$row['prod_price'];
		
		$query1=mysqli_query($con,"select * from temp_trans where location_id='$location'")or die(mysqli_error());
		$count=mysqli_num_rows($query1);
		
		$total=$price*$qty;
		
		if ($count>0){
			mysqli_query($con,"update temp_trans set qty='$qty',price='$total' where location_id='$location'")or die(mysqli_error());
	
		}
		else{
			mysqli_query($con,"INSERT INTO temp_trans(prod_id,qty,price,location_id) VALUES('$name','$qty','$price','$location')")or die(mysqli_error($con));
		}

	
		echo "<script>document.location='transaction.php?cid=$cid'</script>";  
	
?>