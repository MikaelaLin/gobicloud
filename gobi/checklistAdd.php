<?php

echo "im in ";
if (!isset($_GET["userid"]) || !isset($_GET["workspaceid"]) || !isset($_GET["projectid"]) || 
        !isset($_GET["checklistname"]) || !isset($_GET["checklistnote"]) || !isset($_GET["duedate"]) || 
        !isset($_GET["duetime"]) || !isset($_GET["status"]) || !isset($_GET["timeflag"])
        || !isset($_GET["priority"]) || !isset($_GET["geolocation"]) || !isset($_GET["tag"])
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
$CuserID = $_GET["userid"];
$CworkspaceID= $_GET["workspaceid"];
$CprojectID= $_GET["projectid"];
$checklistName = $_GET["checklistname"];
$checklistNote = $_GET["checklistnote"];
$CdueDate = $_GET["duedate"];
$CdueTime = $_GET["duetime"];
$Cstatus = $_GET["status"];
$Ctimeflag = $_GET["timeflag"];
$Cpriority= $_GET["priority"];
$Cgeolocation = $_GET["geolocation"];
$Ctag = $_GET["tag"];


$sqlC = "SELECT CHECKLISTID, GEOLOCATION, CHECKLISTNOTE, WORKSPACEID, PROJECTID, CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, 
    DUEDATE, STATUS, PRIORITY, TAG
    FROM CHECKLIST WHERE CHECKLISTID = (SELECT MAX(CHECKLISTID) FROM CHECKLIST)";

//add data to CHECKLIST table
if($mysqli->query("INSERT INTO CHECKLIST (CHECKLISTID, GEOLOCATION, CHECKLISTNOTE, WORKSPACEID, PROJECTID, 
    CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, DUEDATE, STATUS, PRIORITY, 
    TAG)VALUES ('', '$Cgeolocation', '$checklistNote', '$CworkspaceID', '$CprojectID',
    '$checklistName', '$CuserID', '$CdueTime', '$Ctimeflag', CURRENT_TIMESTAMP, '$CdueDate', '$Cstatus', '$Cpriority','$Ctag')")){
   $mysqli->commit();

//GET ID AND TIMESTAMP
   $result = $mysqli->query($sqlC);
   //var_dump($result);
   $mysqli->commit();
   $row = $result->fetch_array(MYSQLI_ASSOC);
   
   
   $checklist_id = $row["CHECKLISTID"];
   $c_geolocation = $row["GEOLOCATION"];
   $checklist_note = $row["CHECKLISTNOTE"];
   $c_workspaceid = $row["WORKSPACEID"];
   $c_projectid = $row["PROJECTID"];
   $checklist_name = $row["CHECKLISTNAME"];
   $c_userid = $row["USERID"];
   $c_duetime = $row["DUETIME"];
   $c_timeflag = $row["TIMEFLAG"];
   $c_lastupdate = $row["LASTUPDATE"];
   $c_duedate = $row["DUEDATE"];
   $c_status = $row["STATUS"];
   $c_priority = $row["PRIORITY"];
   $c_tag = $row["TAG"];
   
    }    
/* write success, CHECKLISTN INFO to array for JSON */
$Checklist = array('Result' => 'Success', 'CHECKLISTID' => $checklist_id, 'GEOLOCATION' => $c_geolocation, 'CHECKLISTNOTE' => $checklist_note, 
        'WORKSPACEID' => $c_workspaceid, 'PROJECTID' => $c_projectid, 'CHECKLISTNAME' => $checklist_name, 'USERID' => $c_userid, 
        'DUETIME' => $c_duetime, 'TIMEFLAG' => $c_timeflag, 'LASTUPDATE' => $c_lastupdate, 'DUEDATE' => $c_duedate,
        'STATUS' => $c_status,'PRIORITY' => $c_priority, 'TAG' => $c_tag,);

/* echo JSON of the array for the phone */
echo 'This array has taskid and lastupdate: '.$Checklist;

echo json_encode($Checklist);
 
echo "commit is done";

/* close connection */
$mysqli->close();


//read data from it


?>


<!DOCTYPE html>
<html>
    <form action =" checklistEditDisplay.php"><input type="submit" value="SHOW TASK" />
    </form>
</html>