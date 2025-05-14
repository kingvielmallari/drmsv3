<?php
include '../dbcon.php';

$page = ((isset($_POST['page'])) ? $_POST['page'] : "0");
$entries = ((isset($_POST['entries'])) ? $_POST['entries'] : "0");
$search = ((isset($_POST['search']) && $_POST['search'] != "") ? "AND yl.Year_level  LIKE '%" . $_POST['search'] . "%'" : "");
$progid = ((isset($_POST['progid'])) ? $_POST['progid'] : "");
$pyid = ((isset($_POST['pyid'])) ? $_POST['pyid'] : "");
$ylid = ((isset($_POST['ylid'])) ? $_POST['ylid'] : "");
$progtype = ((isset($_POST['progtype'])) ? "AND py.ProgStatus_id = '" . $_POST['progtype'] . "'" : "");
$progid = ((isset($_POST['progid'])) ? $_POST['progid'] : "");
$code = ((isset($_POST['progcode'])) ? $_POST['progcode'] : "");
$desc = ((isset($_POST['progdesc'])) ? $_POST['progdesc'] : "");
$dur = ((isset($_POST['progduration'])) ? $_POST['progduration'] : "");
$av = ((isset($_POST['progavailability'])) ? $_POST['progavailability'] : "");

if (isset($_POST['manual'])) {
    echo '
    <div class="row g-3">
        <div class="row me-2 mt-2">
            <button class="btn btn-sm btn-primary w-auto tutorial_btn" data-bs-toggle="collapse" data-bs-target="#tutorial_manage_programs">How to manage programs?</button>
            <div class="collapse border m-3" id="tutorial_manage_programs" data-bs-parent="#accordion">
                <ul>
                    <li><span>In this page, you can see the list of programs. </span></li>
                    <img width="1000" src="../photos_tutorial/PROGRAMS/1.png">
                    <li><span>Click the "Add program" button to add a new program, then click "Submit".</span></li>
                    <img class="img-fluid" src="../photos_tutorial/PROGRAMS/2.png">
                    <li><span>Click the "Update" button to update a program, then click "Submit".</span></li>
                    <img class="img-fluid" src="../photos_tutorial/PROGRAMS/3.png">
                    <li><span>In the "Manage Year Level" button, you can add year levels to the programs</span></li>
                    <li>Select program</li>
                    <img src="../photos_tutorial/PROGRAMS/4.png">
                    <li>Select program type</li>
                    <img src="../photos_tutorial/PROGRAMS/5.png">
                    <li>These are the year levels under that program.</li>
                    <img src="../photos_tutorial/PROGRAMS/6.png">
                    <li>Click the "Add year level" button to add a new year level to the program, then select the year level you want to add.</li>
                    <img src="../photos_tutorial/PROGRAMS/7.png">
                </ul>    
            </div>
        </div>
    </div>
    ';
}

if (isset($_POST['delprog'])) {
    $bdel = "SELECT `Program_code`
    FROM
    `program_list` WHERE `Program_list_id`='$progid'";
    $bres = mysqli_fetch_array(execquery($bdel))[0];
    $sql = "DELETE
    FROM
    `program_list` WHERE `Program_list_id`='$progid'";
    $res = affected($sql);
    if ($res) {
        addlogs("Deleted a program: " . $bres);
    }
    echo (($res) ? "Success" : "Error While Deleting Program");
}


if (isset($_POST['addprogram'])) {
    $av = 'Available';
    $arr = [];
    array_push($arr, $code);
    array_push($arr, $desc);
    array_push($arr, $dur);
    array_push($arr, $av);
    $sql = "INSERT INTO `program_list`(
        `Program_code`,
        `Program_desc`,
        `Program_duration`,
        `Availability`
        )
        VALUES(
        ?,
        ?,
        ?,
        ?
        )";
    $arr1 = [];
    array_push($arr1, $code);
    $sql1 = "SELECT * FROM `program_list` pl WHERE pl.Program_code=?";
    $res1 = queryOneParam($sql1, $arr1);
    if (mysqli_num_rows($res1) > 0) {
        echo "Code Already Used";
    } else {
        $res = queryOneParam($sql, $arr);
        if ($res == "") {
            addlogs("Added a new program: " . $code);
        }
        echo ($res == "") ? "Added" : "Error While Adding Program";
    }
}


if (isset($_POST['upprogram'])) {
    $arr = [];
    array_push($arr, $code);
    array_push($arr, $desc);
    array_push($arr, $dur);
    array_push($arr, $av);
    array_push($arr, $progid);
    $sql = "UPDATE
    `program_list`
    SET
        `Program_code` = ?,
        `Program_desc` = ?,
        `Program_duration` = ?,
        `Availability` = ?
    WHERE
   	`Program_list_id` =?";
    $arr1 = [];
    array_push($arr1, $code);
    $sql1 = "SELECT * FROM `program_list` pl WHERE pl.Program_code=?";
    $res1 = queryOneParam($sql1, $arr1);
    if (mysqli_num_rows($res1) > 0) {
        $r = mysqli_fetch_array($res1);
        if ($r[0] == $progid) {
            $res = queryOneParam($sql, $arr);
            if ($res == "") {
                addlogs("Update a program: " . $code);
            }
            echo ($res == "") ? "Success" : "Error While Updating Program";
        } else {
            echo "Code Already Used";
        }
    } else {
        $res = queryOneParam($sql, $arr);
        echo ($res == "") ? "Success" : "Error While Updating Program";
    }
}


if (isset($_POST['setprogtype'])) {
    $sql = "SELECT * FROM `progstatus`";
    $res = execquery($sql);
    $data = '<option value="">Select Program type</option>';
    opttags($res, $data);
}

if (isset($_POST['delylvl'])) {
    $sql = "DELETE
     FROM
         `program_year`
     WHERE
         `Program_year_id` = '$pyid'";
    $res = affected($sql);
    if ($res) {
        addlogs("Deleted a year level");
    }
    echo (($res) ? 'success' : 'Error While Adding');
}



if (isset($_POST['addylvl'])) {
    $progtype = ((isset($_POST['progtype'])) ? $_POST['progtype'] : "");
    $prog = "SELECT `Program_code`
    FROM
    `program_list` WHERE `Program_list_id`='$progid'";
    $pres = mysqli_fetch_array(execquery($prog))[0];
    $yl = "SELECT `Year_level` FROM `year_level` WHERE `year_level_id` = '$ylid'";
    $yres = mysqli_fetch_array(execquery($yl))[0];
    $sql = "INSERT INTO `program_year`(
        `ProgStatus_id`,
        `Program_list_id`,
        `Year_level_id`
    )
    VALUES(
        '$progtype',
        '$progid',
        '$ylid'
    )";
    $res = affected($sql);
    if ($res) {
        addlogs("Added a year level on a program: " . $pres . ", Year Level added: " . $yres);
    }
    echo (($res) ? 'success' : 'Error While Adding');
}

if (isset($_POST['setylvls'])) {
    $sql = "SELECT
    yl.year_level_id,
    yl.Year_level
FROM
    `year_level` yl
WHERE
    NOT EXISTS (SELECT * FROM program_year py 
    WHERE py.Year_level_id=yl.year_level_id AND py.Program_list_id='$progid')";
    $res = execquery($sql);
    $data = '<option value="">Select Year lvl</option>';
    opttags($res, $data);
}

if (isset($_POST['setprograms'])) {
    $sql = "SELECT pl.Program_list_id,pl.Program_code FROM `program_list` pl ORDER BY pl.Program_list_id ASC";
    $res = execquery($sql);
    $data = '<option value="">Select Program</option>';
    opttags($res, $data);
}

if (isset($_POST['setpgs'])) {

    $sql = "SELECT COUNT(*) FROM
    `program_year` py
    LEFT JOIN year_level yl ON
    py.Year_level_id = yl.year_level_id
    WHERE 1 AND py.Program_list_id='$progid' $search $progtype";
    /* echo $sql; */

    pgs($sql, $entries);
}

if (isset($_POST['settb'])) {
    if ($page == "" || $page == "0") {
        $page = '0';
    } else {
        $page = ceil($page * $entries);
    }
    $limit = "LIMIT $page,$entries";

    $data = "";
    $sql = "SELECT
    py.Program_year_id,
    yl.Year_level,
    (SELECT COUNT(*) FROM program_year_sections pys WHERE pys.Program_year_id=py.Program_year_id)
    FROM
        `program_year` py
    LEFT JOIN year_level yl ON
    py.Year_level_id = yl.year_level_id
    WHERE 1 AND py.Program_list_id='$progid'
    $search
    $progtype
     ORDER BY yl.year_level_id ASC $limit  ";

    /* echo $sql; */
    $res = execquery($sql);
    $numrows = mysqli_num_rows($res);
    $cnt = 1;
    if ($numrows > 0) {

        $data .= '
    <thead>
        <tr>
            <th>#</th>
            <th>Year Lvl</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3"> <button onclick="setupaddylvl(this);" class="btn btn-sm btn-primary">Add Year lvl</button></td>
        </tr>
    ';
        while ($r = mysqli_fetch_array($res)) {
            $data .= '    <tr>
        <td class="border">' . $cnt . '</td>
        <td class="border">' . $r[1] . '</td>
        <td id="'.$r[0].'">
        ' . ((!$r[2]) ? '<button value="' . $r[0] . '" onclick="delylvl(this);" class="btn btn-sm btn-danger">Delete</button>' : '') . '
        </td>
    </tr>';
            $cnt++;
        }

        $data .= '</tbody>';
    } else {
        $data .= '<tbody>
    <tr>
            <td colspan="3"> <button onclick="setupaddylvl(this);" class="btn btn-sm btn-primary">Add Year lvl</button></td>
        </tr>
    <tr>
        <td colspan="3" class="fs-3">No Year lvl Found!</td>
    </tr>
    </tbody>
    ';
    }


    echo  $data;
}
