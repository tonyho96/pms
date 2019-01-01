<?php
$unit = Unit::find($_GET['unit_id']);
$project = $unit->project;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Room
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class="active">Add Room</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->

    <form class="form-horizontal" action="painttrack/includes/db.php" method="post" id="project-add">
        <input type="hidden" name="action-page" value="project-unit-room-add">
        <input type="hidden" name="unit_id" value="<?= $_GET['unit_id'] ?>">
        <div class="form-group">
            <label class="control-label col-sm-2" for="room-name">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="description" name="description" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</section>
