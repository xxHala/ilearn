<?php
include ("database.php");
$id = $_REQUEST["id"];
echo $id;

if ($conn) {
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$b1=$_POST['b1'];

$q="ALTER TABLE `user` AUTO_INCREMENT=10000";
$r1 =mysqli_query($conn, $q);

$q="SELECT `email` FROM `user` WHERE `email` = '$email' ";
	$r1 =mysqli_query($conn, $q);
	$row = mysqli_fetch_row( $r1 );
	 if(!isset($row ) )
	 {
		
                       
			$q2="INSERT INTO `user`(`email`, `name`, `password`) VALUES ('$email','$name','$pass')";
			$r2=mysqli_query($conn, $q2);
                        
                        $q3="SELECT `ID` ,`name` FROM `user` WHERE `email` = '$email' ";
			$r3=mysqli_query($conn, $q3);
                        $row = mysqli_fetch_row( $r3 );
                        session_start(); 
                        $_SESSION['ID']=$row[0];
			$_SESSION['name']=$row[1];
                        
                        
                         
			header("Location: sHome.html");
                        
		
         }
         else
         {
           header("Location:login-singup.html");
         }
		 
} 
?>