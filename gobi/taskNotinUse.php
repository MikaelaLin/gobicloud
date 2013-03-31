<?php

//connect to the database
/*if (!isset($_POST["userid"]) || !isset($_POST["projectid"]) || !isset($_POST["workspaceid"]) || 
        !isset($_POST["taskname"]) || !isset($_POST["tasknote"]) || !isset($_POST["priority"]) || 
        !isset($_POST["duedate"]) || !isset($_POST["duetime"]) || !isset($_POST["status"])
        || !isset($_POST["timeflag"]) || !isset($_POST["geolocation"]) || !isset($_POST["tag"])
        ) {
    echo "Go away nothing to see here";
    exit();
}
 */

if (!isset($_GET["taskname"]) || !isset($_GET["tasknote"]) || !isset($_GET["priority"]) || 
        !isset($_GET["duedate"]) || !isset($_GET["duetime"]) || !isset($_GET["geolocation"]) || 
        !isset($_GET["tag"]) || !isset($_GET["workspaceid"]) || !isset($_GET["userid"])
        || !isset($_GET["timeflag"]) || !isset($_GET["status"]) || !isset($_GET["projectid"])
        ) {
    echo "Go away nothing to see here";
    exit();
}

$con=mysqli_connect("localhost","root","","GOBI_DB");
// Check connection

//$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// set up values to insert
$taskName = $_POST["taskname"];
$workpsaceID =$_POST['workspaceid'];
$priority = $_POST['userid'];
$duedDate = $_POST['duedate'];
$timeFlag = $_POST['timeflag'];
$status = $_POST['status'];
$geoLocation =$_POST['geolocation'];
$tag = $_POST['tag'];
$projectID = $_POST['projectid'];
$taskNote = $_POST['tasknote'];
$duetime = $_POST['duetime'];
$userID = $_POST['userid'];


$sql="INSERT INTO TASK (TASKID, TASKNAME, WORKSPACEID, PRIORITY, USERID, DUEDATE,TIMEFLAG, 
    STATUS, GEOLOCATION, TAG, PROJECTID, LASTUPDATE, TASKNOTE, DUETIME)
VALUES
('',$taskName,$workpsaceID,$priority,$userID,$duedDate,$timeFlag,$status,$geoLocation,$tag,$projectID,'',$taskNote, $duetime)";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error());
  }
echo "1 record added";

mysqli_close($con);
?>


?>
