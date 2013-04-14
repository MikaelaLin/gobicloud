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

$queryCe = "SELECT CHECKLISTID, GEOLOCATION, CHECKLISTNOTE, WORKSPACEID, PROJECTID, CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, 
    DUEDATE, STATUS, PRIORITY, TAG
    FROM CHECKLIST WHERE CHECKLISTID = (SELECT MAX(CHECKLISTID) FROM CHECKLIST)";

$resultCe = $mysqli->query($queryCe);

//associative and numeric array 
$row = $resultCe->fetch_array(MYSQLI_ASSOC);
printf ("%s %s %s %s %s %s %s %s %s %s %s %s %s %s \n", $row["CHECKLISTID"], $row["GEOLOCATION"], 
        $row["CHECKLISTNOTE"], $row["WORKSPACEID"], $row["PROJECTID"], $row["CHECKLISTNAME"], 
        $row["USERID"], $row["DUETIME"], $row["TIMEFLAG"],$row["LASTUPDATE"],
        $row["DUEDATE"], $row["STATUS"],$row["PRIORITY"],$row["TAG"]);
?>

<body>
        <form name="input" action="checklistEditDisplayJSON.php" method="get" id="checklistEdit">
        CHECKLIST ID: <input type="text" name="checklistid" value ="<?php echo $row["CHECKLISTID"]?>"><br>
        GEO LOCATION: <input type="text" name="geolocation" value ="<?php echo $row["GEOLOCATION"]?>"><br>
        CHECKLIST NOTE: <input type="text" name="checklistnote" value ="<?php echo $row["CHECKLISTNOTE"]?>"><br>
        WORKSPACE ID: <input type="text" name="workspaceid" value ="<?php echo $row["WORKSPACEID"]?>"><br>
        PROJECT ID: <input type="text" name="projectid" value ="<?php echo $row["PROJECTID"]?>"><br>
        CHECKLIST NAME: <input type="text" name="checklistname" value ="<?php echo $row["CHECKLISTNAME"]?>"><br>
        USER ID: <input type="text" name="userid" value ="<?php echo $row["USERID"]?>"><br>
        DUE TIME: <input type="text" name="duetime" value ="<?php echo $row["DUETIME"]?>"><br>
        TIME FLAG: <input type="text" name="timeflag" value ="<?php echo $row["TIMEFLAG"]?>"><br>
        LAST UPDATE: <input type="text" name="lastupdate" value ="<?php echo $row["LASTUPDATE"]?>"><br>
        DUE DATE: <input type="text" name="duedate" value ="<?php echo $row["DUEDATE"]?>"><br>
        STATUS: <input type="text" name="status" value ="<?php echo $row["STATUS"]?>"><br>
        PRIORITY: <input type="text" name="priority" value ="<?php echo $row["PRIORITY"]?>"><br>
        TAG: <input type="text" name="tag" value ="<?php echo $row["TAG"]?>"><br>
        
        <input type="submit" value="Submit">
        
        </form>

    </body>
    
    <?php
/* free result set */
$resultCe->free();

/* close connection */
$mysqli->close();
?>


