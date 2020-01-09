<?php 


include("database/config.php");
$query = mysqli_query($connection,"SELECT * FROM Employee,Branch WHERE Employee.branch_id = Branch.branch_id ");
$query2 = mysqli_query($connection,"SELECT * FROM Branch");


# FUNCTION FOR ADD STAFF
if (isset($_POST['addStaff'])) {
	$staffName = mysqli_real_escape_string($connection, $_POST['staff_name']);
	$staffBranch = mysqli_real_escape_string($connection, $_POST['branch_name']);

    $queryAdd = "INSERT INTO Employee 
      (employee_name , branch_id) 
      VALUES 
      ('$staffName' , '$staffBranch' ) ";
    	if(mysqli_query($connection, $queryAdd));{

		header("Location: staff.php#");

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
				.overlay {
		  position: fixed;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  background: rgba(0, 0, 0, 0.7);
		  transition: opacity 500ms;
		  visibility: hidden;
		  opacity: 0;
		}
		.overlay:target {
		  visibility: visible;
		  opacity: 1;
		}

		.popup {
		  margin: 250px auto;
		  padding: 20px;
		  background: #fff;
		  border-radius: 5px;
		  width: 30%;
		  height: 400px;
		  position: relative;
		  transition: all 5s ease-in-out;
		  color :black;
		}



	</style>
</head>
<body style="background-color: #F4E76E;font-family: Helvetica Bold;color: grey">
	<div class="row" style="padding: 20px">
		<div class="col-md-9">
			
			<nav class="navbar navbar-expand-lg ">
				<a class="navbar-brand" href="cashier_home.php?cashier_home" style="color: black !important;font-size: 30px">CASHIER</a>
				<a class="navbar-brand" href="history.php" style="color: black !important;font-size: 30px; padding-left: 50px">HISTORY</a>
				<a class="navbar-brand" href="staff.php" style="color: black !important;font-size: 30px; padding-left: 50px;text-decoration: underline;">STAFF</a>
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
	<div style="padding: 0px 300px; margin-top: 100px">
		<div class="row" style="color: black">
			<div class="col-md-9">
				<h2>STAFF DETAIL</h2>
			</div>
			<div class="col-md-3" style="text-align: right">
				<a href="#popup1">
					<button class="btn btn-primary">
						ADD STAFF
					</button>
				</a>
			</div>

		</div>
	</div>
	
		
	<div class="row" style="padding: 0px 300px">
		
		<div class="col-md-12">
			<table class="table table-striped table-dark" style="text-align: center">
			  <thead>
			    <tr>
			      <th scope="col">No.</th>
			      <th scope="col">Staff ID</th>
			      <th scope="col">Staff Name</th>
			      <th scope="col">Work Branch</th>
			      <th scope="col">Action</th>

			    </tr>
			  </thead>
			  <tbody>
			  	<?php  
			  	$num = 1;
			  	if (mysqli_num_rows($query) > 0) { 
    				while ($row=mysqli_fetch_array($query)) {

			  	?>
			    <tr>
			      <th scope="row" style="width: 100px"><?php echo $num ?></th>
			      <td><?php echo $row['employee_id'] ?></td>
			      <td><?php echo $row['employee_name'] ?></td>
			      <td><?php echo $row['branch_name'] ?></td>
			      <td style="width: 100px">
					<form action="" method="post">
				      	<button name="deleteItem"type="button" class="btn-delete" style="border: 0px;border-radius: 5px;width: 100px;height: 40px;color: white" onclick="window.location.href='action/delete_staff.php?edit=<?php echo $row["employee_id"] ?>'">
                Delete</button>
					</form>

			      </td>

			    </tr>


				<?php 			  $num += 1;
}} ?>



				
			  </tbody>
			</table>
			<div id="popup1" class="overlay">
			<div class="popup">
				<a class="close" href="#">&times;</a>
				<div class="content" >
					<form action=""  method="post"  role="form">
						
			
		         	<div class="form-group">
			    		<input type="text" class="form-control" name="staff_name" id="" aria-describedby="" placeholder="Staff Name">
			  		</div>

			  		<label for="">Branch</label>
					<div class="form-group">
						<select name="branch_name" class="form-control" id="exampleFormControlSelect1">
							<?php  
					  	if (mysqli_num_rows($query2) > 0) { 
							while ($row=mysqli_fetch_array($query2)) {

					  	?>
					      <option value="<?php echo $row['branch_id'] ?>" ><?php echo $row['branch_name'] ?></option>
					      <?php
					}} ?>
					    </select>
					</div>
					
					<div class="form-group" >
							<button type="submit" name="addStaff" class="btn btn-primary" style="border-radius: 8px;font-size: 20px;width: 100%;padding: 10px 0px">ADD</button>

					</div>

					</form>
				</div>
			</div>
		</div>
		</div>
	</div>



</body>
</html>