<?php
session_start();
?>

<?php

include ("database.php");


if ($conn) {
         
         $user = [
                  "id" => "",
                  "name" => "",
                  "email" => $_POST['email'] ,
                  "password" => ""
                  ];
                  $email=$_POST['email'];
	 
$q="SELECT `password`,`name`,`ID` FROM `user` WHERE `email` = '$email' ";
$r1 =mysqli_query($conn, $q);
$row = mysqli_fetch_row( $r1 );
if(isset($row ))   
{
        $user['password'] =  $row[0];
        $user['name']     =  $row[1]; 
        $user['id']       =  $row[2]; 
}



$pass = $_POST['password'] == $user['password']; 

if ($pass) {

  $_SESSION['ID'] =$user['id'];
  
  $id = $user['id'][0];
  echo $id;

}
else
{
        session_destroy();
        echo 0;

}


}


?>