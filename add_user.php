<?php session_start(); 
	if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }

  include ("painttrack/includes/config.php");
  // connect to the database
  $db = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
?>
<?php require "painttrack/views/header.php"; ?>

<!-- Left side column. contains the logo and sidebar -->

<?php require "painttrack/views/sidemenu.php"; ?>

<?php require "painttrack/includes/db.php"; ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add New User
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
		<div class="col-md-12">
			<a href="user.php" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
			<br /><br />
	
			<form method="post" action="user.php">
			  <div class="form-group">
				<input type="text" class="form-control" placeholder="Name" name="txtname" required><br>
				<input type="email" class="form-control" placeholder="Email" name="txtemail" required><br>
				<input type="password" class="form-control" placeholder="Password" name="txtpassword" required><br>
			  </div>
			  <div class="row">
				<div class="col-xs-4">
				  <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_add">Add</button>
				</div>
			  </div>	  	  
			</form>
		</div>  
</section>
<!-- /.content -->

<?php require "painttrack/views/footer.php" ?>
