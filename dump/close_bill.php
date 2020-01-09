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
				<a class="navbar-brand" href="cashier_home.php" style="color: black !important;font-size: 30px">CASHIER</a>
				<a class="navbar-brand" href="history.php" style="color: black !important;font-size: 30px; padding-left: 50px">HISTORY</a>
				<a class="navbar-brand" href="staff.php" style="color: black !important;font-size: 30px; padding-left: 50px">STAFF</a>
				
			</nav>
		</div>
		<div class="col-md-3">
			<div style="padding: 0px 20px 0px 0px">
				<ul class="navbar-nav"  style="text-align:  right !important">
			        <li class="nav-item dropdown" >
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="rounded-circle">
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"  style="text-align:  right !important">

			          <a class="dropdown-item" href="index.php">Log Out</a>
			        </div>
			      </li>   
			    </ul>

			</div>	
		</div>

	</div>
	<div style="padding: 0px 300px; margin-top: 100px">
		<div class="row" style="color: black">
			<div class="col-md-10">
				<p style="font-size: 20px">Bill ID : u27sibdi , FX SUDIRMAN , 32 October 2020</p>
			</div>
				<div class="col-md-2" style="text-align: right !important">
				<p style="font-size: 20px">Fernandha Dzaky</p>
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
			    <tr>
			      <th scope="row" style="width: 100px">1</th>
			      <td>u17826bus</td>
			      <td>Chitato</td>
			      <td>2</td>
			      <td>10,000</td>

			    </tr>
			    <tr>
			      <th scope="row" style="width: 100px">1</th>
			      <td>u17826bus</td>
			      <td>Chitato</td>
			      <td>2</td>
			      <td>10,000</td>

			    </tr>
			    <tr>
			      <th scope="row" style="width: 100px">1</th>
			      <td>u17826bus</td>
			      <td>Chitato</td>
			      <td>2</td>
			      <td>10,000</td>

			    </tr>
			    <tr>
			      <th scope="row" style="width: 100px">1</th>
			      <td>u17826bus</td>
			      <td>Chitato</td>
			      <td>2</td>
			      <td>10,000</td>

			    </tr>





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
				<p style="font-size: 25px">Rp. 150.000</p>
		</div>
	</div>
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3" >
				<p style="font-size: 25px">TAX ( 10 % ) :</p>
		</div>

		<div class="col-md-3">
				<p style="font-size: 25px">Rp. 15.000</p>
		</div>
	</div>
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3" >
				<p style="font-size: 25px">TOTAL PRICE :</p>
		</div>

		<div class="col-md-3">
				<p style="font-size: 25px">Rp. 165.000</p>
		</div>
	</div>
		<div class="row" style="padding: 0px 300px;color: black;text-align: right;" >
		<div class="col-md-6">
			
		</div>
		<div class="col-md-3">
			<form action="open_bill.php">
				<button class="btn-delete" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Cancel</button>	
			</form>

			</div>
			<div class="col-md-3">
				<form action="cashier_home.php">
					<button class="btn-closeBill" style="border: 0px;border-radius: 5px;width: 100%;height: 70px;color: white"> Confirm Bill</button>
				</form>
				
			</div>
	</div>





</body>
</html>