<?php
session_start();
include ("database.php");


echo "<h3><mark>-------------------TEST FILE (x.php)-------------------</mark></h3>";

if ($_SESSION)
{

print_r($_SESSION);
echo $_SESSION['user'] ;
echo $_SESSION['id'] ;
echo $_SESSION['ID'] ;

if ((int)($_SESSION['ID'] /10000) == 1)
echo "<br>s";

include ("userInfo.php");

echo "<br>".$id ;
echo "<br>".$name;
//echo "<br>".$photo;
echo "<br>".$type;


echo"<br>---------------------------------------------------------------<br>";



}

else

echo "login ";
////////////////////////////////////////////


if (isset($_POST['submit'])) {
if (getimagesize($_FILES['Cphoto']['tmp_name']) == false)  echo "<br />Please Select An Image.";
else {
 
//declare variables

$image = addslashes(file_get_contents(($_FILES['Cphoto']['tmp_name'])));


 
$q = "UPDATE `course` SET `photo` = '$image' WHERE `course`.`id` = 24 AND `course`.`s_id` = 2;";
 if ($result = $conn -> query($q)){
echo "<br />Image uploaded successfully. <br>  ";
} else {
echo "<br />Image Failed to upload.<br />";
}
 
}
}
 
?>


<!DOCTYPE html>
<html>
<head>
<title>How To upload BLOB Image To Mysql Database Using PHP,SQL And HTML.</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="Cphoto">
<br />
<input type="submit" name="submit" value="Upload">
 
</form>
</body>
</html>
