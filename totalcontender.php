<?php
    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
    if ($conn-> connect_error){
      die("connection failed:" . $conn-> connect_error);
     }
$count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM contenders"));
 
echo $count;

mysqli_close($conn);
?>