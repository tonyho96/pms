<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Print PDF</title>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../assets/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="../../assets/dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <!-- jQuery 3 -->
    <script src="../../assets/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>
    <style>
        @page { size: auto;  margin: 0mm; }
    </style>

</head>

<body>
<?php
require_once __DIR__ . '/../includes/db.php';

require_once 'total-pi-cost.php';



$project = Project::find($_GET['project_id']);
$html = "<div>Project Name:".$project->getAttribute('P-Name')."</div>";

foreach (Unit::all() as $unit) {
    if ($unit->getAttribute('U-P-ID') == $project->getAttribute('P-ID')) {
        $html .= "<div style='margin-left: 20px'>" . $unit->getAttribute('U-Name') . "</div>";
        foreach (Room::all() as $room){
            if ($room->getAttribute('R-U-ID') == $unit->getAttribute('U-ID')){
                $html .= "<div style='margin-left: 40px'>" . $room->getAttribute('R-Name') . " Paint Cost:       $";
                if(isset($total2[$room->getAttribute('R-ID')])&&$total2[$room->getAttribute('R-ID')] !="null"){
                    $html .= $total2[$room->getAttribute('R-ID')] ."</div>";
                }
                else {
                    $html .= 0 . "</div>";
                }
            }
        }

        $html.= "<br><div style='margin-left: 40px'><strong>Total ". $unit->getAttribute('U-Name') . " Paint Cost:   $</strong>";
        if(isset($total1[$unit->getAttribute('U-ID')])&&$total1[$unit->getAttribute('U-ID')] !="null"){
            $html .= $total1[$unit->getAttribute('U-ID')] ."</div><br><br>";
        }
        else {
            $html .= 0 . "</div><br>";
        }
    }
}
$html .= "<div><strong>Total Project Paint Cost:      $";
if(isset($total[$project->getAttribute('P-ID')]) && $total[$project->getAttribute('P-ID')] !="null"){
    $html .= $total[$project->getAttribute('P-ID')] ."</strong></div>";
}
else {
    $html .= 0 . "</strong></div>";
}
echo "<div style='margin-left: 40px; margin-top: 40px'>".$html."</div>";
?>

<script>
      jQuery(document).ready(function () {
        window.print();
      });
</script>
</body>

</html>
