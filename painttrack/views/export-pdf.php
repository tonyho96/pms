
<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../views/dompdf/autoload.inc.php';


require_once 'total-pi-cost.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

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

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("pdf");
?>