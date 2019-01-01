<!-- Content Header (Page header) -->
<?php
    $room = Room::find($_GET['room_id']);
    $unit1 = $room->unit;
    $project = $unit1->project;
?>
<section class="content-header">
    <h1>
        Edit Room
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit1->getKey() ?>"><?= $unit1->getAttribute('U-Name') ?></a></li>
        <li class="active">Edit Room</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="/painttrack/includes/db.php" method="post" id="room-edit">
        <input type="hidden" name="room_id" value="<?php echo $_GET['room_id'] ?>">
        <input type="hidden" name="unit_id" value="<?= $room->getAttribute('R-U-ID')?>">
        <input type="hidden" name="action-page" value="room-edit">
        <div class="form-group">
            <label class="control-label col-sm-2" for="room-name">Room Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="room-name" name="name" placeholder="Room Name" value="<?php echo $room['R-Name'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="description" name="description" placeholder="Description"><?php echo $room['R-Description'] ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments" value="<?php echo $room['R-Comments'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="unit-id">Unit:</label>
            <div class="col-sm-10">
                <select class="form-control" id="unit-id" name="unit-edit">
                    <?php foreach (Unit::all() as $unit): ?>
                    <?php if ($unit->getAttribute('U-P-ID')==$unit1->getAttribute('U-P-ID')){ ?>
                        <option <?php if($room->getAttribute('R-U-ID') == $unit->getAttribute('U-ID')){echo "selected=selected";}?> value="<?= $unit->getAttribute('U-ID'); ?>"><?= $unit->getAttribute('U-Name'); ?></option>
                    <?php } endforeach; ?>
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