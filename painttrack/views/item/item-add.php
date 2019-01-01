<!-- Content Header (Page header) -->
<?php
    if(isset($_GET['room_id'])) {
        $room = Room::find($_GET['room_id']);
        $unit = $room->unit;
        $project = $unit->project;
    }
?>
<section class="content-header">
    <h1>
        Add Item
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><?= $room->getAttribute('R-Name') ?></a></li>
        <li class="active">Add Item</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="painttrack/includes/db.php" method="post" id="project-add" enctype="multipart/form-data">
        <input type="hidden" name="room_id" value="<?= $_GET['room_id'] ?>">
        <input type="hidden" name="action-page" value="item-add">

        <div class="form-group">
            <label class="control-label col-sm-2" for="item-name">Item Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item-name" name="item-name" placeholder="Item Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="description" name ="description" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="comments" name="comment" placeholder="Comments"></textarea>
            </div>
        </div>

        <hr style="border: outset;"/>

        <div class="form-group">
            <label class="control-label col-sm-2" for="paint-name">Paint Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="paint-name" name="paintname" placeholder="Paint Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Color</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="color" name="color" placeholder="Color">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Manufacturer</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Manufacturer">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Paint ID</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="paint-id" name="paintid" placeholder="Paint ID">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Type</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type" name="type" placeholder="Type">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Buy</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="qty-buy" name="qtybuy" placeholder="Qty Buy">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Used</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="qty-used" name="qtyused" placeholder="Qty Used">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-remain">Qty Remain</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="qty-remain" name="qtyremain" placeholder="Qty Remain">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">Cost</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="cost" name="cost" placeholder="Cost">
            </div>
        </div>
	    <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="picture<?= $i ?>">Picture <?= $i ?></label>
                <div class="col-sm-10">
                    <input type="file" accept="image/*"  class="form-control" id="picture<?= $i ?>" name="picture<?= $i ?>" >
                </div>
            </div>
	    <?php endfor; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-Unit</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pi-unit" name="piunit" placeholder="PI-Unit">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-PaintComments</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pi-pcomments" name="pipcomments" placeholder="PI-PaintComments">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</section>

<script>
    $('form').submit(function(){
        var isOk = true;
        var maxSize = 2048 * 1000;
        $('input[type=file]').each(function(){
            if(typeof this.files[0] !== 'undefined'){
                size = this.files[0].size;
                isOk = maxSize > size;
                return isOk;
            }
        });
        if (!isOk)
            alert('File is too large');

        return isOk;
    });
</script>