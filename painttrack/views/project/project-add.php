<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Project
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painttrack.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Project</li>
        <li class="active">Add Project</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <form class="form-horizontal" action="painttrack/includes/db.php" method="post" id="project-add">
        <input type="hidden" name="action-page" value="project-add">
        <div class="form-group">
            <label class="control-label col-sm-2" for="project-name">Project Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="project-name" placeholder="Project Name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea rows="4" class="form-control" id="description" name="description" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Type:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type" name="type" placeholder="Type">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="date">Date:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="date" name="date" placeholder="Type">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="comments">Comments:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</section>
