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
?>


<?php 
while($row = $result->fetch_array(MYSQLI_ASSOC)): //print all the task names and due dates
   // $taskID = $row["TASKID"];
  //  $_SESSION['taskID'] = $taskID;
        ?> 

<p><?php printf ("%s %s %s\n", $row["TASKID"], $row["TASKNAME"], $row["DUEDATE"]);?>
<form action ="editTask.php"<?php $_SESSION['taskID'] = $row["TASKID"]; ?> ><input type="submit" value="EDIT" /></p>
<?php endwhile; ?>
<?php
/* free result set */
$result->free();
//$_SESSION['taskID'] = $_GET($row["TASKID"])
/* close connection */
$mysqli->close();
?>


