
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
<div class="container-fluid contentContaineer">
    <div class="row loginArea" >
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="formCard">
                <h1>Login</h1>
                <p style="text-align: center; font-size:13px; margin-bottom: 50px">Please insert you username and password <br>to access you dashbaord</p>
                
                <form method="post" action="verifylogin.php">
                    <input type="hidden" name="token" value='<?php $_SESSION['50mights6334'];?>' />
                    <input type="text" name="username" placeholder="Type your Username" required  class="inputDetails"/>
                    <input type="password" name="password" placeholder="Type your password" required  class="inputDetails"/>
                    <input type="submit" class="btn-submit" value="Login" style="margin: 0px auto; display:block; margin-top: 50px;"/>
                    
                </form>
            </div>
       </div>
    </div>
</div>
</body>
</html>
