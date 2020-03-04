<?php include 'add.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://use.fontawesome.com/965f72fa27.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Campus Mights</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"> </script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"> </script>

 

</head>

<body>
 
    <div class="container-fluid">
        <div class="row" style="height: auto; background-color: black; ">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 hero">
                <div style="margin-bottom: 50px;">
                    <h1>Welcome Might !!!</h1>
                    <p>The campus might students empowerement scheme</br> is geared to support students who are doing good in </br> various industries regardless of the tight schedules </br>they may have as students. </p>
                </div>
                <a href="#learnMore"> Vote your Might <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-6  imageBox">
                <div class="mySlides fade">

                    <img src="img/IMG-20190912-WA0013.png" alt="Campus Mights">

                </div>

                <div class="mySlides fade">

                    <img src="img/IMG-20190912-WA0005.png" alt="Campus Mights">

                </div>

                <div class="mySlides fade">

                    <img src="img/IMG-20190912-WA0013.png" alt="Campus Mights">

                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <br>
                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 voteContent" id="learnMore">
                <h2>How to vote</h2>
                <p> It is quite simple !!!</p>
                <div>
                    <p style="font-weight: 400; margin-top: 15px;"> To vote your preferred might, you will need to find him/her on the voting section below,
                        </br>after which you click the vote button attached to might of your choice,
                        </br>this will refer you to make payment of any amount of your choice. </br>
                        Then VOILA your vote is added. </p>
                    <button class="startButton"><a href="#" style="text-decoration: none; color: white;"> Start Voting</a></button>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 100px;">


            <?php
                                    $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
                                    if ($conn-> connect_error){
                                        die("connection failed:" . $conn-> connect_error);
                                    }

                                    $sql = "SELECT ID, PICTURE, FULL_NAME, INSTITUTION, DEPARTMENT, CONT_LEVEL  FROM contenders";
                                    $result = $conn-> query ($sql);

                                    if ($result-> num_rows > 0){
                                        
                                        while ($row = $result -> fetch_assoc()){
                                            
                                            // echo "<tr><td>" . $row["PICTURE"]  . "</td><td>".  . "</td><td>" . . "</td><td>" .  . "</td><td>" . $row["CONT_LEVEL"]. "</td></tr>" ;
                                     
                echo  '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 voteCard">
                    <div class="row cardContent">
                        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 imgBox">
                        
                        <img src= '.$row["PICTURE"].'>
                        

                        </div>'.
                        '<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 voteInfo">
                            <h3>' . $row["FULL_NAME"] . '</h3>
                            <p>' . $row["INSTITUTION"] . '</p>
                            <p>' . $row["DEPARTMENT"] . '</p>
                            <p>' . $row["CONT_LEVEL"] . '</p>
                            <input type="hidden" value=' . $row["ID"] . ' id="first">
                            <button onclick="parsing('. $row["ID"] .')" data-toggle="modal" data-target="#myModal"> Vote</button>
                        </div>
                        </div>
                    </div>';
                                     
                                     
                                        }
                                      
  
                                    }
                                    else {
                                        echo "0 results";
                                    }
                                   $conn-> close();
          ?>
    
           
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
                <div class="modal-content overallModal">
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" style="display: inline-block;">&times;</button>
                        <h4 class="modal-title" style="display: inline-block;">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <form action="payment.php" method="post">
                        <input type="text" name="First_name" placeholder="First Name" class="inputtt"/>
                        <input type="email" name= "Email" placeholder="Email Address" class="inputtt"/>
                        <input type="hidden" name= "Cont_ID" value="x" id="second"/>                        
                       
                        <select class="droopdown" name="selectedAmount" >
                      
                      <?php
                      
                        $count = 1;
                        $amount = 100;
                        $selectedAmount;
                      while( $count <= 200){
                       $selectedAmount = $amount * $count;
                        echo '<option value='. $selectedAmount .'>'. $count . ' Vote - ' .($selectedAmount) .  '</option>';
                        $count ++;
                      } 
                       
                        ?>
                        </select>
                        <button name="pay" type="submit" > Pay Now </button>
                        </form>
                    </div>
                   
                </div>
            
            </div>
        </div>
    </div>
    
    <script>
        function parsing(x) {
            document.getElementById("second").value = x;

    }
    </script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    

    
</body>

</html>