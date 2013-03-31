<?php

//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  
    exit();
}

$query = "SELECT TASKID, TASKNAME, DUEDATE FROM TASK";
$result = $mysqli->query($query);


/* free result set */
$result->free();
//$_SESSION['taskID'] = $_GET($row["TASKID"])
/* close connection */
$mysqli->close();
?>