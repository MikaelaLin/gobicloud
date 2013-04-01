
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

    /* encode array into JSON for phone and echo it */
    echo json_encode($arr);

    //printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* get the values to be inserted */
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


/* create a prepared statement */
$sql1 = "INSERT INTO TASK (TASKID, TASKNAME, WORKSPACEID, PRIORITY, USERID, 
    DUEDATE, TIMEFLAG, STATUS, GEOLOCATION, TAG, PROJECTID, LASTUPDATE, TASKNOTE, 
    DUETIME)VALUES ('', '$taskName', '$workspaceID', '$taskPriority', '$userID',
        '$dueDate', '$timeFlag', '$status', '$geolocation', '$tag', '$projectID', CURRENT_TIMESTAMP, '$taskNote', '$dueTime')";
if ($stmt = $mysqli->prepare($sql1)) {
    $stmt->execute();
    
    $stmt->bind_param("isiiisiississs", '',$taskName,$workspaceID, $taskPriority, $userID,
        $dueDate, $timeFlag, $status, $geolocation, $tag, $projectID, CURRENT_TIMESTAMP, $taskNote, $dueTime );
    /* execute prepared statement */
    //$stmt->execute();

    /* if a row was added */
    if ($stmt->affected_rows == 1) {
        /* check to see what the id is and timestamp */
        $id = $stmt->insert_id;

        /* create a prepared statement to get the timestamp */
        if ($substmt = $mysqli->prepare("SELECT LastUpdate FROM TASK WHERE TASKID = ?")) {

            /* bind the id */
            $substmt->bind_param("i", $id);

            /* execute prepared statement */
            $substmt->execute();

            /* bind result variables */
            $substmt->bind_result($timestamp);

            $substmt->fetch();
            /* write success, sample id and timestamp to array for JSON */
            $arr = array('TASKID' => $id, 'LASTUPDATE' => $timestamp);

            /* echo JSON of the array for the phone */
            echo json_encode($arr);
            
            /* close statement */
            $substmt->close();
        }
    }

    /* close statement*/
    $prepare->close();
}

/* close connection */
$mysqli->close();
?>




<!DOCTYPE html>
<html><form action =" editTask.php"><input type="submit" value="SHOW TASK" /></form></html>