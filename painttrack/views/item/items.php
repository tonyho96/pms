<?php
use Illuminate\Database\Capsule\Manager as Capsule;
if(isset($_GET['room_id']))
  $room = Room::find($_GET['room_id']);
 $room_id=$room->getkey();
 $items=  Capsule::table('items')->join('paint_infos','paint_infos.PI-ID','=','items.I-PI-ID')->join('rooms','rooms.R-ID','=','items.I-R-ID')->where('rooms.R-ID','=',$room_id)->get();
 $unit = $room->unit;
 $project = $unit->project;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Items
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><?= $room->getAttribute('R-Name') ?></a></li>
        <li class="active">Items</li>
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
                    <a href="/painttrack.php?page=project-unit-room-item-add&room_id=<?= $_GET['room_id'] ?>"><button type="button" class="btn btn-success">Add</button></a>
                </div >
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Comments</th>
                            <th>Paint Name</th>
                            <th>Color</th>
                            <th>Type</th>
                            <th>Qty-Used</th>
                            <th>Qty-Remain</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($items as $value) :?>
                        <tr>
                           <td><?= $value->{'I-Name'}?></td>
                            <td style="word-break: break-all;"><?= $value->{'I-Description'}?></td>

                            <td style="word-break: break-all;"><?= $value->{'I-Comment'}?></td>
                            <td><?=$value->{'PI-PaintName'}?></td>
                            <td><?=$value->{'PI-Color'}?></td>
                            <td><?=$value->{'PI-Type'}?></td>
                            <td><?=$value->{'PI-Quant-Used'}?></td>
                            <td><?=$value->{'PI-Quant-Remain'}?></td>
                            <td><?=$value->{'PI-Cost'}?></td>
                            <td>
                                <a href="/painttrack.php?page=project-unit-room-item-view&item_id=<?= $value->{'I-ID'}?>"><button type="button" class="btn btn-primary">View</button></a>
                                <a href="/painttrack.php?page=project-unit-room-item-edit&item_id=<?= $value->{'I-ID'}?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                <button type="button" class="delete-confirm-btn btn btn-danger" name="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $value->{'I-ID'} ?>">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach;?>


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
                      <input type="hidden" name="action-page" value="item-delete">
                      <input type="hidden" name="room_id" value="<?= $room->getKey() ?>">
                      <input type="hidden" name="item_id" id="item-id" value="">
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
        $('#item-id').val($(this).data("id"));
    })
  })


</script>
