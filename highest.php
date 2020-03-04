<?php
    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
    if ($conn-> connect_error){
      die("connection failed:" . $conn-> connect_error);
     }

     $count= "SELECT contender FROM `highest`  ORDER BY highestvotes DESC LIMIT 0,1 ";

if($sql= mysqli_query($conn, $count)){
        if (mysqli_num_rows($sql) > 0){
            while ($row = mysqli_fetch_array($sql)){
                echo $row['contender'];
        }
    }
                
    }

$conn->close();
?>