<?php 
session_start();
include("database/config.php");
$_SESSION['sub_total'] = 0;

if (isset($_GET["billID"])) {
	$billID = $_GET["billID"];
	$query1 = mysqli_query($connection,"SELECT * FROM Bill,Branch, Employee WHERE Bill.bill_id = $billID AND Branch.branch_id = Bill.branch_id AND Employee.employee_id = Bill.employee_id");

	if (mysqli_num_rows($query1) > 0) { 
	    while ($row=mysqli_fetch_array($query1)) {
	    	$_SESSION['branch_name'] = $row['branch_name'];
	    	$_SESSION['bill_date'] = $row['bill_date'];
	    	$_SESSION['employee_name'] = $row['employee_name'];
	    }
	}


}
$query = mysqli_query($connection,"SELECT * FROM Bill,Bill_Detail, Branch, Product
									WHERE Bill_Detail.bill_id = $billID ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FOOD HALL</title>

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" href="main.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<style>
		.bg-custom-1 {
		  background-color: #85144b;
		}

		.bg-custom-2 {
		background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
		}
		.btn-grad {
		background-color: #47525E;

		}
		.btn-grad:hover{
		background-color: black
		}

		.btn-delete {
		background-color: #F95F62;

		}
		.btn-delete:hover{
		background-color: #FA3C40
		}
		.btn-closeBill {
		background-color: #53C3FF;

		}
		.btn-closeBill:hover{
		background-color: #00A6FF
		}
		.btn-addItem {
		background-color: #47525E;

		}
		.btn-addItem:hover{
		background-color: black
		}

	</style>
</head>
<body style="background-color: #F4E76E;font-family: Helvetica Bold;color: grey">
	<div class="row" style="padding: 20px">
		<div class="col-md-9">
			
			<nav class="navbar navbar-expand-lg ">
				<a class="navbar-brand" href="cashier_home.php?cashier_home" style="color: black !important;font-size: 30px">CASHIER</a>
				<a class="navbar-brand" href="history.php" style="color: black !important;font-size: 30px; padding-left: 50px;text-decoration: underline;">HISTORY</a>
				<a class="navbar-brand" href="staff.php" style="color: black !important;font-size: 30px; padding-left: 50px">STAFF</a>
				<a class="navbar-brand" href="product.php" style="color: black !important;font-size: 30px; padding-left: 50px">PRODUCTS</a>
			</nav>
		</div>
		<div class="col-md-3">
			<div style="padding: 0px 20px 0px 0px">
				<ul class="navbar-nav" style="float: right">
			        <li class="nav-item dropdown" >
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="rounded-circle">
			        </a>
			        <div class="dropdown-menu" style="margin-right: 50px !important" aria-labelledby="navbarDropdownMenuLink" >

			          <a class="dropdown-item" href="index.php">Log Out</a>
			        </div>
			      </li>   
			    </ul>

			</div>	
		</div>

	</div>
	
	<div style="margin-top: 50px;padding: 0px 300px">
		<div class="row" style="color: black">
			<div class="col-md-9">
				<p style="font-size: 20px">Bill ID : <?php echo $billID ?>,<?php echo $_SESSION['branch_name'] ?>,<?php echo$_SESSION['bill_date'] ?></p>
			</div>
				<div class="col-md-3" style="text-align: right !important">
				<p style="font-size: 20px"><?php echo $_SESSION['employee_name'] ?></p>
				</div>
			

		</div>
	</div>
			
	

	<div class="row" style="padding: 0px 300px">
	
		<div class="col-md-12">
			<table class="table table-striped table-dark" style="text-align: center">
			  <thead>
			    <tr>
			      <th scope="col">No.</th>
			      <th scope="col">Product ID</th>
			      <th scope="col">Product Name</th>
			      <th scope="col">Qty</th>
			      <th scope="col">Price</th>

			    </tr>
			  </thead>
			  <tbody>
				<?php 
			  	$query_bill_detail = mysqli_query($connection,"SELECT * FROM Bill_Detail , Product 
			  		WHERE Bill_Detail.bill_id = $billID AND Product.product_id = Bill_Detail.item_id");
			  	$num = 1;
			  	if (mysqli_num_rows($query_bill_detail) > 0) { 
    				while ($row=mysqli_fetch_array($query_bill_detail)) {
    				

	            ?>
			    <tr>
			      <th scope="row" style="width: 100px"><?php echo $num ?></th>
			      <td>
			      	<?php 



			      	echo $row['item_id']; ?>
			      		
			      	</td>
			      <td>
					<?php 
			      	echo $row['product_name']; ?>
			      </td>
			      <td>
			      	<?php echo $row['qty']; ?>
			      		
			      	</td>
			      <td>
			      	<?php echo $row['product_price'];
			      		 ?>
			      	</td>

			    </tr>
			  <?php 
			  $num += 1;
			  $_SESSION['sub_total'] += ($row['qty'] * $row['product_price']);
	        		}
	            } 



 ?>
			    
				

			  </tbody>
			</table>
		</div>
	</div>
	<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3" >
				<p style="font-size: 25px">SUB TOTAL :</p>
		</div>

		<div class="col-md-3" >
				<p style="font-size: 25px">Rp. <?php echo  $_SESSION['sub_total'] ?> </p>
		</div>
	</div>
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>

		<div class="col-md-3" >
				<p style="font-size: 25px">TAX ( 15 % ) :</p>
		</div>

		<?php 
		$queryGetTax = mysqli_query($connection,"SELECT * FROM Tax WHERE tax_id = $billID ");

		if (mysqli_num_rows($queryGetTax) > 0) { 
		    while ($row=mysqli_fetch_array($queryGetTax)) {

		    	$_SESSION['tax_price'] = $row['tax_price'];
		    }}
		?>
		<div class="col-md-3">
				<p style="font-size: 		 25px">Rp. <?php echo 	$_SESSION['tax_price'] ?></p>
		</div>
		
	</div>
	<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3" >
				<p style="font-size: 25px">TOTAL PRICE :</p>
		</div>
		<div class="col-md-3">
				<p style="font-size: 25px">Rp. <?php echo $_SESSION['tax_price'] + $_SESSION['sub_total']?></p>
		</div>
	</div>





</body>
</html>