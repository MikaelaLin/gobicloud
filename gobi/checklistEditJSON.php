<?php
//This page is for commiting the changes which have done in checklistEdit.php page.

//checklistEditJSON.php

echo "im in ";
if (!isset($_GET["userid"]) || !isset($_GET["workspaceid"]) || !isset($_GET["projectid"]) || 
        !isset($_GET["checklistname"]) || !isset($_GET["checklistnote"]) || !isset($_GET["duedate"]) || 
        !isset($_GET["duetime"]) || !isset($_GET["status"]) || !isset($_GET["timeflag"])
        || !isset($_GET["timeflag"]) || !isset($_GET["priority"]) || !isset($_GET["geolocation"])
        ) {
    echo "Go away nothing to see here";
    exit();
}

//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */
   $arr = array('Result' => 'FailDB');
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* encode array into JSON for phone and echo it */
   echo json_encode($arr);

    //printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$userIDC = $_GET["userid"];
$workspaceIDC = $_GET["workspaceid"];
$projectIDC = $_GET["projectid"];
$checklistNameC = $_GET["checklistname"];
$checklistNoteC = $_GET["checklistnote"];
$dueDateC = $_GET["duedate"];
$dueTimeC = $_GET["duetime"];
$statusC = $_GET["status"];
$timeflagC = $_GET["timeFlag"];
$priorityC = $_GET["priority"];
$geolocationC = $_GET["geolocation"];

//add data to Task table
$sqleditC = "SELECT GEOLOCATION, CHECKLISTNOTE, PROJECTID, CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, DUEDATE,
    STATUS, PRIORITY, TAG
    FROM CHECKLIST WHERE CHECKLISTID = 2)";

if($mysqli->query("UPDATE CHECKLIST SET USERID ='$userIDC', WORKSPACEID='$workspaceIDC',
    PROJECTID = '$projectIDC', CHECKLISTNAME='$checklistNameC', CHECKLISTNOTE='$checklistNoteC', DUEDATE='$dueDateC',
    DUETIME = $dueTimeC, STATUS ='$statusC', TIMEFLAG ='$timeflagC', PRIORITY = '$priorityC',
    GEOLOCATION = '$geolocationC', LASTUPDATE = CURRENT_TIMESTAMP)
    WHERE CHECKLISTID=10")){
   $mysqli->commit();

    //GET ID AND TIMESTAMP
   $resultC = $mysqli->query($sqleditC);
   //var_dump($result);
   $mysqli->commit();
   $row = $resultC->fetch_array(MYSQLI_ASSOC);
   $Cchecklist_id = $row['CHECKLISTID'];
   $Cuser_id = $row['USERID'];
   $Cworkspace_id = $row['WORKSPACEID'];
   $Cproject_id = $row['PROJECTID'];
   $Cchecklist_name = $row['CHECKLISTNAME'];
   $Cchecklist_note = $row['CHECKLISTNOTE'];
   $Cdue_date = $row['DUEDATE'];
   $Cdue_time = $row['DUETIME'];
   $Csta_tus = $row['STATUS'];
   $Ctime_flag = $row['TIMEFLAG'];
   $Cpri_ority = $row['PRIORITY'];
   $Cgeo_location = $row['GEOLOCATION'];
   $Clast_update = $row['LASTUPDATE'];
   
    }
   
   /* write success, task id and timestamp to array for JSON */
$checklistEdit = array('Result' => 'Success', 'CHECKLISTID' => $Cchecklist_id, 'USERID' => $Cuser_id, 'WORKSPACEID' => $Cworkspace_id, 
        'PROJECTID' => $Cproject_id, 'CHECKLISTNAME' => $Cchecklist_name, 'CHECKLISTNOTE' => $Cchecklist_note, 'DUEDATE' => $Cdue_date, 
        'DUETIME' => $Cdue_time, 'STATUS' => $Csta_tus, 'TIMEFLAG' => $Ctime_flag, 'PRIORITY' => $Cpri_ority,
        'GEOLOCATION' => $Cgeo_location,'LASTUPDATE' => $Clast_update,);

/* echo JSON of the array for the phone */
echo 'This array has taskid and lastupdate: '.$checklistEdit;

echo json_encode($checklistEdit);

  
?>
