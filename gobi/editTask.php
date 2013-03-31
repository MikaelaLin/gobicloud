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


$query = "SELECT USERID, PROKECTID, WORKSPACEID, TASKNAME, TASKNOTE, PRIORITY, 
    DUEDATE, DUETIME, STATUS, TIMEFLAG, GEOLOCATION, TAG FROM TASK WHERE ID=";
$result = $mysqli->query($query);


/* associative and numeric array */
$row = $result->fetch_array(MYSQLI_BOTH);
printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

?>
