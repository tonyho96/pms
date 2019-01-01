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
	if (isset($_POST["btn_delete"]))
	{
		$temp = $_POST["btn_delete"];

		$projects = Project::where('USER_ID',$temp)->get();
		foreach ($projects as $project){
            $units = Unit::where('U-P-ID',$project->getAttribute('P-ID'))->get();
            foreach ($units as $unit){
                $rooms = Room::where('R-U-ID',$unit->getAttribute('U-ID'))->get();
                foreach ($rooms as $room){
                    $items = Item::where('I-R-ID',$room->getAttribute('R-ID'))->get();
                    foreach ($items as $item){
                        Item::where('I-ID', $item->getAttribute('I-ID'))->delete();
                        Paint_infos::where('PI-ID', $item->getAttribute('I-PI-ID'))->delete();
                    }
                    Room::where('R-ID', $room->getAttribute('R-ID'))->delete();
                }
                Unit::where('U-ID', $unit->getAttribute('U-ID'))->delete();
            }
            Project::where('P-ID', $project->getAttribute('P-ID'))->delete();
        }

		$sql="delete from users where id= '$temp'";
		mysqli_query($db,$sql);
	}
	
	if (isset($_POST["btn_add"]))
	{
		$name=$_POST["txtname"];
		$email=$_POST["txtemail"];
		$temp=$_POST["txtpassword"];
		$password=md5($temp);
		$sql="insert into users (name,email,password) values('$name','$email','$password')";
		mysqli_query($db,$sql);
		echo "Add New Success!";
	}	
	
	if (isset($_POST["btn_update"]))
	{
		$id = $_POST["btn_update"];
		$name=$_POST["txtname"];
		$email=$_POST["txtemail"];
		$temp=$_POST["txtpassword"];
		$password=md5($temp);		
		$sql="update users set name='$name',email='$email', password='$password' where id='$id'";
		mysqli_query($db,$sql);
		echo "Update Success!";
    }	

 ?> 

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
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
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">

                        <a href="add_user.php" class="btn btn-success btn-sm" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
					
					<form method="post" action="">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$query="select * from users where role='0'";
									if ($result = mysqli_query($db, $query))
									{
										while ($data = mysqli_fetch_array($result)){
											$id=$data["id"];
											?><tr>
											<td><?php echo $data["id"];?></td>
											<td><?php echo $data["name"];?></td>
											<td><?php echo $data["email"];?></td>
                                            <td>
                                                <a href="<?php echo "/painttrack.php?page=project-list&user-id=$id";?>" class="btn btn-success btn-sm" title="View Projects">View Projects</a>
                                                <a href="<?php echo "edit_user.php?id=$id";?>" class="btn btn-primary btn-sm" title="Edit User">Edit</a>
                                                <button class="btn btn-danger btn-sm" name="btn_delete" value="<?php echo $id; ?>" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>
                                            </td>
											</tr>
									<?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
					</form>
                </div>
            </div>
        </div>	    
</section>
<!-- /.content -->

<?php require "painttrack/views/footer.php" ?>
