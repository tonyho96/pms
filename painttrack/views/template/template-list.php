<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Templates
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Template</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="/painttrack.php?page=template-edit"><button type="button" class="btn btn-success">Add</button></a>
                </div >
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Label Width</th>
                            <th>Label Height</th>
                            <th>Vertical Margin</th>
                            <th>Horizontal Margin</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
							$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
							if ($User[0]->getAttribute('role')== '1')			
								$temp = Templates::all();
							else
								$temp = $User[0]->template;	
	
                            foreach ($temp as $template): 
                        ?>
                            <tr>
                                <td><?= $template->getAttribute('template_name'); ?></td>
                                <td>
                                    <img src="<?= $template->getAttribute('template_url'); ?>" width="50px"/>
                                </td>
                                <td><?= $template->getAttribute('label_width'); ?> <?= $template->getAttribute('unit'); ?></td>
                                <td><?= $template->getAttribute('label_height'); ?> <?= $template->getAttribute('unit'); ?></td>
                                <td><?= $template->getAttribute('vertical_margin'); ?> <?= $template->getAttribute('unit'); ?></td>
                                <td><?= $template->getAttribute('horizontal_margin'); ?> <?= $template->getAttribute('unit'); ?></td>
                                <td>
                                    <a href="/painttrack.php?page=template-edit&template_id=<?= $template->getAttribute('id'); ?>" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="delete-confirm-btn btn btn-danger" name="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $template->getAttribute('id'); ?>">Delete</button>

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
                      <input type="hidden" name="action-page" value="template-delete">
                      <input type="hidden" name="template_id" id="template_id" value="">
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
        $('#template_id').val($(this).data("id"));
    })
  })


</script>
