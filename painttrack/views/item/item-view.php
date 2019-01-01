<!-- Content Header (Page header) -->
<head>
    <style>
    .form-group .col-sm-10{
        padding-top: 7px;
        padding-left: 150px;
        margin-bottom: 20px;
    }
    </style>
</head>
<?php
    $item = Item::find($_GET['item_id']);
    $paint_info = Paint_infos::find($item['I-PI-ID']);
    $room = $item->room;
    $unit = $room->unit;
    $project = $unit->project;
?>
<section class="content-header">
    <h1>
        View Item
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getKey() ?>"><?= $project->getAttribute('P-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-list&unit_id=<?= $unit->getKey() ?>"><?= $unit->getAttribute('U-Name') ?></a></li>
        <li class=""><a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><?= $room->getAttribute('R-Name') ?></a></li>
        <li class="active">View Item</li>
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
    <form class="form-horizontal" action="/painttrack/includes/db.php" method="post" id="item-view" enctype="multipart/form-data">
        <input type="hidden" name="action-page" value="item-view">
        <input type="hidden" name="item_id" value="<?php echo $_GET['item_id']?>">
        <input type="hidden" name="room_id" value="<?php echo $item['I-R-ID'] ?>">
        <input type="hidden" name="paint_info_id" value="<?php echo $paint_info['PI-ID']?>">

        <div class="form-group">
            <label class="control-label col-sm-2" for="item-name">Item Name</label>
            <div class="col-sm-10">
                <?php echo $item['I-Name'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description</label>
            <div class="col-sm-10">
                <?php echo $item['I-Description'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments</label>
            <div class="col-sm-10">
                <?php echo $item['I-Comment'] ?>
            </div>
        </div>

        <hr style="border: outset;"/>

        <div class="form-group">
            <label class="control-label col-sm-2" for="paint-name">Paint Name</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-PaintName'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Color</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Color'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Manufacturer</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Manufacturer'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="color">Paint ID</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-PaintID'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Type</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Type'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Buy</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Quant-Buy'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-used">Qty Used</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Quant-Used'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="qty-remain">Qty Remain</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Quant-Remain'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">Cost</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Cost'] ?>
            </div>
        </div>
	    <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="picture<?= $i ?>">Picture <?= $i ?></label>

                <div class="col-sm-10">
                    <?php if (!empty($paint_info['PI-Picture' . $i])): ?>
                        <img src="<?= $paint_info['PI-Picture' . $i] ?>" style="height: 200px; width: auto" >
                    <?php endif; ?>
                </div>
            </div>
	    <?php endfor; ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-Unit</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-Unit'] ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">PI-PaintComments</label>
            <div class="col-sm-10">
                <?php echo $paint_info['PI-PaintComments'] ?>
            </div>
        </div>
    </form>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/painttrack.php?page=project-unit-room-item-list&room_id=<?= $room->getKey() ?>"><button type="submit" class="btn btn-primary">Cancel</button></a>
        </div>
    </div>
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