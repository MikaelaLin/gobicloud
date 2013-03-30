<?php

//connect to the database

$mysqli = new mysqli("localhost", "root", "password", "GOBI_DB");

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

//add data to Task table
/* create a prepared statement */
if ($insertData = $mysqli->prepare("INSERT INTO samples TASK ()")) {

    /* bind parameters for markers */
    $insertData->bind_param("sssdidis", $locationID, $staffID, $time, $pH, $EC, $temp, $TDS, $description);

    /* execute prepared statement */
    $insertData->execute();

    /* if a row was added */
    if ($insertData->affected_rows == 1) {
        /* check to see what the id is and timestamp */
        $id = $insertData->insert_id;

        /* create a prepared statement to get the timestamp */
        if ($substmt = $mysqli->prepare("SELECT LastUpdate FROM samples WHERE SampleID = ?")) {

            /* bind the id */
            $substmt->bind_param("i", $id);

            /* execute prepared statement */
            $substmt->execute();

            /* bind result variables */
            $substmt->bind_result($timestamp);

            $substmt->fetch();
            /* write success, sample id and timestamp to array for JSON */
            $arr = array('Result' => 'Success', 'SampleID' => $id, 'LastUpdate' => $timestamp);

            /* echo JSON of the array for the phone */
            echo json_encode($arr);
            
            /* close statement */
            $substmt->close();
        }
    }

    /* close statement*/
    $insertData->close();
}

/* close connection */
$mysqli->close();

//read data from it


?>
