<?php

session_start();

$_SESSION['50mights6334'] = sha1(microtime());

 $conn = mysqli_connect ("localhost", "root", "", "campusmights");

 
if ($conn===false) {
die("Connection failed: " . mysqli_connect_error());
                    }
                     
if ( !isset($_POST['username'], $_POST['password']) ) {
    
     die ('Please fill both the username and password field!');
}              
    
if ($stmt = $conn->prepare('SELECT id, passkey FROM userlogin WHERE user = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $passkey);
        $stmt->fetch();
       
        if ($_POST['password'] === $passkey) {
            
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header("Location:dashboard.php");
        } else {
            header("Location:login.php");
            echo '<script> 
           getElementById("demo").innerText = Incorrect Password!;
          
             </script>';
            
           
        }
    } else {
        header("Location:login.php");
        echo '<script>  var x = getElementById("demo");
        x.innerText= Incorrect Username!;</script>';
        
    }
    
	$stmt->close();
}
?>