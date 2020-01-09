<?php 
session_start();
include("database/config.php");
$query = mysqli_query($connection,"SELECT * FROM Bill,Employee WHERE Employee.employee_id = Bill.employee_id");
if (isset($_POST['search'])) {
	$query_search = mysqli_query($connection,"SELECT * FROM Bill WHERE bill_id = {$_POST['searchID']}");
	if (mysqli_num_rows($query_search) > 0) { 
    	while ($row=mysqli_fetch_array($query_search)) {
		header("Location:history_detail.php?billID={$_POST['searchID']}");
	 	}
	}
	else{
		header("Location:history.php?notFound");

	}
}
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
<body style="background-color: #F4E76E;font-family: Helvetica Bold, Cambria;color: grey">
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
	
	<div class="row" style="padding: 0px 300px;margin-top: 100px">
		<div class="col-md-12" style="padding-left: 0px !important;">
			<nav class="navbar" style="padding-left: 0px !important">
			  <form class="form-inline" method="post" action="">
			    <input class="form-control mr-sm-2" type="search" name="searchID" placeholder="Search By ID" aria-label="Search">
			    <button name="search" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			  </form>
			</nav>
		</div>
	</div>
	<div class="row" style="padding: 0px 300px">
		<div class="col-md-12" style="padding: 0px !important">
			<?php if(isset($_GET["notFound"])) { ?>
                                <div class="alert alert-danger alert-dismissable" style="margin: 0px !important"> 
                                    <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    Data Not Found ! Please try with another ID
                                </div>
                            <?php } ?>
			<?php  
			  	if (mysqli_num_rows($query) > 0) { 
    				while ($row=mysqli_fetch_array($query)) {

			  	?>
		</div>
	</div>
	<div class="row" style="padding: 0px 300px">
		
		<div class="col-md-12 btn-addItem " style="border-radius: 5px;text-align: center;text-decoration: none;padding: 10px 20px;margin-top: 20px">

			<button name="deleteItem"type="button" class="btn-addItem" style="border: 0px;border-radius: 5px;width: 100%;height: 50px;color: white" onclick="window.location.href='history_detail.php?billID=<?php echo $row["bill_id"] ?>'">
               Bill ID :  <?php echo $row['bill_id'] ?> | CREATED ON : <?php echo $row['bill_date'] ?> BY : <?php echo $row['employee_name'] ?></button>
		</div>

		<?php 
		}
	} ?>
	</div>






</body>
</html>