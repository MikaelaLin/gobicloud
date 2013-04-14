
<?php

echo "im in delete task page \n";
//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");
/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */  
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}


if($mysqli->query("DELETE FROM TASK WHERE TASKID=8")){
    $mysqli->commit();}
    else{
    die('Could not update data: ' . $mysqli->error);
    };
    echo "Updated data successfully\n";
  
/* close connection */
$mysqli->close();


//read data from it


?>

