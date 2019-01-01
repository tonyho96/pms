<?php
session_start();
if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: index.php");
  }
require_once './painttrack/includes/db.php';
?>
<?php require "painttrack/views/header.php" ?>

  <!-- Left side column. contains the logo and sidebar -->

    <?php require "painttrack/views/sidemenu.php" ?>

  <!-- Content Wrapper. Contains page content -->

    <?php $page = isset($_GET['page']) ? $_GET['page']:'project-list';
    switch ($page){

        case 'home':
            require "painttrack/views/home.php";
            break;


        case 'project-list':
            require "painttrack/views/project/projects.php";
            break;
        case 'project-edit':
            require "painttrack/views/project/project-edit.php";
            break;
        case 'project-add':
            require "painttrack/views/project/project-add.php";
            break;


        case 'project-unit-list':
            require "painttrack/views/unit/units.php";
            break;
        case 'project-unit-edit':
            require "painttrack/views/unit/unit-edit.php";
            break;
        case 'project-unit-add':
            require "painttrack/views/unit/unit-add.php";
            break;


        case 'project-unit-room-list':
            require "painttrack/views/room/rooms.php";
            break;
        case 'project-unit-room-edit':
            require "painttrack/views/room/room-edit.php";
            break;
        case 'project-unit-room-add':
            require "painttrack/views/room/room-add.php";
            break;



        case 'project-unit-room-item-list':
            require "painttrack/views/item/items.php";
            break;
        case 'project-unit-room-item-edit':
            require "painttrack/views/item/item-edit.php";
            break;
        case 'project-unit-room-item-view':
            require "painttrack/views/item/item-view.php";
            break;
        case 'project-unit-room-item-add':
            require "painttrack/views/item/item-add.php";
            break;


        case 'total-costs-summary':
            require "painttrack/views/total-costs-summary.php";
            break;
        case 'export-print':
            require "painttrack/views/export-print.php";
            break;
        case 'setting':
            require "painttrack/views/setting.php";
            break;

        case 'template-list':
            require "painttrack/views/template/template-list.php";
            break;
        case 'template-edit':
            require "painttrack/views/template/template-edit.php";
            break;

//        default:
//            require "painttrack/views/home.php";
//            break;

    }

    ?>

  <!-- /.content-wrapper -->

<?php require "painttrack/views/footer.php" ?>
