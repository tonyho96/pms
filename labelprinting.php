<?php session_start(); 
	if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<?php require "painttrack/views/header.php"; ?>

<!-- Left side column. contains the logo and sidebar -->

<?php require "painttrack/views/sidemenu.php"; ?>

<?php require_once "painttrack/includes/db.php"; ?>


<?php
	$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
	
	if ($User[0]->getAttribute('role')== '1')			
	{
		$items = LabelPrintingService::getItems();
		$templates = Templates::all();
	}
	else
	{
		$items = $User[0]->item;
		$templates =$User[0]->template;
	}
	//$items = $User[0]->item;
    //$items = LabelPrintingService::getItems();
    //$templates = Templates::all();
	//$templates =$User[0]->template;
    if( empty($templates->first()) ) {
    ?>
        <section class="content-header">
            <h1>Template not found!</h1>
            <br/>
            <a href="painttrack.php?page=template-edit" class="btn btn-success">Add Template</a>
        <section>
    <?php
        exit;
    }

    $template_id = isset($_GET['template_id']) ? $_GET['template_id'] : 0;
    $template = Templates::find($template_id);
    if( $template != null ) {
        $printing_setting['label_width'] = $template->getAttribute('label_width');
        $printing_setting['label_height'] = $template->getAttribute('label_height');
        $printing_setting['vertical_margin'] = $template->getAttribute('vertical_margin');
        $printing_setting['horizontal_margin'] = $template->getAttribute('horizontal_margin');
        $printing_setting['unit'] = $template->getAttribute('unit');
        $template_url = $template->getAttribute('template_url');
    } else {
        $printing_setting['label_width'] = $templates[0]->getAttribute('label_width');
        $printing_setting['label_height'] = $templates[0]->getAttribute('label_height');
        $printing_setting['vertical_margin'] = $templates[0]->getAttribute('vertical_margin');
        $printing_setting['horizontal_margin'] = $templates[0]->getAttribute('horizontal_margin');
        $printing_setting['unit'] = $templates[0]->getAttribute('unit');
        $template_url = $templates[0]->getAttribute('template_url');
    }
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Label Printing
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Label Printing</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <style type="text/css">
        .column {
            width: <?php echo $printing_setting['label_width']; ?><?php echo $printing_setting['unit']; ?>;
            height: <?php echo $printing_setting['label_height']; ?><?php echo $printing_setting['unit']; ?>;
        }
        .slot-item {
            /* background-color: #ffffff; */
        }
        .slot-item img {
            width: 100%;
            mix-blend-mode: multiply;
        }
        #showgrid {
            position: relative;
        }
        #template,
        #template1 {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }
        #template {
            z-index: 0 !important;
        }
        #viewtemplate
        {

        }
        .showprint { 
            position: relative !important;
        }
        @page
        {
            /*size: <?php echo ($printing_setting['label_width'] * 3 ) + ( $printing_setting['horizontal_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?> <?php echo ($printing_setting['label_height'] * 3 ) + ( $printing_setting['vertical_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>;*/
            size: auto;  
            margin: 0mm;
        }
        @media print {
            @page
            {
                /*size: <?php echo ($printing_setting['label_width'] * 3 ) + ( $printing_setting['horizontal_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?> <?php echo ($printing_setting['label_height'] * 3 ) + ( $printing_setting['vertical_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>;
                margin: 0px;*/
                size: auto;  
                margin: 0mm;
            }
            .showprint{
                width: 100%;
            }
            .templateview{
                display: none;
            }
            #showgrid {
                width: 100% !important;
                page-break-after: avoid;
                color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            #showgrid-container {
                page-break-after: avoid;
                overflow: inherit !important;
                width: <?php echo ($printing_setting['label_width'] * 3 ) + ( $printing_setting['horizontal_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>;
                height: <?php echo ($printing_setting['label_height'] * 3 ) + ( $printing_setting['vertical_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>;
            }
            .slot-item {
                border: 0px !important;
            }
            .slot-item a u {
                display: none !important;
            }
            .column p {
                border: 0px !important;
            }
        }
    </style>

    <div id="showgrid-container" style="margin:0px auto; overflow: scroll;">

        <div class="templateview no-print">
            <div>
                <strong>Choose Template</strong>
            </div>
            <div style="margin-top: 10px">
                <form action="" method="GET">
                    <div class="form-group">
                        <select id="label_types" name="template_id" class="form-control">
                            <?php foreach ($templates as $template): ?>
                                <option value="<?php echo $template->getAttribute('id'); ?>" data-template-url="<?php echo $template->getAttribute('template_url'); ?>" <?php echo $template_id == $template->getAttribute('id') ? 'selected' : ''; ?>><?php echo $template->getAttribute('template_name'); ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="view()" class="btn btn-default">View</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
            <div>
                <img id="viewtemplate" src="" style="display: none" width="100">
            </div>
        </div>
        <div class="showprint">
            <img id="template" src="<?php echo $template_url; ?>" />
            <div id="showgrid" style="/* background-color: #ddd;  */padding: <?php echo $printing_setting['vertical_margin']; ?><?php echo $printing_setting['unit']; ?> <?php echo $printing_setting['horizontal_margin']; ?><?php echo $printing_setting['unit']; ?>; width: <?php echo ($printing_setting['label_width'] * 3 ) + ( $printing_setting['horizontal_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>; height: <?php echo ($printing_setting['label_height'] * 3 ) + ( $printing_setting['vertical_margin'] * 4 ); ?><?php echo $printing_setting['unit']; ?>;">
                <!-- <img id="template1" src="<?php echo $template_url; ?>" /> -->
                <div class="row" style="margin-bottom: <?php echo $printing_setting['vertical_margin']; ?><?php echo $printing_setting['unit']; ?>;">
                    <div class="column slot-item" id="slot1"><a href="#"><u>SLOT1</u></a></div>
                    <div class="column slot-item" id="slot2" style="margin: 0<?php echo $printing_setting['unit']; ?> <?php echo $printing_setting['horizontal_margin']; ?><?php echo $printing_setting['unit']; ?>;"><a href="#"><u>SLOT2</u></a></div>
                    <div class="column slot-item" id="slot3"><a href="#"><u>SLOT3</u></a></div>
                </div>
                <div class="row" style="margin-bottom: <?php echo $printing_setting['vertical_margin']; ?><?php echo $printing_setting['unit']; ?>;">
                    <div class="column slot-item" id="slot4"><a href="#"><u>SLOT4</u></a></div>
                    <div class="column slot-item" id="slot5" style="margin: 0<?php echo $printing_setting['unit']; ?> <?php echo $printing_setting['horizontal_margin']; ?><?php echo $printing_setting['unit']; ?>;"><a href="#"><u>SLOT5</u></a></div>
                    <div class="column slot-item" id="slot6"><a href="#"><u>SLOT6</u></a></div>
                </div>
                <div class="row">
                    <div class="column slot-item" id="slot7"><a href="#"><u>SLOT7</u></a></div>
                    <div class="column slot-item" id="slot8" style="margin: 0<?php echo $printing_setting['unit']; ?> <?php echo $printing_setting['horizontal_margin']; ?><?php echo $printing_setting['unit']; ?>;"><a href="#"><u>SLOT8</u></a></div>
                    <div class="column slot-item" id="slot9"><a href="#"><u>SLOT9</u></a></div>
                </div>
            </div>
        </div>
    </div>



    <div class="text-center">
        <button id="btn-print" type="button" class="btn btn-primary" style="font-size: 25px; margin: 20px; margin-left: 220px" onclick="printLabel()" disabled="disabled">Print</button>
    </div>

    <!-- Modal -->

    <div id="addLabelModal" class="modal fade" role="dialog" tabindex="-1">
        <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
            <input type="hidden" name="slot-id" id="slot-id" value="">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Label</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="select-project"> Select Label:</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="" id="select-label">
                                    <option selected value="-1" >-- Select --</option>
                                    <?php foreach ( Label::all() as $label ): ?>
                                        <option value="<?= $label->{'L-ID'} ?>"><?= $label->{'L-Name'} ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                               <button type="button" id="apply-label-btn" class="btn btn-success" data-dismiss="modal">Apply Label</button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="select-project"> Select Project:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="" id="select-project">
                                    <option selected value="-1" >-- Select --</option>
                                    <?php 
									if ($User[0]->getAttribute('role')== '1')	
										$temp = Project::all();
									else 
										$temp = $User[0]->project;	
									foreach ( $temp as $project ): ?>
                                        <option value="<?= $project->{'P-ID'} ?>"><?= $project->{'P-Name'} ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="select-unit"> Select Unit:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="" id="select-unit">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="select-room"> Select Room:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="" id="select-room">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="select-item"> Select Item:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="" id="select-item">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="choose-picture">Choose picture:</label>
                            <div class="col-sm-9" id="picture-list"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="comment">Comment:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="comment" name="comment" placeholder="Comment"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label col-sm-3 control-label" for="is-null">Is Null</label>
                            <div class="col-sm-9" style="padding-top: 7px">
                                <input type="checkbox" class="form-check-input" id="is-null" name="is_null">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button style="float: left" type="button" id="submit-item" data-dismiss="modal" class="btn btn-primary">Submit</button>
                        <button style="float: left" type="button" id="save-label" data-dismiss="modal" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <div id="saveLableModel" class="modal fade" role="dialog" tabindex="-1">
        <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Save Label</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="label-name">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="label-name" name="name" placeholder="Name"/>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button style="float: left" type="button" id="save-label-btn" class="btn btn-primary" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>


</section>
<!-- /.content -->

<?php require "painttrack/views/footer.php" ?>
