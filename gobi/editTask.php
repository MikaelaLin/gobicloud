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


$query = "SELECT USERID, PROJECTID, WORKSPACEID, TASKNAME, TASKNOTE, PRIORITY, 
    DUEDATE, DUETIME, STATUS, TIMEFLAG, GEOLOCATION, TAG FROM TASK WHERE TASKID=3";
$result = $mysqli->query($query);


 //associative and numeric array 
$row = $result->fetch_array(MYSQLI_ASSOC);
printf ("%s %s %s %s %s %s %s %s %s %s %s %s \n", $row["USERID"], $row["PROJECTID"], 
        $row["WORKSPACEID"], $row["TASKNAME"], $row["TASKNOTE"], $row["PRIORITY"], 
        $row["DUEDATE"], $row["DUETIME"], $row["STATUS"],$row["TIMEFLAG"],
        $row["GEOLOCATION"], $row["TAG"]);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>


