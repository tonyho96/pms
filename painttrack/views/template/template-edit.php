<!-- Content Header (Page header) -->
<?php  
    $template_id = isset( $_GET['template_id'] ) ? $_GET['template_id'] : 0;
    $template = Templates::find($template_id);
    $label = 'Add Template';
    $template_name = '';
    $template_url = '';
    $unit = '';
    $label_width = '';
    $label_height = '';
    $vertical_margin = '';
    $horizontal_margin = '';
    if( $template != null ) {
        $label = 'Edit Template';
        $template_name = $template->getAttribute('template_name');
        $template_url = $template->getAttribute('template_url');
        $unit = $template->getAttribute('unit');
        $label_width = $template->getAttribute('label_width');
        $label_height = $template->getAttribute('label_height');
        $vertical_margin = $template->getAttribute('vertical_margin');
        $horizontal_margin = $template->getAttribute('horizontal_margin');
    }
?>
<section class="content-header">
    <h1>
        <?php echo $label; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Template</li>
        <li class="active"><?php echo $label; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <form class="form-horizontal" action="painttrack/includes/db.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action-page" value="template-edit">
        <input type="hidden" name="template_id" value="<?php echo $template_id; ?>" />
        <div class="form-group">
            <label class="control-label col-sm-2" for="template_name">Template Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name" style="max-width: 500px;" required="required" value="<?php echo $template_name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="template_path">Template Path:</label>
            <div class="col-sm-10">
                <input id="template_path" type="file" name="template_path" />
                <br/>
                <?php if( $template_url != '' ) : ?>
                    <input type="hidden" name="last_template_url" value="<?php echo $template_url; ?>">
                    <img src="<?php echo $template_url; ?>" width="100px">
                <?php endif ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="unit">Unit:</label>
            <div class="col-sm-10">
                <select id="unit" name="unit" class="form-control" style="max-width: 250px;">
                    <option value="cm" <?php echo $unit == 'cm' ? 'selected' : ''; ?>>Centimet</option>
                    <option value="in" <?php echo $unit == 'in' ? 'selected' : ''; ?>>Inches</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="label_width">Label Width:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_width" name="label_width" placeholder="6" style="max-width: 250px;" value="<?php echo $label_width; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="label_height">Label Height:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="label_height" name="label_height" placeholder="8" style="max-width: 250px;" value="<?php echo $label_height; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="vertical_margin">Vertical Margin:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vertical_margin" name="vertical_margin" placeholder="0.6" style="max-width: 250px;" value="<?php echo $vertical_margin; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="horizontal_margin">Horizontal Margin:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="horizontal_margin" name="horizontal_margin" placeholder="0.5" style="max-width: 250px;" value="<?php echo $horizontal_margin; ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</section>
