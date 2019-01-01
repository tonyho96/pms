<?php 
require_once '../includes/vendor/autoload.php';
require_once '../includes/config.php';
require_once '../models/Project.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection( [
	'driver'    => DBDRIVER,
	'host'      => DBHOST,
	'database'  => DBNAME,
	'username'  => DBUSER,
	'password'  => DBPASSWORD,
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
] );

$capsule->setAsGlobal();

$capsule->bootEloquent();

$startdate = ($_POST['start-date'] != '' ? $_POST['start-date'] : '');
$enddate=($_POST['end-date'] != '' ? $_POST['end-date'] : '');
$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();


$projects=Project::where('P-Date','>=',$startdate)->where('P-Date','<=',$enddate)->where('USER_ID', $User[0]->getAttribute('id'))->get();

?>

<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Data Export</title>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../../assets/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- jQuery 3 -->
  <script src="../../assets/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../assets/dist/js/adminlte.min.js"></script>

</head>

<body>
  <h1></h1>
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>P-ID</th>
          <th>P-Name</th>
          <th>P-Description</th>
          <th>P-Type</th>
          <th>P-Date</th>
          <th>P-NumUnits</th>
          <th>P-Comments</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($projects as $project) {  ?>
        <tr>
          <td>
            <?php echo $project->{'P-ID'} ?>
          </td>
          <td>
            <?php echo $project->{'P-Name'} ?>
          </td>
          <td>
            <?php echo $project->{'P-Description'} ?>
          </td>
          <td>
            <?php echo $project->{'P-Type'} ?>
          </td>
          <td>
            <?php echo $project->{'P-Date'} ?>
          </td>
          <td>
            <?php echo $project->{'P-NumUnits'} ?>
          </td>
          <td>
            <?php echo $project->{'P-Comments'} ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <script>
      jQuery(document).ready(function () {
        window.print();
      });
    </script>
</body>

</html>