<?php 
session_start();
$location=$_SESSION['location'];
include('../dist/includes/dbcon.php');

	$name = $_POST['prod_name'];
	$price = $_POST['prod_price'];
	$desc = $_POST['prod_desc'];
	$supplier = $_POST['supplier'];
	$reorder = $_POST['reorder'];
	$category = $_POST['category'];
	$serial = $_POST['serial'];
	
	$query2=mysqli_query($con,"select * from product where prod_name='$name' and location_id='$location'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Cloth already exist!');</script>";
			echo "<script>document.location='product.php'</script>";  
		}
		else
		{	

			$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
				$pic="default.png";
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/uploads/".$pic);
				      }
					}
			}	

			mysqli_query($con,"INSERT INTO product(prod_name,prod_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,location_id,serial)
			VALUES('$name','$price','$desc','$pic','$category','$reorder','$supplier','$location','$serial')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully Added New Cloth!');</script>";
					  echo "<script>document.location='product.php'</script>";  
		}
?>