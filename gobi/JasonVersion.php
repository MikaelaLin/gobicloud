<?php

//connect to the database
if (!isset($_GET["taskname"]) || !isset($_GET["tasknote"]) || !isset($_GET["priority"]) || 
        !isset($_GET["duedate"]) || !isset($_GET["duetime"]) || !isset($_GET["geolocation"]) || 
        !isset($_GET["tag"]) || !isset($_GET["workspaceid"]) || !isset($_GET["userid"])
        || !isset($_GET["timeflag"]) || !isset($_GET["status"]) || !isset($_GET["projectid"])
        ) {
    echo "Go away nothing to see here";
    exit();
}
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
$lastUpdate = $_GET["lastUpdate"];

echo 'show task name '.$_GET["taskname"].' ';

//add data to Task table
/* create a prepared statement */
if ($stmt = $mysqli->prepare("INSERT INTO TASK VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
echo "prep";
    /* bind parameters for markers */
    $stmt->bind_param("isiiisiississs", '', $taskName, $workspaceID, $taskPriority, $userID, $dueDate, $timeFlag, $status, $geolocation, $tag, $projectID, '', $taskNote, $dueTime);   
    /* execute prepared statement */
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
