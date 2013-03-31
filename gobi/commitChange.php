
<?php

echo "im in commit change page \n";
if (!isset($_GET["taskname1"]) || !isset($_GET["tasknote1"]) || !isset($_GET["priority1"]) || 
        !isset($_GET["duedate1"]) || !isset($_GET["duetime1"]) || !isset($_GET["geolocation1"]) || 
        !isset($_GET["tag1"]) || !isset($_GET["workspaceid1"]) || !isset($_GET["userid1"])
        || !isset($_GET["timeflag1"]) || !isset($_GET["status1"]) || !isset($_GET["projectid1"])
        ) {
    echo "Go away nothing to see here";
    exit();
}
//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */
   
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
 
    exit();
}
// set up values to insert
$taskName = $_GET["taskname1"];

$taskNote= $_GET["tasknote1"];
$taskPriority= $_GET["priority1"];
$dueDate = $_GET["duedate1"];
$dueTime = $_GET["duetime1"];
$geolocation = $_GET["geolocation1"];
$tag = $_GET["tag1"];
$workspaceID = $_GET["workspaceid1"];
$userID = $_GET["userid1"];
$timeFlag= $_GET["timeflag1"];
$status = $_GET["status1"];
$projectID = $_GET["projectid1"];
//add data to Task table

if($mysqli->query("UPDATE TASK SET TASKNAME='$taskName', WORKSPACEID='$workspaceID',
    PRIORITY='$taskPriority', USERID='$userID', DUEDATE='$dueDate', TIMEFLAG='$timeFlag',
    STATUS='$status', GEOLOCATION='$geolocation', TAG='$tag', PROJECTID='$projectID',
    LASTUPDATE=CURRENT_TIMESTAMP, TASKNOTE='$taskNote', DUETIME='$dueTime'
    WHERE TASKID=10)")){
    $mysqli->commit();}
    else{
    die('Could not update data: ' . $mysqli->error);
    };
    echo "Updated data successfully\n";
     
//mysql_select_db('GOBI_DB');
//$retval = mysql_query( $sql, $conn );
/*if (!$mysqli->query("UPDATE TASK SET TASKNAME='$taskName', WORKSPACEID='$workspaceID',
    PRIORITY='$taskPriority', USERID='$userID', DUEDATE='$dueDate', TIMEFLAG='$timeFlag',
    STATUS='$status', GEOLOCATION='$geolocation', TAG='$tag', PROJECTID='$projectID',
    LASTUPDATE=CURRENT_TIMESTAMP, TASKNOTE='$taskNote', DUETIME='$dueTime'
    WHERE TASKID=10)")) {
    trigger_error($mysqli->error);
    }else $mysqli->commit();*/
  
echo " update is done";
/* close connection */
$mysqli->close();


//read data from it


?>

