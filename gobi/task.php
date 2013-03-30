<?php

//connect to the database

$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */
   // $arr = array('Result' => 'FailDB');
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* encode array into JSON for phone and echo it */
   // echo json_encode($arr);

    //printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
// set up values to insert
$taskName = $Get["taskname"];
$taskNote= $Get["tasknote"];
$taskPriority= $Get["priority"];
$dueDate = $Get["duedate"];
$dueTime = $Get["duetime"];
$geolocation = $Get["geolocation"];
$tag = $Get["tag"];
$workspaceID = $Get["workspaceid"];
$userID = $Get["userid"];
$timeFlag= $Get["timeflag"];
$status = $Get["status"];
$projectID = $Get["projectid"];
$lastUpdate = $Get["lastUpdate"];
$taskID = null;

//add data to Task table
/* create a prepared statement */
if ($stmt = $mysqli->prepare("INSERT INTO TASK VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
echo "prep";
    /* bind parameters for markers */
    $stmt->bind_param("isiiisiississs", $taskID, $taskName, $workspaceID, $taskPriority, $userID, $dueDate, $timeFlag, $status, $geolocation, $tag, $projectID, $lastUpdate, $taskNote, $dueTime);   /* execute prepared statement */
    $stmt->execute();
    
    //check for error
    if (!$mysqli->query($stmt)) {
    trigger_error($mysqli->error);
}
    echo "executed ";
    /* close statement*/
    $stmt->close();
    echo "insertion worked ";
}else echo "insertion didn't work!";

/* close connection */
$mysqli->close();

//read data from it


?>
