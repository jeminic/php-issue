<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://use.fontawesome.com/965f72fa27.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

   
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="row header">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h1 style="font-size: 30px; color: white; margin-bottom: 0; margin-top: 10px; ">Dashboard</h1>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 navContainer">
                        <div class="navbarItems">
                            <a href="#home">Home</a>
                            <a href="#news">Check Results</a>
                            <div class="dropdown">
                                <button class="dropbtn">username<i class="fa fa-caret-down"></i></button>
                                <div class="dropdown-content">
                                    <a href="logout.php">Log out</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contentContainer">
                <div class="row cardsContainer">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " style=" padding-bottom: 10px;">
                        <div class="cards ">
                            <p>Number of Votes</p>
                            <hr style="background-color: white; ">
                            <i class="fa fa-thumbs-up " aria-hidden="true "></i>
                            <h2> <?php include 'totalvotes.php' ?> </h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="padding-bottom: 10px; ">
                        <div class="cards amount ">
                            <p>Total Amount Raised</p>
                            <hr style="background-color: rgb(0, 0, 0); ">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <h2> <?php include 'totalamount.php' ?> </h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="padding-bottom: 10px; ">
                        <div class="cards ">
                            <p>Number of contenders</p>
                            <hr style="background-color: white; ">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <h2> <?php include 'totalcontender.php' ?> </h2>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="padding-bottom: 10px; ">
                        <div class="cards ">
                            <p>Highest contender</p> 
                            <p style="margin-top:-10px; color: rgb(255, 188, 0); font-weight: 700;"> 
                                <?php include 'highest.php' ?> </p>
                            <hr style="background-color: white;">
                            <p>Lowest contender</p> 
                            <p style="margin-top:-10px; color: rgb(255, 188, 0); font-weight: 700;"> <?php include 'lowest.php' ?> </p>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="row secondRow">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">

                        <div class="formCard">
                            <p>Enter Contenders Details </p>
                            <hr style="background-color: rgb(136, 136, 136); margin-bottom: 50px;">
                            <form action="function.php" method="post" enctype="multipart/form-data"> 
                                <input type="text" name="firstname" placeholder="enter first name here" required class="inputDetails">
                                <input type="text" name="lastname" placeholder="enter last name here" required class="inputDetails">
                                <input type="text" name="institution" placeholder="enter institution here" required class="inputDetails">
                                <input type="text" name="department" placeholder="enter department here" required class="inputDetails">
                                <input type="text"  name="level" placeholder="enter level here" required class="inputDetails" >
                                <input type="file" name="picture" required class="uploadedFile"/>
                                <input type="submit" class="btn-submit" value="submit"/>
                            </form>
                                                      
                        </div>
                            
                   </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                        <div class="listCards ">
                       

                            <table class="table tabular table-responsive-sm table-responsive-xs">
                                <thead>
                                    <tr>
                                        <th class="col-xs-3">Picture</th>
                                        <th class="col-xs-6">Full Name</th>
                                        <th class="col-xs-6">Institution</th>
                                        <th class="col-xs-3">Department</th>
                                        <th class="col-xs-3">Level</th>
                                        <th class="col-xs-3">Votes</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>

                                <?php
                                    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
                                    if ($conn-> connect_error){
                                        die("connection failed:" . $conn-> connect_error);
                                    }

                                    $sql = "SELECT contenders.PICTURE, contenders.FULL_NAME, contenders.INSTITUTION, contenders.DEPARTMENT, contenders.CONT_LEVEL, totalvotes.TOTAL_VOTES  FROM contenders 
                                            LEFT JOIN  totalvotes ON contenders.ID = totalvotes.CONT_VOTED";                              
                                              
                               
                                    $result = $conn-> query ($sql);
 
                                    if ($result-> num_rows > 0){
                                        
                                        while ($row = $result -> fetch_assoc()){
                                                   


                                            echo "<tr><td>" . "<img src= '  $row[PICTURE]   '>"  . "</td><td>". $row["FULL_NAME"] . "</td><td>" . $row["INSTITUTION"] . "</td><td>" . $row["DEPARTMENT"] . "</td><td>" . $row["CONT_LEVEL"].  "</td><td>" . $row["TOTAL_VOTES"].  "</td></tr>" ;
                                        }
                                        echo "</table>";
                                        // echo '<script>  alert(" New contender Added succesfully") </script>';
  
                                    }
                                    else {
                                       
                                        
                                        echo '<script> alert("0 results") </script>';
                                    }
                                   $conn-> close();
                                    ?>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>

                           




