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

<?php 


	if(isset($_POST["submit"])){
		$paragraph1 = $_POST["paragraph1"];
		$paragraph2 = $_POST["paragraph2"];
		HomeSettings::where('id',1)->update(['paragraph_1' => $paragraph1,
											'paragraph_2' => $paragraph2
											]);

		
	}


	
	
$HomeSettings = HomeSettings::where('id',1)
							->take(1)
							->get();

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Homepage Setting
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Homepage Setting</li>
    </ol>
	
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
		<?php 
			$User = Users::where('email', $_SESSION["email"])->take(1)->get();
			if ($User[0]->getAttribute('role')== '1'){
		?>
		<form method="post" action="">
			<label>First Paragraph</label>
			<br>
			<textarea rows="4" cols="100" name="paragraph1"><?php echo $HomeSettings[0]->getAttribute('paragraph_1');?></textarea>
			<br>
			<label>Second Paragraph</label>
			<br>
			<textarea rows="4" cols="100" name="paragraph2"><?php echo $HomeSettings[0]->getAttribute('paragraph_2');?></textarea>
			<br>
			<input type="submit" class="btn btn-primary" name="submit" value="submit">
		</form>
			<?php } 
			else 
				echo "<h1>Only admin can modify this.</h1>"
			?>
	   
	
</section>
<!-- /.content -->

<?php require "painttrack/views/footer.php" ?>