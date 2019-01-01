<?php
$unit = Unit::find($_GET['unit_id']);
$project = $unit->project;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rooms
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class="active">Rooms</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="/painttrack.php?page=project-unit-room-add&unit_id=<?= $_GET['unit_id'] ?>"><button type="button" class="btn btn-success">Add</button></a>
                </div >
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Room Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($unit->rooms as $room): ?>
                            <tr>
                                <td><?= $room->getAttribute('R-Name') ?></td>
                                <td><?= $room->getAttribute('R-Description') ?></td>
                                <td>
                                    <a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><button type="button" class="btn btn-default">View</button></a>
                                    <a href="/painttrack.php?page=project-unit-room-edit&room_id=<?= $room->getKey() ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <button type="button" class="delete-confirm-btn btn btn-danger" name="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $room->getKey() ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="delete-modal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to delete?</p>
                  </div>
                  <div class="modal-footer">
                    <form action="/painttrack/includes/db.php" method="post">
                      <input type="hidden" name="action-page" value="room-delete">
                      <input type="hidden" name="unit_id" value="<?= $unit->getKey() ?>">
                      <input type="hidden" name="room_id" id="room-id" value="">
                      <button type="submit" class="btn btn-default">Yes</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </form>

                  </div>
                </div>

              </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

<script type="text/javascript">

  $(document).ready(function(){
    $('.delete-confirm-btn').click(function(){
        $('#room-id').val($(this).data("id"));
    })
  })


</script>
