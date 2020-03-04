<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["picture"]["name"];
        $filetype = $_FILES["picture"]["type"];
        $filesize = $_FILES["picture"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("img/" . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["picture"]["tmp_name"], "img/" . $filename);
                echo '<script> alert("Your file was uploaded successfully").</script>';
            } 
        } else{
            echo '<script> alert( "Error: There was a problem uploading your file. Please try again.").</script>'
           ; 
        }
    } else{
        echo '<script> alert( ""Error: " . $_FILES["picture"]["error"]").</script>'
        ;
    }
}
                    $conn = mysqli_connect ("localhost", "root", "", "campusmights");

                     // Check connection
                    if ($conn===false) {
                     die("Connection failed: " . mysqli_connect_error());
                    }
                    $img = "img/" . $filename;
                        
                    $sql = "INSERT INTO contenders ( PICTURE, FULL_NAME, INSTITUTION, DEPARTMENT, CONT_LEVEL) 
                    VALUES (?, ?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "sssss", $picture, $full_name, $institution, $department, $level);
                        echo "Records inserted successfully.";
                        $picture = "img/" . $filename;
                        $first_name =  $_REQUEST['firstname'];
                        $last_name =  $_REQUEST['lastname'];
                        $full_name = $first_name . " " . $last_name;
                        $institution =  $_REQUEST['institution'];
                        $department= $_REQUEST['department'];
                        $level=  $_REQUEST['level'];
                     
                    if(mysqli_stmt_execute($stmt)){
                        echo "Records inserted successfully";
                        header("Location:dashboard.php");

                    }
                        
                    } else{
                        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    ?>