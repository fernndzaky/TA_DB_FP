<?php 
session_start();

include("components/cashier_home_head.php");
include("database/config.php");
date_default_timezone_set("Asia/Jakarta"); 

# IF USER LOG IN 
if($_SESSION['loggedIn']){
$date = date('Y/m/d', time());
# GET ITS NAME AND ITS BRANCH ID TO PRINT BRANCH NAME
$query1 = mysqli_query($connection,"SELECT * FROM Employee WHERE employee_id = '{$_SESSION['employee_id']}' ");
$queryGetProduct = mysqli_query($connection,"SELECT * FROM Product");
if (mysqli_num_rows($query1) > 0) { 
    while ($row=mysqli_fetch_array($query1)) {
		$_SESSION['employee_name'] = $row['employee_name'];
		$_SESSION['branch_id'] = $row['branch_id'];

	}
}


# CREATE VARIABLE FOR BRANCH NAME
$query2 = mysqli_query($connection,"SELECT * FROM Branch WHERE branch_id = '{$_SESSION['branch_id']}' ");

if (mysqli_num_rows($query2) > 0) { 
    while ($row=mysqli_fetch_array($query2)) {
		$_SESSION['branch_name'] = $row['branch_name'];

	}
}

}

# FUNCTION FOR ADD ITEM
if (isset($_POST['addItem'])) {
	$productID = mysqli_real_escape_string($connection, $_POST['productID']);
    $productQty = mysqli_real_escape_string($connection, $_POST['productQty']);
    $queryAdd = "INSERT INTO Bill_Detail 
      (bill_id,item_id,qty) 
      VALUES 
      ({$_SESSION['bill_id']},$productID,$productQty) ";
    if(mysqli_query($connection, $queryAdd));{

	$query_bill_detail = mysqli_query($connection,"SELECT * FROM Product 
	  		WHERE product_id = $productID");
	  	if (mysqli_num_rows($query_bill_detail) > 0) { 
			while ($row=mysqli_fetch_array($query_bill_detail)) {

	      		$_SESSION['sub_total'] += ($row['product_price'] * $productQty);
	      		}
	      	}

		header("Location: cashier_home.php?open#added");

    }
}

# IF USER OPEN A BILL, CREATE NEW BILL
if(isset($_POST['open_bill']))
{
    $_SESSION['sub_total'] = 0;

	$query3 = "INSERT INTO Bill 
      (employee_id,branch_id,bill_date) 
      VALUES 
      ('{$_SESSION['employee_id']}','{$_SESSION['branch_id']}','$date') ";
    if(mysqli_query($connection, $query3));{
    	
		header("Location: cashier_home.php?open");

    }

    $query_bill_id = mysqli_query($connection,"SELECT * FROM Bill WHERE bill_id=(SELECT max(bill_id) FROM Bill);");

	if (mysqli_num_rows($query_bill_id) > 0) { 
	        while ($row=mysqli_fetch_array($query_bill_id)) {
	                $_SESSION['bill_id'] = $row['bill_id'];
	        }
	                

	        
	      }
	      
	}

# IF USER CLOSE BILL
if(isset($_POST['close_bill']))
{
	$tax_price = (($_SESSION['sub_total']* 15)/100);
	#$queryTax = "UPDATE Tax SET tax_price = $tax_price";
	$queryTax = "INSERT INTO Tax (tax_id , tax_price) VALUES ('{$_SESSION['bill_id']}',$tax_price)";
	if(mysqli_query($connection, $queryTax));{	
		header("Location: cashier_home.php?close");
	}
}

if(isset($_POST['verify_close']))
{		
	
		header("Location: cashier_home.php?cashier_home");

}

 ?>
<body style="background-color: #F4E76E;font-family: Helvetica Bold;color: grey;">


<!-- INCLUDE HEADER NAVBAR -->
<?php 
include("components/navbar_cashier.php");
?>
<?php if(isset($_GET["cashier_home"])) { ?>


	<div class="row" style="margin-top: 150px">
		<div class="col-md-12" style="text-align: center">
			<h2 style="color: black"><?php echo $_SESSION['employee_name'] ?></h2>
		
		</div>
		<div class="col-md-12" style="text-align: center">
			<form action="" method="post" role="form">
					<button type="submit" name="open_bill" class="btn-grad" style="border:0px ;width: 400px ;height: 150px; border-radius: 5px;color: white;font-size: 30px">OPEN BILL</button>
			</form>
				
		
		</div>
	</div>
<?php } ?>
<!-- IF OPEN BILL -->
<?php if(isset($_GET["open"])) { ?>
		
	
	<div style="margin-top: 100px;padding: 0px 300px">
		<div class="row" style="color: black">
			<div class="col-md-9">
				<p style="font-size: 20px">Bill ID : <?php echo $_SESSION['bill_id'] ?>,<?php echo $_SESSION['branch_name'] ?>, <?php echo $date ?></p>
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
			      <th scope="col">Action</th>

			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$query_bill_detail = mysqli_query($connection,"SELECT * FROM Bill_Detail , Product 
			  		WHERE Bill_Detail.bill_id = {$_SESSION['bill_id']} AND Product.product_id = Bill_Detail.item_id");
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
			      	<?php echo $row['qty'];; ?>
			      		
			      	</td>
			      <td>
			      	<?php echo $row['product_price'];
			      		 ?>
			      	</td>

			      <td style="width: 100px">
					<form action="" method="post">
				      	<button name="deleteItem"type="button" class="btn-delete" style="border: 0px;border-radius: 5px;width: 100px;height: 40px;color: white" onclick="window.location.href='action/delete_bill_detail.php?edit=<?php echo $row["bill_detail_id"] ?>'">
                Delete</button>
					</form>

			      </td>
			    </tr>
			  <?php 
			  $num += 1;
	        		}
	            } 

 ?>
			    
				




			  </tbody>
			</table>
		</div>
	</div>

	<div style="padding: 0px 300px">
		<div class="row" style="color: black">
			<div class="col-md-3">
				<form action="" method="post">
					<button name="close_bill" class="btn-closeBill" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Close Bill</button>
				</form>
				
					
				
			</div>
			<div class="col-md-3">
				<a href="cashier_home.php?open#popup1">
					<button name="deleteItem" class="btn-addItem" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Add Item</button>
				</a>
					
				
			</div>
			<div class="col-md-3" style="text-align: right">
				<p style="font-size: 25px">SUB TOTAL :</p>

			</div>

			<div class="col-md-3">

				<p style="font-size: 25px">Rp. <?php echo  $_SESSION['sub_total']?></p>

			</div>

		</div>
	</div>

<?php } ?>

	<div id="popup1" class="overlay">
	<div class="popup">
		<h2>ADD ITEM</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<form action=""  method="post"  role="form">
			  <select name="productID" style="font-size: 14px" class="form-control" id="exampleFormControlSelect1">
					<?php  
			  	if (mysqli_num_rows($queryGetProduct) > 0) { 
    				while ($row=mysqli_fetch_array($queryGetProduct)) {

			  	?>
			      <option value="<?php echo $row['product_id'] ?>"><?php  echo $row["product_name"]  ?></option>
			  <?php }} ?>
				</select>

			  <div class="form-group" style="margin-top: 10px">
			    <input type="text" class="form-control" name="productQty" id="exampleInputPassword1" placeholder="Qty">
			  </div>
			  
			  <button type="submit" name="addItem" class="btn btn-primary" style="width: 100%">Add Item</button>
			</form>
		</div>
	</div>
</div>

<!-- END OF OPEN BILL -->

<!-- IF USER CLOSE BILL -->
<?php if(isset($_GET["close"])) { ?>
	<div style="margin-top: 100px;padding: 0px 300px">
		<div class="row" style="color: black">
			<div class="col-md-9">
				<p style="font-size: 20px">Bill ID : <?php echo $_SESSION['bill_id'] ?>,<?php echo $_SESSION['branch_name'] ?>, <?php echo $date ?></p>
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
			  		WHERE Bill_Detail.bill_id = {$_SESSION['bill_id']} AND Product.product_id = Bill_Detail.item_id");
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
			      	<?php echo $row['qty'];; ?>
			      		
			      	</td>
			      <td>
			      	<?php echo $row['product_price'];
			      		 ?>
			      	</td>

			    </tr>
			  <?php 
			  $num += 1;
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
				<p style="font-size: 25px">Rp. <?php echo $_SESSION['sub_total'] ?></p>
		</div>
	</div>
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>

		<div class="col-md-3" >
				<p style="font-size: 25px">TAX ( 15 % ) :</p>
		</div>
		<?php 
		$queryGetTax = mysqli_query($connection,"SELECT * FROM Tax WHERE tax_id = {$_SESSION['bill_id']} ");

		if (mysqli_num_rows($queryGetTax) > 0) { 
		    while ($row=mysqli_fetch_array($queryGetTax)) {

		    	$_SESSION['tax_price'] = $row['tax_price'];
		    }}
		?>
		<div class="col-md-3">
				<p style="font-size: 25px">Rp. <?php echo 	$_SESSION['tax_price'] ?></p>
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
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3">
			<a href="cashier_home.php?open">
				<button class="btn-delete" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Cancel</button>
			</a>
					


			</div>

			<div class="col-md-3">
				<form action="" method="post">
					<button name="verify_close" class="btn-closeBill" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Confirm Bill</button>

				</form>
			
					
			</div>
	</div>
<?php } ?>
<!-- END OF CLOSE BILL -->
</body>
</html>