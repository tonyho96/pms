<?php require_once "painttrack/includes/db.php"; ?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">





        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">PAINT TRACK</li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Project</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/painttrack.php?page=project-list">All Projects</a></li>
                    <li><a href="/painttrack.php?page=project-add">Add Project</a></li>
                </ul>
            </li>
            <li><a href="/painttrack.php?page=total-costs-summary"><i class="fa fa-link"></i> <span>Total Costs Summary</span></a></li>

            <li class="header">LABEL</li>
            <li><a href="/labelprinting.php"><i class="fa fa-link"></i> <span>Label Print</span></a></li>
            <!--<li><a href="/painttrack.php?page=setting"><i class="fa fa-link"></i> <span>Setting</span></a></li>-->
            <li><a href="/painttrack.php?page=template-list"><i class="fa fa-link"></i> <span>Templates</span></a></li>
			<?php 
				$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
				if ($User[0]->getAttribute('role')== '1'){
			?>
			<li class="header">Users</li>
			<li><a href="/user.php"><i class="fa fa-link"></i> <span>Users</span></a></li>
			
			<li class="header">Homepage Setting</li>
			<li><a href="/homepage_setting.php"><i class="fa fa-link"></i> <span>Homepage Setting</span></a></li>
            <?php } ?>
            <li><a href="/change_password.php"><i class="fa fa-key"></i> <span>Change Password</span></a></li>
			

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">