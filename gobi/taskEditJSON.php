<?php
//editJSON.php

echo "im in ";
if (!isset($_GET["taskname1"]) || !isset($_GET["tasknote1"]) || !isset($_GET["priority1"]) || 
        !isset($_GET["duedate1"]) || !isset($_GET["duetime1"]) || !isset($_GET["geolocation1"]) || 
        !isset($_GET["tag1"]) || !isset($_GET["workspaceid1"]) || !isset($_GET["userid1"])
        || !isset($_GET["timeflag1"]) || !isset($_GET["status1"]) || !isset($_GET["projectid1"])
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

// set up values to insert
$taskName = $_GET["taskname1"];
$taskNote= $_GET["tasknote1"];
$taskPriority= $_GET["priority1"];
$dueDate = $_GET["duedate1"];
$dueTime = $_GET["duetime1"];
$geolocation = $_GET["geolocation1"];
$tag = $_GET["tag1"];
$workspaceID = $_GET["workspaceid1"];
$userID = $_GET["userid1"];
$timeFlag= $_GET["timeflag1"];
$status = $_GET["status1"];
$projectID = $_GET["projectid1"];

//add data to Task table
$sqledit = "SELECT TASKID, TASKNAME, WORKSPACEID, PRIORITY, USERID, DUEDATE, TIMEFLAG, STATUS, GEOLOCATION, TAG, 
    PROJECTID, LASTUPDATE, TASKNOTE, DUETIME
    FROM TASK WHERE TASKID = (SELECT MAX(TASKID) FROM TASK)";

if($mysqli->query("UPDATE TASK SET TASKNAME='$taskName', WORKSPACEID='$workspaceID',
    PRIORITY='$taskPriority', USERID='$userID', DUEDATE='$dueDate', TIMEFLAG='$timeFlag',
    STATUS='$status', GEOLOCATION='$geolocation', TAG='$tag', PROJECTID='$projectID',
    LASTUPDATE=CURRENT_TIMESTAMP, TASKNOTE='$taskNote', DUETIME='$dueTime'
    WHERE TASKID = (SELECT MAX(TASKID) FROM TASK)"))
{
   $mysqli->commit();

 //GET ID AND TIMESTAMP
   $result = $mysqli->query($sqledit);
   //var_dump($result);
   $mysqli->commit();
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $Etask_id = $row["TASKID"];
   $Etask_name = $row["TASKNAME"];
   $Etask_workspaceid = $row["WORKSPACEID"];
   $Etask_priority = $row["PRIORITY"];
   $Etask_userid = $row["USERID"];
   $Etask_duedate = $row["DUEDATE"];
   $Etask_timeflag = $row["TIMEFLAG"];
   $Etask_status = $row["STATUS"];
   $Etask_geolocation = $row["GEOLOCATION"];
   $Etask_tag = $row["TAG"];
   $Etask_projectid = $row["PROJECTID"];
   $Etask_lastupdate = $row["LASTUPDATE"];
   $Etask_tasknote = $row["TASKNOTE"];
   $Etask_duetime = $row["DUETIME"];
     }
     
     /* write success, task id and timestamp to array for JSON */
$taskEdit = array('Result' => 'Success', 'TASKID' => $Etask_id, 'TASKNAME' => $Etask_name, 'WORKSPACEID' => $Etask_workspaceid, 
        'PRIORITY' => $Etask_priority, 'USERID' => $Etask_userid, 'DUEDATE' => $Etask_duedate, 'TIMEFLAG' => $Etask_timeflag, 
        'STATUS' => $Etask_status, 'GEOLOCATION' => $Etask_geolocation, 'TAG' => $Etask_tag, 'PROJECTID' => $Etask_projectid,
        'LASTUPDATE' => $Etask_lastupdate,'TASKNOTE' => $Etask_tasknote, 'DUETIME' => $Etask_duetime,);

/* echo JSON of the array for the phone */
echo 'This array has taskid and lastupdate: '.$taskEdit;

echo json_encode($taskEdit);

  
?>
