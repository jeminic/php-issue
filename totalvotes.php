<?php
    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
    if ($conn-> connect_error){
      die("connection failed:" . $conn-> connect_error);
     }

$sql= "SELECT SUM(TOTAL_VOTES) AS value_sum FROM totalvotes"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["value_sum"];
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>