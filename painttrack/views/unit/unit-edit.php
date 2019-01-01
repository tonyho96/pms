<?php
$unit = Unit::find($_GET['unit_id']);
$project = $unit->project;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Unit
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class="active">Edit Unit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="painttrack/includes/db.php" method="post" id="project-add">
        <input type="hidden" name="unit_id" value="<?= $_GET['unit_id'] ?>">
        <input type="hidden" name="project_id" value="<?= $unit->getAttribute('U-P-ID')?>">
        <input type="hidden" name="action-page" value="unit-edit">
        <div class="form-group">
            <label class="control-label col-sm-2" for="unit-name">Unit Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name-edit" id="unit-name" placeholder="Unit Name" value="<?= $unit->getAttribute('U-Name')?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" name="description-edit" id="description" placeholder="Description"><?= $unit->getAttribute('U-Description')?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="project-id">Project:</label>
            <div class="col-sm-10">
                <select class="form-control" id="project-id" name="project-edit">
                    <?php foreach (Project::all() as $project): ?>
                        <option <?php if($unit->getAttribute('U-P-ID') == $project->getAttribute('P-ID')){echo "selected=selected";}?> value="<?= $project->getAttribute('P-ID'); ?>"><?= $project->getAttribute('P-Name'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</section>