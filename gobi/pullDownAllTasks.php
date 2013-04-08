
<?php

//connect to the database
$mysqli = new mysqli("localhost", "root", "", "GOBI_DB");

/* check connection */
if (mysqli_connect_errno()) {
    /* cannot connect to database, write fail to array */
    $arr = array('Result' => 'FailDB');
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    /* encode array into JSON for phone and echo it */
    echo json_encode($arr);
    exit();
}


$sql = "SELECT *
    FROM TASK";

   $result = $mysqli->query($sql);
   //var_dump($result);
   $mysqli->commit();
 
      
 $taskArray = array();
 $i = 0;
 
 /*get all the rows into one array*/
   while($row = $result->fetch_array(MYSQLI_ASSOC)){
       $taskArray[$i] = $row;
       $i++;
  
   }

 $taskArray[] = array('Result'=>'Success');
echo json_encode($taskArray);

/* close connection */
$mysqli->close();


//read data from it


?>

