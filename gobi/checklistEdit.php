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
$queryC = "SELECT CHECKLISTID, GEOLOCATION, CHECKLISTNOTE, WORKSPACEID, PROJECTID, CHECKLISTNAME, USERID, DUETIME, TIMEFLAG, LASTUPDATE, 
    DUEDATE, STATUS, PRIORITY, TAG
    FROM CHECKLIST WHERE CHECKLISTID = 2";

$result = $mysqli->query($queryC);

 //associative and numeric array 
$row = $result->fetch_array(MYSQLI_ASSOC);
printf ("%s %s %s %s %s %s %s %s %s %s %s %s \n", $row["USERID"], $row["WORKSPACEID"], 
        $row["PROJECTID"], $row["CHECKLISTNAME"], $row["CHECKLISTNOTE"], $row["DUEDATE"], 
        $row["DUETIME"], $row["STATUS"], $row["TIMEFLAG"],$row["PRIORITY"],
        $row["GEOLOCATION"], $row["TAG"]);
?>

<body>
        <form name="input" action="checklistEditJSON.php" method="get" id="editChecklist">
        USER ID: <input type="text" name="userid" value ="<?php echo $row["USERID"]?>"><br>
        PROJECT ID: <input type="text" name="projectid" value ="<?php echo $row["PROJECTID"]?>"><br>
        WORKSPACE ID: <input type="text" name="workspaceid" value ="<?php echo $row["WORKSPACEID"]?>"><br>
        CHECKLIST NAME: <input type="text" name="checklistname" value ="<?php echo $row["CHECKLISTNAME"]?>"><br>
        CHECKLIST NOTE: <input type="text" name="checklistnote" value ="<?php echo $row["CHECKLISTNOTE"]?>"><br>
        PRIORITY: <input type="text" name="priority" value ="<?php echo $row["PRIORITY"]?>"><br>
        DUE DATE: <input type="date" name="duedate" value ="<?php echo $row["DUEDATE"]?>"><br>
        DUE TIME: <input type="time" name="duetime" value ="<?php echo $row["DUETIME"]?>"><br>
        STATUS: <input type="text" name="status" value ="<?php echo $row["STATUS"]?>"><br>
        TIME FLAG: <input type="text" name="timeflag" value ="<?php echo $row["TIMEFLAG"]?>"><br>
        GEO LOCATION: <input type="text" name="geolocation" value ="<?php echo $row["GEOLOCATION"]?>"><br>
        TAG: <input type="text" name="tag" value ="<?php echo $row["TAG"]?>"><br>        
        

        <input type="button" onclick="var e = document.getElementById('editChecklist'); e.action='checklistEditJSON.php'; e.submit();" value="EDITJSON">
        
        
        </form>

    </body>

<?php
/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

    
