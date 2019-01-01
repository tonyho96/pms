
<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>
        Export / Print
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Export / Print</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <div class="container">

        <form action="painttrack/includes/db.php" method="post" name="date-range-form">
            <input type="hidden" name="action-page" value="export-print">
            <label for="start-date">Date From</label>
            <input type="text" name="start-date" id="start-date"/>

            <label for="end-date">Date To</label>
            <input type="text" name="end-date" id="end-date"/>
            <button type="submit" class="btn btn-success">Export</button>
           <button id="print-btn" type="button" class="btn btn-primary">Print</button>
        </form>
        <form action="painttrack/views/print-template.php" method="post" id="print-form" style="display:none;">
            <input type="hidden" name="start-date" id="print-start-date"/>
            <input type="hidden" name="end-date" id="print-end-date"/>
        </form>
    </div>
    <script>
        jQuery(document).ready(function(){
            jQuery('#print-btn').on('click',function(){
                jQuery('#print-start-date').val(jQuery('#start-date').val());
                jQuery('#print-end-date').val(jQuery('#end-date').val());
                jQuery('#print-form').submit();

            });
        });
    </script>
	<script>
		$( function() {
			$( "#start-date" ).datepicker();
			$( "#end-date" ).datepicker();				
		});
	</script>
</section>
<!-- /.content -->