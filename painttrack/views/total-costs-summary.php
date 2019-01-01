<!-- Count -->
<?php 
$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
			
if ($User[0]->getAttribute('role')== '1')			
	$temp = Project::all();
else
	$temp = $User[0]->project;									
//foreach (Project::where('USER_ID', $User[0]->getAttribute('id')) ->get() as $project): 

	foreach ($temp as $project): ?>
    <?php foreach (Unit::all() as $unit): ?>
        <?php if ($unit->getAttribute('U-P-ID')==$project->getAttribute('P-ID')){?>
            <?php foreach (Room::all() as $room): ?>
                <?php if ($room->getAttribute('R-U-ID')==$unit->getAttribute('U-ID')){?>
                    <?php foreach (Item::all() as $item): ?>
                        <?php if ($item->getAttribute('I-R-ID')==$room->getAttribute('R-ID')){?>
                            <?php foreach (Paint_infos::all() as $paint_info): ?>
                                <?php if ($paint_info->getAttribute('PI-ID')==$item->getAttribute('I-PI-ID')){
                                    $countp = $project->getAttribute('P-ID');
                                    $count[$countp][$paint_info->getAttribute('PI-ID')] = $paint_info->getAttribute('PI-Cost');
                                    $countu = $unit->getAttribute('U-ID');
                                    $count1[$countu][$paint_info->getAttribute('PI-ID')] = $paint_info->getAttribute('PI-Cost');?>
                                        <?php
                                            $total[$countp] = 0;
                                            foreach($count[$countp] as $value){
                                                $total[$countp] = $total[$countp] + $value;
                                            }
                                        ?>
                                        <?php
                                        $total1[$countu] = 0;
                                        foreach($count1[$countu] as $value){
                                            $total1[$countu] = $total1[$countu] + $value;
                                        }
                                        ?>
                                <?php } endforeach; ?>
                            <?php } endforeach; ?>
                        <?php } endforeach;?>
                <?php } endforeach; ?>
        <?php endforeach; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Total costs summary
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Total Costs Summary</li>
    </ol>
</section>
<head>
    <style>
        .hhidden{
            display: none;
        }
    </style>
</head>
<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
      | Your Page Content Here |
      -------------------------->
    <div class="row">
        <div class="col-xs-12">
            <?php foreach ($temp as $project): ?>
            <div class="box">
                <div class="box-header">
                    <!-- Project Name -->
                    <h3 class="box-title">Project Name: <?=$project->getAttribute('P-Name'); ?></h3>
                </div >
                <div class="box-body">
                    <table class="table total-cost">
                        <thead>
                        <tr>
                            <th style="width: 30px"></th>
                            <th>Unit Name</th>
                            <th>Total Paint Cost</th>
                        </tr>
                        </thead>
                        <?php foreach (Unit::all() as $unit): ?>
                            <?php if ($unit->getAttribute('U-P-ID')==$project->getAttribute('P-ID')){?>
                        <tbody>
                        <!-- LOOP -->
                        <tr>
                            <td><img height="20" width="20" src="painttrack\images\plus.png"  id="img<?=$unit->getAttribute('U-ID');?>" class="accordion-toggle"></td>
                            <td><?= $unit->getAttribute('U-Name'); ?></td>
                            <td><?php if(isset($total1[$unit->getAttribute('U-ID')])&&$total1[$unit->getAttribute('U-ID')] !="null"){
                                         echo "$ ".$total1[$unit->getAttribute('U-ID')] ;
                                      }
                                      else
                                          echo "$ 0";
                                      ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="hiddenRow">
                                <table class="table-responsive total-cost hhidden" id="demo<?=$unit->getAttribute('U-ID');?>">
                                 <tbody>
                                <?php foreach (Room::all() as $room): ?>
                                        <?php if ($room->getAttribute('R-U-ID')==$unit->getAttribute('U-ID')){?>
                                        <?php foreach (Item::all() as $item): ?>
                                            <?php if ($item->getAttribute('I-R-ID')==$room->getAttribute('R-ID')){?>
                                                <?php foreach (Paint_infos::all() as $paint_info): ?>
                                                    <?php if ($paint_info->getAttribute('PI-ID')==$item->getAttribute('I-PI-ID')){?>
                                        <tr>
                                            <td >Room Name: <?=$room->getAttribute('R-Name'); ?> <?=$item->getAttribute('I-Name'); ?> Paint Cost:</td>
                                            <td ><?="$ ".$paint_info->getAttribute('PI-Cost'); ?></td>
                                         </tr>
                                                <?php } endforeach; ?>
                                                <?php } endforeach; ?>


                                <?php } endforeach; ?>
                                    </tbody>
                                </table>
                            </td>

                        </tr>

                        <!-- END LOOP -->
                        </tbody>
                                <script>
                                    $('#img<?=$unit->getAttribute("U-ID");?>').click(function () {

                                        $('#demo<?=$unit->getAttribute("U-ID");?>').toggle('fast');
                                        $('#demo<?=$unit->getAttribute("U-ID");?>').css('display','block');
                                        var src = $('#img<?=$unit->getAttribute("U-ID");?>').attr('src');
                                        if(src == 'painttrack\\images\\plus.png'){
                                            $('#img<?=$unit->getAttribute("U-ID");?>').attr('src','painttrack\\images\\minus.png');
                                        }
                                        else{
                                             if(src == 'painttrack\\images\\minus.png'){
                                             $('#img<?=$unit->getAttribute("U-ID");?>').attr('src','painttrack\\images\\plus.png');
                                             }
                                        }
                                    });
                                </script>

                        <?php } endforeach; ?>

                    </table>
                </div>
                <div class="box-header">
                    <!-- Project Name -->
                    <h3 class="box-title">Total Project Paint Cost: <?php if(isset($total[$project->getAttribute('P-ID')])&&$total[$project->getAttribute('P-ID')] !="null"){echo "$ ".$total[$project->getAttribute('P-ID')] ;}
                                                                          else
                                                                              echo "$ 0";
                                                                            ?></h3>
                </div >
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>
<!-- /.content -->
<script type="text/javascript">
    $('.accordian-body').on('show.bs.collapse', function () {
        $(this).closest("table")
            .find(".collapse.in")
            .not(this)
            .collapse('toggle')
    });

</script>
