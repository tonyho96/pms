<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Project
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Project</li>
        <li class="active">Edit Project</li>
    </ol>
</section>

<?php
    $project = Project::find($_GET['project_id']);
    $project_date = new DateTime($project['P-Date']);
    $project_date = $project_date->format('Y-m-d');
?>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="/painttrack/includes/db.php" method="post" id="project-edit">
        <input type="hidden" name="action-page" value="project-edit">
        <input type="hidden" name="project_id" value="<?php echo $_GET['project_id'] ?>">
        <div class="form-group">
            <label class="control-label col-sm-2" for="project-name">Project Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="project-name" name="project-name" placeholder="Project Name" value="<?php echo $project['P-Name'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="description" name="description" placeholder="Description"><?php echo $project['P-Description'] ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Type:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="<?php echo $project['P-Type'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date">Date:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $project_date ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="comments" name="comments" placeholder="Comment" value="<?php echo $project['P-Comments'] ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</section>