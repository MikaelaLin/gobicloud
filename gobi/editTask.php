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
    DUEDATE, DUETIME, STATUS, TIMEFLAG, GEOLOCATION, TAG FROM TASK WHERE TASKID=10";
$result = $mysqli->query($query);


 //associative and numeric array 
$row = $result->fetch_array(MYSQLI_ASSOC);
printf ("%s %s %s %s %s %s %s %s %s %s %s %s \n", $row["USERID"], $row["PROJECTID"], 
        $row["WORKSPACEID"], $row["TASKNAME"], $row["TASKNOTE"], $row["PRIORITY"], 
        $row["DUEDATE"], $row["DUETIME"], $row["STATUS"],$row["TIMEFLAG"],
        $row["GEOLOCATION"], $row["TAG"]);

/*$userID = $row["USERID"];
$projectID = $row["PROJECTID"];
$workspaceID = $row["WORKSPACEID"];
$taskName = $row["TASKNAME"];
$taskNote = $row["TASKNOTE"];
$priority = $row["PRIORITY"];
$dueDate = $row["DUEDATE"];
$dueTime = $row["DUETIME"];
$status = $row["STATUS"];
$timeFlag = $row["TIMEFLAG"];
$geolocation = $row["GEOLOCATION"];
$tag = $row["TAG"];*/
?>
<body>
        <form name="input" action="commitChange.php" method="get">
        USER ID: <input type="text" name="userid1" value ="<?php echo $row["USERID"]?>"><br>
        PROJECT ID: <input type="text" name="projectid1" value ="<?php echo $row["PROJECTID"]?>"><br>
        WORKSPACE ID: <input type="text" name="workspaceid1" value ="<?php echo $row["WORKSPACEID"]?>"><br>
        TASK NAME: <input type="text" name="taskname1" value ="<?php echo $row["TASKNAME"]?>"><br>
        TASK NOTE: <input type="text" name="tasknote1" value ="<?php echo $row["TASKNOTE"]?>"><br>
        PRIORITY: <input type="text" name="priority1" value ="<?php echo $row["PRIORITY"]?>"><br>
        DUE DATE: <input type="date" name="duedate1" value ="<?php echo $row["DUEDATE"]?>"><br>
        DUE TIME: <input type="time" name="duetime1" value ="<?php echo $row["DUETIME"]?>"><br>
        STATUS: <input type="text" name="status1" value ="<?php echo $row["STATUS"]?>"><br>
        TIME FLAG: <input type="text" name="timeflag1" value ="<?php echo $row["TIMEFLAG"]?>"><br>
        GEO LOCATION: <input type="text" name="geolocation1" value ="<?php echo $row["GEOLOCATION"]?>"><br>
        TAG: <input type="text" name="tag1" value ="<?php echo $row["TAG"]?>"><br>        
        <input type="submit" value="Submit" />
        </form>

    </body>

<?php
/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>


