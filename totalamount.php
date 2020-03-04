<?php
    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
    if ($conn-> connect_error){
      die("connection failed:" . $conn-> connect_error);
     }
     $count= "SELECT  SUM(AMOUNT_VOTED) AS value_sum
     FROM vote";

$result = $conn->query($count);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["value_sum"];
    }
} else {
    echo "0";
}
$conn->close();
?>