<?php

    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $IdBreak = substr( $ref, 7,2);
        $selectedAmountBreak = explode("_", $ref);
        $amount = $selectedAmountBreak[1]; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK_TEST-b5a30ccfd2fed796f3a5609732166a28-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

      	$paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
  $conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
  if ($conn-> connect_error){
    die("connection failed:" . $conn-> connect_error);
   }
$votenumber = $chargeAmount / 100;
$remarks= "success";
$sql = "INSERT INTO vote ( CONT_VOTED, AMOUNT_VOTED, VOTE_NUMBER, TRANSACTION_ID, REMARKS)
VALUES (?, ?, ?, ?, ?)";
if($stmt = mysqli_prepare($conn, $sql)){
  // Bind variables to the prepared statement as parameters
  mysqli_stmt_bind_param($stmt, "sssss", $IdBreak, $chargeAmount, $votenumber, $ref, $remarks);
 
  
  

  if(mysqli_stmt_execute($stmt)){

    
    
    echo "Records inserted successfully";

    
    header("Location:index.php");
    

}
    
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}
  

mysqli_close($conn);
         
          // transaction was successful...
  			 // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          //Give Value and return to Success page
        } else {
            //Dont Give Value and return to Failure page
        }
}
	else {
   die();
   header("Location:index.php");
   }

?>