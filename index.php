<?php  
session_start();


include("database/config.php");
date_default_timezone_set("Asia/Jakarta"); 

if(isset($_POST['submit2'])){
  if( empty($_POST['email']) ){
     header("location: index.php?failed");
  }
  else{
    $email = mysqli_real_escape_string($connection, $_POST['email']);
      $query = mysqli_query($connection,"SELECT * FROM Employee 
      WHERE employee_id = $email ");
    //$query = "SELECT * FROM customer_data WHERE email = '$email' AND password ='$password' ";
      if (mysqli_num_rows($query) > 0) { 
        while ($row=mysqli_fetch_array($query)) {

                  //set the session on the login page
                  $_SESSION['employee_id'] = $email;
                  $_SESSION['loggedIn'] = true;

                  header("Location: cashier_home.php?cashier_home");
           

        }
      }
      else{
           header("location:index.php?failed");
      }

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



</head>
<body style="background-color: #F4E76E;font-family: Helvetica Bold;color: grey">
	
	<div class="row" style="margin-top: 200px;padding: 0px 500px">
		<div class="col-md-12">
			<h1 style="font-size: 60px;text-align: center !important">Sign In</h1>

			<form style="margin-top: 50px" action=""  method="post"  role="form" >
				<?php if(isset($_GET["failed"])) { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    Employee ID is wrong or not found. Please contact Administrator immediately.
                                </div>
                            <?php } ?>
			<div class="form-group">
				<input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Employee ID">
			</div>
			<div style="text-align: center">
				<button type="submit" name="submit2" class="btn btn-primary" style="width: 100%">Log In</button>
			</div>
		</form>
		</div>

	</div>
</body>
</html>