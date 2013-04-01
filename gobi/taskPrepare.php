
<?php

echo "im in ";
if (!isset($_GET["taskname"]) || !isset($_GET["tasknote"]) || !isset($_GET["priority"]) || 
        !isset($_GET["duedate"]) || !isset($_GET["duetime"]) || !isset($_GET["geolocation"]) || 
        !isset($_GET["tag"]) || !isset($_GET["workspaceid"]) || !isset($_GET["userid"])
        || !isset($_GET["timeflag"]) || !isset($_GET["status"]) || !isset($_GET["projectid"])
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
$taskName = $_GET["taskname"];

$taskNote= $_GET["tasknote"];
$taskPriority= $_GET["priority"];
$dueDate = $_GET["duedate"];
$dueTime = $_GET["duetime"];
$geolocation = $_GET["geolocation"];
$tag = $_GET["tag"];
$workspaceID = $_GET["workspaceid"];
$userID = $_GET["userid"];
$timeFlag= $_GET["timeflag"];
$status = $_GET["status"];
$projectID = $_GET["projectid"];
//add data to Task table
$sql = "SELECT TASKID, LASTUPDATE FROM TASK WHERE TASKID = (SELECT MAX(TASKID) FROM TASK)";
if($mysqli->query("INSERT INTO TASK (TASKID, TASKNAME, WORKSPACEID, PRIORITY, USERID, 
    DUEDATE, TIMEFLAG, STATUS, GEOLOCATION, TAG, PROJECTID, LASTUPDATE, TASKNOTE, 
    DUETIME)VALUES ('', '$taskName', '$workspaceID', '$taskPriority', '$userID',
    '$dueDate', '$timeFlag', '$status', '$geolocation', '$tag', '$projectID', 
     CURRENT_TIMESTAMP, '$taskNote', '$dueTime')")){
   $mysqli->commit();
   
   //GET ID AND TIMESTAMP
   $result = $mysqli->query($sql);
   //var_dump($result);
   $mysqli->commit();
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $task_id = $row["TASKID"];
   $last_update = $row["LASTUPDATE"];
     
   }
    
    
/* write success, task id and timestamp to array for JSON */
$arr = array('Result' => 'Success', 'TASKID' => $task_id, 'LASTUPDATE' => $last_update);

/* echo JSON of the array for the phone */
echo 'This array has taskid and lastupdate: '.$arr;

echo json_encode($arr);
 





echo "commit is done";

/* close connection */
$mysqli->close();


//read data from it


?>


<!DOCTYPE html>
<html>
    <form action =" editTask.php"><input type="submit" value="SHOW TASK" />
    </form>
</html>