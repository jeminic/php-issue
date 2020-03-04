<?php 
$conn = mysqli_connect("localhost" , "root" , "" , "campusmights");
if ($conn-> connect_error){
  die("connection failed:" . $conn-> connect_error);
 }

 $sql = "INSERT INTO totalvotes (CONT_VOTED, TOTAL_VOTES) SELECT CONT_VOTED, SUM(VOTE_NUMBER) FROM vote WHERE vote.CONT_VOTED NOT IN (SELECT CONT_VOTED FROM totalvotes) group by CONT_VOTED";

// $update = "UPDATE totalvotes SET TOTAL_VOTES = (SELECT SUM(VOTE_NUMBER) FROM vote) WHERE CONT_VOTED.totalvotes = CONT_VOTED.vote";

 $update1 = "UPDATE totalvotes set TOTAL_VOTES=(select SUM(VOTE_NUMBER) from vote where vote.CONT_VOTED=totalvotes.CONT_VOTED)";

//  $query = mysqli_result("SELECT * FROM totalvotes"); 

 $q="SELECT DISTINCT(CONT_VOTED) FROM totalvotes";
 $r = mysqli_query($conn, $q);
 while($v=mysqli_fetch_object($r))
 {
    $cv[]=$v->CONT_VOTED; 
 }

 $q2="SELECT DISTINCT(CONT_VOTED) FROM vote";
 $r2 = mysqli_query($conn, $q2);
 while($v2=mysqli_fetch_object($r2))
 {
    $cv2[]=$v2->CONT_VOTED; 
 }

 $pn=0;
 $np=0;

 foreach($cv2 as $cc)
 {
    if(in_array($cc, $cv))
    {
      $pn += 1;
    }
    else 
    {
      $np += 1;
    }
 }

 if($pn >= 1)
 {
    mysqli_query($conn, $update1);
 }

 if($np >= 1)
 {
    mysqli_query($conn, $sql);
 }


$conn->close();


?>