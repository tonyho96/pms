<?php

include $_SERVER['DOCUMENT_ROOT']."/painttrack/includes/db.php";

$result_data = [];

if ($_POST['selected_item'] == -1){
    $result_data['is_null'] = true;
    echo json_encode($result_data);
    die;
}
else
{
    $item_id = $_POST['selected_item'];

    $chosen_picture_pos = $_POST['chosen_picture']; //value 1 or 2 or 3 or 4
    $chosen_picture_pos = 'PI-Picture'.$chosen_picture_pos; //Add substring to get value from db


    $notes = ["note1" => $_POST['note1'], "note2" =>  $_POST['note2'], "note3" =>  $_POST['note3']];
    $comment = json_encode($notes);
    Item::where('I-ID', '=', $item_id)->update([
        'I-Comment'		=> $comment
    ]);

    $item = Item::find($item_id);
    $room = Room::find($item['I-R-ID']);
    $unit = Unit::find($room['R-U-ID']);
    $paint_info = Paint_infos::find($item['I-PI-ID']);
    $project = Project::find($unit['U-P-ID']);

    //Value of fields PI-Picture1, PI-Picture2, PI-Picture3 and PI-Picture4
    $chosen_picture = $paint_info[$chosen_picture_pos];

    $result_data['picture'] = file_exists(PMS_IMAGE_PATH.$chosen_picture)?
        PMS_IMAGE_PATH.$chosen_picture : PMS_IMAGE_PATH."user.png";
    $result_data['project'] = $project['P-Name'];
    $result_data['unit']    = $unit['U-Name'];
    $result_data['room']    = $room['R-Name'];
    $result_data['item']    = $item['I-Name'];
    $result_data['comment'] = $item['I-Comment'];
    $result_data['is_null'] = false;
    echo json_encode($result_data);
    die;
}

?>