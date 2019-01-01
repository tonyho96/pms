<?php  
    $printing_setting = isset($_SESSION['printing_setting']) ? $_SESSION['printing_setting'] : [];
    $printing_setting['label_width'] = isset($printing_setting[0]) && !empty($printing_setting[0]) ? $printing_setting[0] : 6;
    $printing_setting['label_height'] = isset($printing_setting[1]) && !empty($printing_setting[1]) ? $printing_setting[1] : 8;
    $printing_setting['vertical_margin'] = isset($printing_setting[2]) && !empty($printing_setting[2]) ? $printing_setting[2] : 0.6;
    $printing_setting['horizontal_margin'] = isset($printing_setting[3]) && !empty($printing_setting[3]) ? $printing_setting[3] : 0.5;
    $printing_setting['unit'] = isset($printing_setting[4]) && !empty($printing_setting[4]) ? $printing_setting[4] : 'cm';
?>

<head>
    <style>
        table{
            margin: 0 auto;
            width: 40%;
            height: 400px;
        }
        tr{
            margin-top: 50px;
            padding-top: 50px;

        }
        td{
            width: 50%;
        }
    </style>
</head>
<body>
<div class ="content-header"><h1>Setting</h1></div>
<div class="content container-fluid">
    <form action="painttrack/includes/db.php" method="post">
        <input type="hidden" name="action-page" value="setting">
        <table>
            <tr>
                <td>Unit : </td>
                <td>
                    <select name="unit">
                        <option value="cm" <?php echo ( $printing_setting['unit'] == 'cm' ) ? 'selected' : ''; ?>>Centimet</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Label Width</td>
                <td><input type="text" name="label_width" value="<?php echo $printing_setting['label_width']; ?>"></td>
            </tr>
            <tr>
                <td>Label Height</td>
                <td><input type="text" name="label_height" value="<?php echo $printing_setting['label_height']; ?>"></td>
            </tr>
            <tr>
                <td>Vertical Margin</td>
                <td><input type="text" name="vertical_margin" value="<?php echo $printing_setting['vertical_margin']; ?>"></td>
            </tr>
            <tr>
                <td>Horizontal Margin</td>
                <td><input type="text" name="horizontal_margin" value="<?php echo $printing_setting['horizontal_margin']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><button>Update</button></td>
            </tr>
        </table>
    </form>
</div>
</body>