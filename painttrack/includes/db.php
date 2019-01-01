<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'functions.php';

require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Users.php';
require_once __DIR__ . '/../models/Unit.php';
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ .'/../models/PaintInfo.php';
require_once __DIR__ .'/../models/Label.php';
require_once __DIR__ .'/../models/template.php';
require_once __DIR__ .'/../models/HomeSettings.php';
require_once __DIR__ . '/../service/UnitService.php';
require_once __DIR__ . '/../service/RoomService.php';
require_once __DIR__ . '/../service/ItemService.php';
require_once __DIR__ . '/../service/LabelPrintingService.php';
require_once __DIR__ .'/../PHPExcel/Classes/PHPExcel.php';

define('PMS_IMAGE_PATH', '/painttrack/images/');
define('PMS_UPLOAD_PATH', __DIR__ . '/../../uploads/');
define('ABSPATH', dirname(dirname(dirname(__FILE__))));
use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;
$capsule->addConnection( [
	'driver'    => DBDRIVER,
	'host'      => DBHOST,
	'database'  => DBNAME,
	'username'  => DBUSER,
	'password'  => DBPASSWORD,
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
] );
// Save UserID


// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM…
$capsule->bootEloquent();

try {
	$action_page = isset( $_POST['action-page'] ) ? $_POST['action-page'] : '';
	$User = Users::where('email', $_SESSION["email"])
									->take(1)
									->get();
	switch ( $action_page ) {
		case 'template-edit':
			$url = ABSPATH . '/print-template/';
			$template_id = $_POST['template_id'];
			$template_url = '';
			$file = $_FILES['template_path'];
			$home_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'];
			if( $file['error'] == 0 ) {
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$file_name = 'Label-Template-' . time() . '.' . $ext;
				$upload_file = $url . $file_name;
				if ( move_uploaded_file( $file['tmp_name'], $upload_file )) {
					$template_url = $home_url . '/print-template/' . $file_name;
				}
			}
			$label_width = isset( $_POST['label_width'] ) && is_numeric($_POST['label_width']) ? $_POST['label_width'] : 6;
			$label_height = isset( $_POST['label_height'] ) && is_numeric($_POST['label_height']) ? $_POST['label_height'] : 8;
			$vertical_margin = isset( $_POST['vertical_margin'] ) && is_numeric($_POST['vertical_margin']) ? $_POST['vertical_margin'] : 0.6;
			$horizontal_margin = isset( $_POST['horizontal_margin'] ) && is_numeric($_POST['horizontal_margin']) ? $_POST['horizontal_margin'] : 0.5;
			if( $template_id ) {
				if( $template_url == '' && isset( $_POST['last_template_url'] ) )
					$template_url = $_POST['last_template_url'];
				
				Templates::where('id', $template_id)->update( [
					'template_name' 	=> $_POST['template_name'],
					'template_url' 		=> $template_url,
					'unit'        		=> $_POST['unit'],
					'label_width' 		=> $label_width,
					'label_height'		=> $label_height,
					'vertical_margin'	=> $vertical_margin,
					'horizontal_margin'	=> $horizontal_margin
				] );
			} else {
				Templates::create( [
					'template_name'     => $_POST['template_name'],
					'template_url' 		=> $template_url,
					'unit'				=> $_POST['unit'],
					'label_width' 		=> $label_width,
					'label_height'		=> $label_height,
					'vertical_margin'	=> $vertical_margin,
					'horizontal_margin'	=> $horizontal_margin,
					'USER_ID'		=> $User[0]->getAttribute('id')
				] );
			}
			header( "Location: /painttrack.php?page=template-list" );
			die;

		case 'template-delete':
			Templates::where('id', $_POST['template_id'])->delete();
			header( "Location: /painttrack.php?page=template-list" );
			die;

		case 'project-add':
			$project = Project::create( [
				'P-Name'        => $_POST['project-name'],
				'P-Description' => $_POST['description'],
				'P-Type'        => $_POST['type'],
				'P-Date'        => $_POST['date'],
				'P-Comments'    => $_POST['comments'],
				'USER_ID'		=> $User[0]->getAttribute('id')
			] );
			header( "Location: /painttrack.php?page=project-list" );
			die;

		case 'project-edit':
      $project = Project::where('P-ID', $_POST['project_id'])->update( [
          'P-Name'        => $_POST['project-name'],
          'P-Description' => $_POST['description'],
          'P-Type'        => $_POST['type'],
          'P-Date'        => $_POST['date'],
          'P-Comments'    => $_POST['comments']
      ] );
      header( "Location: /painttrack.php?page=project-list" );
      die;

		case 'project-delete':
			Project::where('P-ID', $_POST['project_id'])->delete();
			header( "Location: /painttrack.php?page=project-list" );
			die;

		case 'unit-add':
			$unitName = addslashes($_POST['name']);
			$description = addslashes($_POST['description']);
			$comments = addslashes($_POST['comments']);
			$projectId = addslashes($_POST['project_id']);

			UnitService::create([
				'U-Name' => $unitName,
				'U-Description' => $description,
				'U-Comments' => $comment,
				'U-P-ID' => $projectId
			]);
			header( "Location: /painttrack.php?page=project-unit-list&project_id=$projectId" );
			die;

        case 'unit-edit':
            $projectId = $_POST['project_id'];
            $unitName = addslashes($_POST['name-edit']);
            $description = addslashes($_POST['description-edit']);
            $unitId = addslashes($_POST['unit_id']);
            $project = addslashes($_POST['project-edit']);

			if (!empty($unitName) && !empty($description)){
				Capsule::table('units')->where('U-ID', '=', $unitId)->update([
					'U-Name' => $unitName,
					'U-Description' => $description,
					'U-P-ID' => $project
				]);
			}
			header("Location: /painttrack.php?page=project-unit-list&project_id=$projectId");
            die;

		case 'unit-delete':

            $projectId = isset($_POST['project_id']) ? $_POST['project_id'] : '';
            $unit = Unit::find($_POST['unit_id']);
            foreach ($unit->rooms as $room) {
                foreach (Item::all() as $item){
                    if($item->getAttribute('I-R-ID')==$room->getAttribute('R-ID')){
                        Item::where('I-ID', $item->getAttribute('I-ID'))->delete();
                        Paint_infos::where('PI-ID', $item->getAttribute('I-PI-ID'))->delete();
					}
                }
                Room::where('R-ID', $room->getAttribute('R-ID'))->delete();
            }
            Unit::where('U-ID', $_POST['unit_id'])->delete();
			header( "Location: /painttrack.php?page=project-unit-list&project_id=$projectId" );
			die;

		case 'project-unit-room-add':
			$name = addslashes($_POST['name']);
            $description = addslashes($_POST['description']);
            $comments = addslashes($_POST['comments']);
            $unitId = addslashes($_POST['unit_id']);

			RoomService::create([
				'R-Name' => $name,
				'R-Description' => $description,
				'R-Comments' => $comments,
				'R-U-ID' => $unitId
			]);
			header( "Location: /painttrack.php?page=project-unit-room-list&unit_id=$unitId" );
			die;


        case 'room-edit':
            $name = addslashes($_POST['name']);
            $description = addslashes($_POST['description']);
            $comments = addslashes($_POST['comments']);
            $RoomId = addslashes($_POST['room_id']);
            $unitId = addslashes($_POST['unit_id']);
            $unit = addslashes($_POST['unit-edit']);


            if (!empty($name) && !empty($description) && !empty($comments)){
                Capsule::table('rooms')->where('R-ID', '=', $RoomId)->update([
                    'R-Name' => $name,
                    'R-Description' => $description,
                    'R-Comments' => $comments,
                    'R-U-ID' => $unit,
                ]);
            }
            header( "Location: /painttrack.php?page=project-unit-room-list&unit_id=$unitId" );
            die;


		case 'room-delete':
			$unitId = isset($_POST['unit_id']) ? $_POST['unit_id'] : '';
            foreach (Item::all() as $item){
                if($item->getAttribute('I-R-ID')==$_POST['room_id']){
                    Item::where('I-ID', $item->getAttribute('I-ID'))->delete();
                    Paint_infos::where('PI-ID', $item->getAttribute('I-PI-ID'))->delete();
                }
            }
			Room::where('R-ID', $_POST['room_id'])->delete();
			header( "Location: /painttrack.php?page=project-unit-room-list&unit_id=$unitId" );
			die;

		case 'item-edit':
            $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : '';
			$item_id 	 = $_POST['item_id'];
			$paint_id 	 = $_POST['paint_info_id'];

            $itemname    = addslashes( $_POST['item-name'] );
            $description = addslashes( $_POST['description'] );
            $comment     = addslashes( $_POST['comment'] );

            $paintname   = addslashes( $_POST['paintname'] );
            $color       = addslashes( $_POST['color'] );
            $manufacturer= addslashes($_POST['manufacturer']);
			$paintid     = addslashes($_POST['paintid']);
            $type        = addslashes( $_POST['type'] );
            $qtybuy      = addslashes($_POST['qtybuy']);
            $qtyused     = addslashes( $_POST['qtyused'] );
            $qtyremain   = addslashes( $_POST['qtyremain'] );
            $cost        = addslashes( $_POST['cost'] );
            $piunit      = addslashes($_POST['piunit']);
            $pipcomments = addslashes($_POST['pipcomments']);

            if (!empty($itemname) && !empty($description)){
	            $paintInfoData = [
                    'PI-PaintName' => $paintname,
                    'PI-Color' => $color,
                    'PI-Manufacturer' => $manufacturer,
                    'PI-PaintID' => $paintid,
                    'PI-Type'=> $type,
                    'PI-Quant-Buy' => $qtybuy,
                    'PI-Quant-Used' => $qtyused,
                    'PI-Quant-Remain' => $qtyremain,
                    'PI-Cost' => $cost,
                    'PI-Unit' => $piunit,
                    'PI-PaintComments' => $pipcomments
	            ];

	            for ($i = 1; $i <= 4; $i++) {
		            $fieldName = "picture$i";
		            $dbFieldName = "PI-Picture$i";

		            $file = $_FILES[$fieldName];
		            $fileName = "";
		            if (!empty($file) && $file['error'] == 0) {
			            $fileName = ItemService::uploadImage( $file );
						if (!empty($fileName))
			                $paintInfoData[$dbFieldName] = $fileName;
		            }
	            }
	            $painInfo = Paint_infos::find($paint_id);
	            $painInfo->update($paintInfoData);

	            $item = Item::find($item_id);
	            $item->update([
                    'I-Name' 		=> $itemname,
                    'I-Description' => $description,
					'I-Comment' 	=> $comment,
                ]);
            }
            header("Location: /painttrack.php?page=project-unit-room-item-list&room_id=$room_id");
            die;

		case 'item-delete':
			$roomId = isset($_POST['room_id']) ? $_POST['room_id'] : '';
			Item::where('I-ID', $_POST['item_id'])->delete();
			header( "Location: /painttrack.php?page=project-unit-room-item-list&room_id=$roomId" );
			die;

		case 'item-add':
			$room_id=isset($_POST['room_id'])?$_POST['room_id']:'';$room_id=isset($_POST['room_id'])?$_POST['room_id']:'';
			function add($room_id)
			{
				$itemname = !empty($_POST['item-name'])?addslashes($_POST['item-name']): 'null';
				$description = !empty($_POST['description'])?addslashes($_POST['description']):'null';
				$comment =!empty($_POST['comment'])?addslashes($_POST['comment']):'null';

				$paintname = !empty($_POST['paintname'])?addslashes($_POST['paintname']):'null';
				$color = !empty($_POST['color'])?addslashes($_POST['color']):'null';
				$manufacturer = !empty($_POST['manufacturer'])?addslashes($_POST['manufacturer']):'null';
				$paintid = !empty($_POST['paintid'])?addslashes($_POST['paintid']):'null';
				$type = !empty($_POST['type'])?addslashes($_POST['type']):'null';
				$qtybuy = !empty($_POST['qtybuy'])?addslashes($_POST['qtybuy']):'0';
				$qtyused = !empty($_POST['qtyused'])?addslashes($_POST['qtyused']):'0';
				$qtyremain = !empty($_POST['qtyremain'])?addslashes($_POST['qtyremain']):'0';
				$cost = !empty($_POST['cost'])?addslashes($_POST['cost']):'0';
				$piunit = !empty($_POST['piunit'])?addslashes($_POST['piunit']):'null';
                $pipcomments = !empty($_POST['pipcomments'])?addslashes($_POST['pipcomments']):'null';
//    $results = Capsule::select('select R-ID from rooms where R-ID =$room_id');

				$paintInfoData = [
					'PI-PaintName' => $paintname,
					'PI-Color' => $color,
					'PI-Manufacturer' => $manufacturer,
					'PI-PaintID' => $paintid,
					'PI-Type'=> $type,
					'PI-Quant-Buy' => $qtybuy,
					'PI-Quant-Used' => $qtyused,
					'PI-Quant-Remain' => $qtyremain,
					'PI-Cost' => $cost,
					'PI-Unit' => $piunit,
					'PI-PaintComments' => $pipcomments
				];

				for ($i = 1; $i <= 4; $i++) {
					$fieldName = "picture$i";
					$dbFieldName = "PI-Picture$i";

					$file = $_FILES[$fieldName];
					$fileName = "";
					if (!empty($file) && $file['error'] == 0)
						$fileName = ItemService::uploadImage($file);
					$paintInfoData[$dbFieldName] = $fileName;
				}
				
				$User = Users::where('email', $_SESSION["email"])
								->take(1)
								->get();
				$painInfo = Paint_infos::create($paintInfoData);
				Item::create([
					'I-Name' => $itemname,
					'I-Description' => $description,
					'I-Comment' => $comment,
					'I-PI-ID' => $painInfo->{'PI-ID'},
					'I-R-ID' => $room_id,
					'USER_ID'		=> $User[0]->getAttribute('id')
				]);


				header("Location: /painttrack.php?page=project-unit-room-item-list&room_id=$room_id");
			}
			if (!empty($_POST['item-name'])||!empty($_POST['description'])||!empty($_POST['comment'])){
				add($room_id);
			}
			else
				header("Location: /painttrack.php?page=project-unit-room-item-add&room_id=$room_id");
			die;
        case 'export-print':
            $url=__DIR__ .'/../PHPExcel/DownloadPHPExcel/';
            define("PHPexcel","$url");
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'P-ID')
                ->setCellValue('B1', 'P-Name')
                ->setCellValue('C1', 'P-Description')
                ->setCellValue('D1', 'P-Type')
                ->setCellValue('E1', 'P-Date')
                ->setCellValue('F1', 'P-NumUnits')
                ->setCellValue('G1', 'P-Comments');
			$startdate=$_POST['start-date'];
			$enddate=$_POST['end-date'];
			$project=Project::where('P-Date','>=',$startdate)->where('P-Date','<=',$enddate)->get();
            $i = 2;
            foreach ($project as $value)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $value->{'P-ID'})
                    ->setCellValue('B'.$i, $value->{'P-Name'})
                    ->setCellValue('C'.$i, $value{'P-Description'})
                    ->setCellValue('D'.$i, $value->{'P-Type'})
                    ->setCellValue('E'.$i, $value->{'P-Date'})
                    ->setCellValue('F'.$i, $value->{'P-NumUnits'})
                    ->setCellValue('G'.$i, $value->{'P-Comments'});
                $i++;
            }
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $file_name = md5(uniqid(rand(), true)) . '.xlsx';
            $file_path =PHPexcel. $file_name;
            $objWriter->save($file_path);
            header("Content-type: application/x-msdownload",true,200);
            header("Content-Disposition: attachment; filename=$file_name");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo file_get_contents($file_path);
            die;
		case 'ajax-get-item-data':
			$itemId = @$_POST['item-id'];

			if (empty($itemId))
				echo json_encode([]);

			$item = Item::find($itemId);
			$painInfo = $item->paintinfos;
			echo json_encode([
				'picture1' => $painInfo->{'PI-Picture1'},
				'picture2' => $painInfo->{'PI-Picture2'},
				'picture3' => $painInfo->{'PI-Picture3'},
				'picture4' => $painInfo->{'PI-Picture4'},
			]);
			die;
		case 'ajax-get-units':
			$projectId = @$_POST['project-id'];

			if (empty($projectId))
				echo json_encode([]);

			$project = Project::find($projectId);
			$units   = $project->units;

			$response = [];
			foreach ($units as $unit) {
				$response[$unit->{'U-ID'}] = $unit->{'U-Name'};
			}
			echo json_encode($response);
			die;
		case 'ajax-get-rooms':
			$unitId = @$_POST['unit-id'];

			if (empty($unitId))
				echo json_encode([]);

			$unit = Unit::find($unitId);
			$rooms   = $unit->rooms;

			$response = [];
			foreach ($rooms as $room) {
				$response[$room->{'R-ID'}] = $room->{'R-Name'};
			}
			echo json_encode($response);
			die;
		case 'ajax-get-items':
			$roomId = @$_POST['room-id'];

			if (empty($roomId))
				echo json_encode([]);

			$room = Room::find($roomId);
			$items   = $room->items;

			$response = [];
			foreach ($items as $item) {
				$response[$item->{'I-ID'}] = $item->{'I-Name'};
			}
			echo json_encode($response);
			die;
		case 'ajax-save-label':
			$name = @$_POST['name'];
			$itemId = @$_POST['item-id'];
			$imagePos = @$_POST['image-pos'];
			$comment = @$_POST['comment'];

			$label = Label::create([
				'L-Name' => $name,
				'L-I-ID' => $itemId,
				'L-Image-Pos' => $imagePos,
				'L-Comment' => $comment,
			]);
			echo 1;
			die;
		case 'ajax-get-label-data':
			$labelId = @$_POST['label-id'];

			$label = Label::find($labelId);
			$item = $label->item;
			$room = $item->room;
			$unit = $room->unit;
			$project = $unit->project;
			$painInfo = $item->paintinfos;

			$imageFieldName = 'PI-Picture' . $label->{'L-Image-Pos'};
			$imageUrl = $painInfo->{$imageFieldName};
			echo json_encode([
				'item_id' => $item->{'I-ID'},
				'item_name' => $item->{'I-Name'},
				'room_id' => $room->{'R-ID'},
				'room_name' => $room->{'R-Name'},
				'unit_id' => $unit->{'U-ID'},
				'unit_name' => $unit->{'U-Name'},
				'project_id' => $project->{'P-ID'},
				'project_name' => $project->{'P-Name'},
				'picture1' => $painInfo->{'PI-Picture1'},
				'picture2' => $painInfo->{'PI-Picture2'},
				'picture3' => $painInfo->{'PI-Picture3'},
				'picture4' => $painInfo->{'PI-Picture4'},
				'comment' => $label->{'L-Comment'},
				'image_url' => $imageUrl,
				'image_pos' => $label->{'L-Image-Pos'}
			]);
			die;
		case 'ajax-get-labels':
			$labels = Label::all();
			$res = [];
			foreach ($labels as $label) {
				$res[$label->{'L-ID'}] = $label->{'L-Name'};
			}
			echo json_encode($res);
			die;

        case 'reset-password':
            $temp = $_POST['email'];
            $result = Users::where('email',$temp)->get();
            $key = false;


			foreach ($result as $value){
				if($value->email) {
                	$key = true;
				}
			}

            $_SESSION['error'] = '';

            if ($key) {

                $remember_token = bin2hex(random_bytes(8));

                $url = sprintf('%sreset.php?%s', "http://$_SERVER[HTTP_HOST]"."/", http_build_query([
                    'remember_token' => $remember_token
                ]));

                $result = Users::where('email',$temp)->update([
                    'remember_token' => $remember_token
                ]);

                $to = $temp;

                // Subject
                $subject = 'Your password reset link';

                // Message
                $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
                $message .= 'If you did not make this request, you can ignore this email</p>';
                $message .= '<p>Here is your password reset link: </br>';
                $message .= sprintf('<a href="%s">%s</a></p>', $url, $url);
                $message .= '<p>Thanks!</p>';


                // Send email
                send_mail($to, $subject, $message);
                header('Location: ../../request-success.php');
            }
            else{
                $_SESSION['error'] = 'Request reset password Fail, Please check email again';
                header('Location: ../../reset_password.php');
			}
            die;

        case 'reset-process':
        	$remember_token = $_POST['remember_token'];
        	$password = $_POST['password'];
        	$password1 = $_POST['password1'];

        	if($password != $password1) {
                $_SESSION['error'] = 'Password not same, please check password again';
                header('Location: ../../reset.php?remember_token='.$remember_token);
                die();
            }
        	$result = Users::where('remember_token',$remember_token)->get();

        	if ($result) {
        		Users::where('remember_token',$remember_token)->update([
        			'password' 		=> md5($password)
				]);
                header('Location: ../../login.php');
        	}
        	die;



        case 'setting':
            session_start();
            if(isset($_POST['label_width'])){
            	$label_width = $_POST['label_width'];
            }
            if(isset($_POST['label_height'])){
                $label_height = $_POST['label_height'];
            }
            if(isset($_POST['vertical_margin'])){
                $vertical_margin = $_POST['vertical_margin'];
            }
            if(isset($_POST['horizontal_margin'])){
                $horizontal_margin = $_POST['horizontal_margin'];
            }
            $unit = isset($_POST['unit']) ? $_POST['unit'] : 'cm';
            $_SESSION['printing_setting'] = Array($label_width,$label_height,$vertical_margin,$horizontal_margin, $unit);
            header("Location: /painttrack.php?page=setting");
			die;
		case 'change_password':
			$current_user = Users::where('email', $_SESSION['email'])->first();
			$current_password = md5($_POST['current_password']);
			$new_password1 = $_POST['new_password1'];
			$new_password2 = $_POST['new_password2'];
			if ($current_password== $current_user->password){
				if($new_password1 == $new_password2){
					$password=md5($new_password1);
					$id= $current_user->id;
					Users::where('email', $_SESSION['email'])->update([
						'password' => $password
					]);
					 
					$_SESSION['successful_message'] = 'Successfully change password.';
				}
				else {
					$_SESSION['fail_message'] = 'Two new passwords are not match.';
				}
			}
			else {
				$_SESSION['fail_message'] = 'Old password is not right.';
			}
			header("Location: ../../change_password.php");
			die;
		default:
			break;
	}
} catch ( Exception $e ) {
	die( $e->getMessage() );
}

if ($action_page)
	header( "Location: /painttrack.php?page=$action_page" );


//Create table "users"
// Capsule::schema()->create('users', function ($table) {
//     $table->increments('id');
//     $table->string('username');
//     $table->string('password');
//     $table->string('email')->unique();
//     $table->timestamps();
// });

//Get user from table "users"
// $users = Capsule::table('users')->where('username', '=', 'test')->get();

//Add new row to table "users"

// Capsule::table('paintinfos')->insert([
//    'pi_paintname' => $paintname,
//     'pi_color'=>$color,
//     'pi_type'=>$type,
//     'PI_Quant_Used'=>$qtyused,
//     'PI_Quant_Remain'=>$qtyremain,
//     'PI_Cost'=>$cost
//
//
// ]);


//Update
// Capsule::table('users')->where('username', '=', 'testing')->update([
//     'username' => 'testing'
// ]);

//Delete
// Capsule::table('users')->where('username', '=', 'testing')->delete();
?>
