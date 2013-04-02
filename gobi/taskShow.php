<?php

//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");
session_start();
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
        ?> 

<p><?php printf ("%s %s %s\n", $row["TASKID"], $row["TASKNAME"], $row["DUEDATE"]);?>
<form action ="editTask.php" ><input type="submit" value="EDIT" /></p>
<?php endwhile; ?>
<?php
/* free result set */
$result->free();
/* close connection */
$mysqli->close();
?>


