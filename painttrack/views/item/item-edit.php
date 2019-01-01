<!-- Content Header (Page header) -->
<?php
    $item = Item::find($_GET['item_id']);
    $paint_info = Paint_infos::find($item['I-PI-ID']);
    $room = $item->room;
    $unit = $room->unit;
    $project = $unit->project;
?>
<section class="content-header">
    <h1>
        Edit Item
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><?= $room->getAttribute('R-Name') ?></a></li>
        <li class="active">Edit Item</li>
    </ol>
</section>

<?php
    $item = Item::find($_GET['item_id']);
    $paint_info = Paint_infos::find($item['I-PI-ID']);
?>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="/painttrack/includes/db.php" method="post" id="item-edit" enctype="multipart/form-data">
        <input type="hidden" name="action-page" value="item-edit">
        <input type="hidden" name="item_id" value="<?php echo $_GET['item_id']?>">
        <input type="hidden" name="room_id" value="<?php echo $item['I-R-ID'] ?>">
        <input type="hidden" name="paint_info_id" value="<?php echo $paint_info['PI-ID']?>">

        <div class="form-group">
            <label class="control-label col-sm-2" for="item-name">Item Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="item-name" value="<?php echo $item['I-Name'] ?>" id="item-name" placeholder="Item Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" name="description" id="description" placeholder="Description"><?php echo $item['I-Description'] ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" name="comment" id="comments" placeholder="Comments"><?php echo $item['I-Comment'] ?></textarea>
            </div>
        </div>

        <hr style="border: outset;"/>

        <div class="form-group">
            <label class="control-label col-sm-2" for="paint-name">Paint Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="paintname" value="<?php echo $paint_info['PI-PaintName'] ?>" id="paint-name" placeholder="Paint Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Color</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="color" value="<?php echo $paint_info['PI-Color'] ?>" id="color" placeholder="Color">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Manufacturer</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="manufacturer" value="<?php echo $paint_info['PI-Manufacturer'] ?>" id="manufacturer" placeholder="Manufacturer">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Paint ID</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="paintid" value="<?php echo $paint_info['PI-PaintID'] ?>" id="paint-id" placeholder="Paint ID">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Type</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="type" value="<?php echo $paint_info['PI-Type'] ?>" id="type" placeholder="Type">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Buy</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="qtybuy" value="<?php echo $paint_info['PI-Quant-Buy'] ?>" id="qty-buy" placeholder="Qty Buy">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Used</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="qtyused" value="<?php echo $paint_info['PI-Quant-Used'] ?>" id="qty-used" placeholder="Qty Used">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-remain">Qty Remain</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="qtyremain" value="<?php echo $paint_info['PI-Quant-Remain'] ?>" id="qty-remain" placeholder="Qty Remain">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">Cost</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="cost" value="<?php echo $paint_info['PI-Cost'] ?>" id="cost" placeholder="Cost">
            </div>
        </div>
	    <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="picture<?= $i ?>">Picture <?= $i ?></label>
                <div class="col-sm-10">
                    <input type="file" accept="image/*" class="form-control" id="picture<?= $i ?>" name="picture<?= $i ?>" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-3">
                    <?php if (!empty($paint_info['PI-Picture' . $i])): ?>
                        <img src="<?= $paint_info['PI-Picture' . $i] ?>" style="height: 200px; width: auto" >
                    <?php endif; ?>
                </div>
            </div>
	    <?php endfor; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-Unit</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="piunit" value="<?php echo $paint_info['PI-Unit'] ?>" id="pi-unit" placeholder="PI-Unit">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-PaintComments</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="pipcomments" value="<?php echo $paint_info['PI-PaintComments'] ?>" id="pi-pcomments" placeholder="PI-PaintComments">
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