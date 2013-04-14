<?php

//checklistEditDisplayJSON.php

echo "im in ";
if (!isset($_GET["checklistid"]) || !isset($_GET["geolocation"])|| !isset($_GET["checklistnote"])
        || !isset($_GET["workspaceid"])|| !isset($_GET["projectid"])|| !isset($_GET["checklistname"])
        || !isset($_GET["userid"])|| !isset($_GET["duetime"])|| !isset($_GET["timeflag"])
        || !isset($_GET["lastupdate"])|| !isset($_GET["duedate"])|| !isset($_GET["status"])
        || !isset($_GET["priority"])|| !isset($_GET["tag"])) {
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

//set up values to insert
$checklistIDCe = $_GET["checklistid"];
$geolocationCe = $_GET["geolocation"];
$checklistNoteCe = $_GET["checklistnote"];
$workspaceIDCe = $_GET["workspaceid"];
$projectIDCe = $_GET["projectid"];
$checklistNameCe = $_GET["checklistname"];
$userIDCe = $_GET["userid"];
$dueTimeCe = $_GET["duetime"];
$timeFlagCe = $_GET["timeflag"];
$dueDateCe = $_GET["dueDate"];
$statusCe = $_GET["status"];
$priorityCe = $_GET["priority"];
$tagCe = $_GET["tag"];

//add data to CHECKLIST table
$sqlCedit = "SELECT CHECKLISTID, GEOLOCATION, CHECKLISTNOTE, WORKSPACEID, PROJECTID, 
    CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, DUEDATE, STATUS, PRIORITY, TAG
    FROM CHECKLIST WHERE CHECKLISTID = $checklistIDCe";

if($mysqli->query("UPDATE CHECKLIST SET GEOLOCATION='$geolocationCe',
    CHECKLISTNOTE='$checklistNoteCe', WORKSPACEID='$workspaceIDCe', PROJECTID='$projectIDCe', 
        CHECKLISTNAME='$checklistNameCe', USERID='$userIDCe', DUETIME='$dueTimeCe', TIMEFLAG='$timeFlagCe', 
            LASTUPDATE=CURRENT_TIMESTAMP, DUEDATE='$dueDateCe', STATUS='$statusCe', PRIORITY='$priorityCe',
                TAG = '$tagCe'
    WHERE CHECKLISTID = $checklistIDCe")) 
    {
    $mysqli->commit();

   $resultC = $mysqli->query($sqlCedit);
 //var_dump($resultC);
   $mysqli->commit();
   $row = $resultC->fetch_array(MYSQLI_ASSOC);
   $checklist_idC = $row["CHECKLISTID"];
   $geo_locationC = $row["GEOLOCATION"];
   $checklist_noteC = $row["CHECKLISTNOTE"];
   $workspace_idC = $row["WORKSPACEID"];
   $project_idC = $row["PROJECTID"];
   $checklist_nameC = $row["CHECKLISTNAME"];
   $user_idC = $row["USERID"];
   $due_timeC = $row["DUETIME"];
   $time_flagC = $row["TIMEFLAG"];
   $last_updateC = $row["LASTUPDATE"];
   $due_dateC = $row["DUEDATE"];
   $status_C = $row["STATUS"];
   $priority_C = $row["PRIORITY"];
   $tag_C = $row["TAG"];
  
   }
  $checklistE = array('Result' => 'Success', 'CHECKLISTID' => $checklist_idC, 
      'GEOLOCATION' => $geo_locationC, 'CHECKLISTNOTE' => $checklist_noteC, 
      'WORKSPACEID' => $workspace_idC, 'PROJECTID' => $project_idC, 
      'CHECKLISTNAME' => $checklist_nameC, 'USERID' => $user_idC, 
      'DUETIME' => $due_timeC, 'TIMEFLAG' => $time_flagC, 
      'LASTUPDATE' => $last_updateC, 'DUEDATE' => $due_dateC,
        'STATUS' => $status_C,'PRIORITY' => $priority_C, 'TAG' => $tag_C,);
/* echo JSON of the array for the phone */
echo 'This array has information about checklist: '.$checklistE;

echo json_encode($checklistE);


?>
