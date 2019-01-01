<!-- Content Header (Page header) -->

<style>
    .btn{
        padding: 6px 9px !important;
    }
</style>
<section class="content-header">
    <h1>
        Projects
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Project</li>
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
                    <a href="/painttrack.php?page=project-add"><button type="button" class="btn btn-success">Add</button></a>
                </div >
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Number Of Units</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
						$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
				
						if ($User[0]->getAttribute('role')== '1') {
                            $temp = Project::all();
                            if(isset($_GET['user-id'])){
                                $temp = Project::where('USER_ID',$_GET['user-id'])->get();
                            }
                        }
						else
							$temp = $User[0]->project;
			
						//echo $User[0]->getAttribute('id');
						//foreach (Project::all() as $project): 
							foreach ($temp as $project):?>
                            <tr>
                                <td><?= $project->getAttribute('P-Name'); ?></td>
                                <td><?= $project->getAttribute('P-Description'); ?></td>
                                <td><?= $project->getAttribute('P-Type'); ?></td>
                                <td><?= $project->getAttribute('P-Date'); ?></td>
                                <td><?= count($project->units) ?></td>
                                <td><?= $project->getAttribute('P-Comments'); ?></td>
                                <td>
                                    <a href="/painttrack.php?page=project-unit-list&project_id=<?= $project->getAttribute('P-ID'); ?>"><button type="button" class="btn btn-default">View</button></a>
                                    <a href="/painttrack.php?page=project-edit&project_id=<?= $project->getAttribute('P-ID'); ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <a href="/painttrack.php?page=total-costs-summary"><button type="button" class="btn btn-success">Costs</button></a>
                                    <button type="button" class="delete-confirm-btn btn btn-danger" name="button" data-toggle="modal" data-target="#delete-modal" data-id="<?= $project->getAttribute('P-ID'); ?>">Delete</button>
                                    <a href="/painttrack/views/export-pdf.php?project_id=<?= $project->getAttribute('P-ID'); ?>"><button type="button" class="btn btn-success">Export</button></a>
                                    <a href="/painttrack/views/print-pdf.php?project_id=<?= $project->getAttribute('P-ID'); ?>"><button type="button" class="btn btn-primary">Print</button></a>
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
                      <input type="hidden" name="action-page" value="project-delete">
                      <input type="hidden" name="project_id" id="project-id" value="">
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
        $('#project-id').val($(this).data("id"));
    })
  })


</script>
