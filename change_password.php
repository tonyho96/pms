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

<?php require_once "painttrack/includes/db.php"; ?>
<section class="content-header">
<h1>
    Change Password
</h1>
</section>

<!-- Main content -->
<section class="content container-fluid">
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <?php  ?>
            <!-- form start -->
            <?php if(isset($_SESSION['successful_message'])){
                echo $_SESSION['successful_message'];
                unset($_SESSION['successful_message']);
            }
            else if(isset($_SESSION['fail_message'])){
                echo $_SESSION['fail_message'];
                unset($_SESSION['fail_message']);
            }
            ?>
            <form role="form" action="painttrack/includes/db.php" method="post">
                <input type="hidden" name="action-page" value="change_password">
                <div class="box-body">
                    <div class="form-group">
                        <label for="account_number">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password" required>
                    </div>
                    <div class="form-group">
                        <label for="account_number">New Password</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Confirm Password</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Enter Confirm Password" required>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btn_change_password">Submit</button>
                    <a type="button" class="btn btn-default" href="/painttrack.php" style="float: right">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </div>

</div>
<!-- /.row -->

</section>