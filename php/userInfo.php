<?php
session_start();?>
<?php

  include ("database.php"); 

/*
print_r($_SESSION);
echo $_SESSION['user'] ;
echo $_SESSION['id'] ;
echo $_SESSION['ID'] ;

if ((int)($_SESSION['ID'] /10000) == 1)
echo "\ns";*/

$id    = $_SESSION['ID'];
$type  = $_SESSION['ID'] /10000;
$name  = getName($id) ;
$photo = getPhoto($id);




if ($_REQUEST["do"]=="getbar")
echo userBar($id);
else if($_REQUEST["do"]=="getcourses")
	echo courses($id);
else if($_REQUEST["do"]=="getcourses2")
	echo courses2($id);
else if($_REQUEST["do"]=="getquestions")
	echo getquestions($id);

else if($_REQUEST["do"]=="getname")
	echo getname($id);
else if($_REQUEST["do"][0]=="d")
	echo edit1($id);
else if($_REQUEST["do"][0]=="D")
	echo edit2($id);
else if($_REQUEST["do"]=="getEmail")
	echo getEmail($id);
else if($_REQUEST["do"]=="getBirth")
	echo getBirth($id);
else if($_REQUEST["do"]=="getPhone")
	echo getPhone($id);
else if($_REQUEST["do"]=="getcontry")
	echo getcontry($id);
else if($_REQUEST["do"]=="getPhoto")
	echo getPhoto($id);
else if($_REQUEST["do"]=="setemail")
	echo setemail($id);
else if($_REQUEST["do"]=="setimg")
	echo setimg($id);
else if ($_REQUEST["do"]=="session")
{
        if ($_SESSION) 
        echo 1; 
        else echo "no"; 
}
else if ($_REQUEST["do"]=="logOut")
 logout ();
 
 // numbers of users 
 else if  ($_REQUEST["do"] =='getnumS')
{
        if ($result = $conn -> query("SELECT * FROM `user` WHERE `ID`<20000"))  
                echo $result -> num_rows;
        else echo 0;        

}
 else if  ($_REQUEST["do"] =='getnumT')
{
        if ($result = $conn -> query("SELECT * FROM `user` WHERE `ID`<30000 AND `ID`>20000"))  
                echo $result -> num_rows;
        else echo 0;        

}


?>


<?php
function setimg($id)
{
include ("database.php"); 
$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "حجم الصورة كبير جدأ";
		    
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE `user` SET `file_name`='".$new_img_name."' WHERE `ID`='".$id."' ";
				mysqli_query($conn, $sql);
				
			}else {
				$em = "لا يمكنك تحميل ملف بهذا الامتداد";
		        
			}
		}
	}else {
		$em = "خطأ في تحميل الملف";
                $em .=$_FILES['my_image']['error'];
            
	}


return $em;

}
function getquestions($id)
{
include ("database.php"); 
$print='';
$q="SELECT `content`, `time`FROM `question` WHERE `user_id`= '".$id."' ";


$r1 =mysqli_query($conn, $q);

 while ( $row = mysqli_fetch_row( $r1 ) )
 {

 						
 $print.='           <div class="post">
                      <div class="user-block">
                        <span class="username">
                          <a href="#" id="useer_name">'.$name.'</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">'.$row[1].'</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
'.$row[0].'
                      </p>
                    </div>
                    <!-- /.post -->

                     
 ';
 $i=$i+1;
 }
return $print;
}

function courses($id)
{
include ("database.php"); 
$print='';
$q="SELECT `c_id` FROM `enroll` WHERE `u_id`= '".$id."' ";

$r1 =mysqli_query($conn, $q);
 while ( $row = mysqli_fetch_row( $r1 ) )
 {
 $q="SELECT `title`, `cost`, `rate`, `photo` FROM `course` WHERE `id`= '".$row[0]."' ";
 $r =mysqli_query($conn, $q);
 $row1 = mysqli_fetch_row( $r );
 
 $print.= ' <a href="http://i-learn.atwebpages.com/courseDes.php?c="'.$row[0].'"&l=1">
                                  <div class="col-md-6">
                                            <div class="singel-course mt-30">
                                                <div class="thum">
                                                    <div class="image">
                                                    
                                                        <img src="'.'data:image/jpeg;base64,' . base64_encode($row1[3]).'" alt="Course">
                                                    </div>
                                                    <div class="price">
                                                        <span>$'.$row1[1].'</span>
                                                    </div>
                                                </div>
                                                <div class="cont border">
                                                    
                                                    
                                                    <a href="#"><h4>'.$row1[0].'</h4></a>
                                                   
                                                </div>
                                            </div> <!-- singel course -->
                                        </div>
                                        </a>';
                                       
 }

                                       
return $print;
}
function courses2($id)
{
include ("database.php"); 
$print='';
$q="SELECT `id`,`title`, `cost`, `rate`, `photo` FROM `course` WHERE `teacher_id`= '".$id."' ";

$r1 =mysqli_query($conn, $q);
 while ( $row = mysqli_fetch_row( $r1 ) )
 {
 
 $print.= ' <a href="http://i-learn.atwebpages.com/courseDes.php?c="'.$row[0].'"&l=1">
                                  <div class="col-md-6">
                                            <div class="singel-course mt-30">
                                                <div class="thum">
                                                    <div class="image">
                                                    
                                                        <img src="'.'data:image/jpeg;base64,' . base64_encode($row[4]).'" alt="Course">
                                                    </div>
                                                    <div class="price">
                                                        <span>$'.$row[2].'</span>
                                                    </div>
                                                </div>
                                                <div class="cont border">
                                                    
                                                    
                                                    <a href="#"><h4>'.$row[1].'</h4></a>
                                                   
                                                </div>
                                            </div> <!-- singel course -->
                                        </div>
                                        </a>';
                                       
 }

                                       
return $print;
}
function edit1($id)
{
include ("database.php"); 
$do=$_REQUEST["do"];
  $var="";
for($i =1; $i<strlen($do); $i++)
 $var.= $do[$i];

$q="UPDATE `user` SET `birth`='".$var."' WHERE `ID`= '".$id."' ";

	$r1 =mysqli_query($conn, $q);
	
}

function edit2($id)
{
include ("database.php"); 
$do=$_REQUEST["do"];
  $var="";
for($i =1; $i<strlen($do); $i++)
 $var.= $do[$i];

$q="UPDATE `user` SET `country`='".$var."' WHERE `ID`= '".$id."' ";

	$r1 =mysqli_query($conn, $q);
	
}
function logout()
{
  session_unset();

  session_destroy();
}

function getName($id) 
{
  include ("database.php");  
  $name="User";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `name` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 //////////////////////////////////////////////////////
 function getBirth($id) 
{
  include ("database.php");  
  $name="0000-00-00";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `birth` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 //////////////////////////////////////////////////////
 function getPhone($id) 
{
  include ("database.php");  
  $name="0000000";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `phone` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 //////////////////////////////////////////////////////
 function getcv($id) 
{
  include ("database.php");  
  $name="User";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `cv` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= 'Content-type: application/pdf' . $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 //////////////////////////////////////////////////////
 function getcontry($id) 
{
  include ("database.php");  
  $name="لا يوجد";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `country` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 //////////////////////////////////////////////////////
 
 function getEmail($id) 
{
  include ("database.php");  
  $name="لا يوجد";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `email` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          $name= $row[0];
         }

 }
 $conn -> close();

 return $name;
 }
 

////////////////////////////////////////////////////////////////////////////////////////////////

function getPhoto($id) 
{
  include ("database.php");
  $photo="";
 
 if ($conn) {
         if ($result = $conn -> query("SELECT `photo` FROM `user` WHERE `ID`= $id")) {
                  while ($row = $result -> fetch_row())
                          if($row[0]!= null)
                                $photo='data:image/jpeg;base64,' . base64_encode($row[0]);
                          else  $photo= "images/student.png";  
         }

 } 
 $conn -> close();

 return $photo;
 }
 /////////////////////////////////////////////////////////////
 
 
 
 ////////////////////////////////////////////////////////////////////////////////////////////////
 function userBar($id) 
{
$t=intdiv($id,10000);
if($t==1)$p="student_profile.html";
else if($t==2)$p="teacher_profile.html";
        $print ='                            <a class="getstarted scrollto" href="login-singup.html">تعلم الان</a>';
  if ($_SESSION)
          $print= '
                 
      <script>
		$(document).ready(function(){
			$(".profile .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			  $(".notifications").removeClass("active");
			});

			$(".notifications .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			   $(".profile").removeClass("active");
			});

			$(".show_all .link").click(function(){
			  $(".notifications").removeClass("active");
			  $(".popup").show();
			});

			$(".close").click(function(){
			  $(".popup").hide();
			});
		});
	</script>

 
      
                         <div class="wrapper">
  <div class="navbar">
   
    <div class="navbar_right">
  
      <div class="profile">


          <img class="rounded-circle" src="'.getPhoto($id).'" alt="profile_pic">
          <span class="name" >
		  <div name="n"><a href="'.$p.'"> '.getName($id).'</a> </div>
                  
		  </span>

  </div>
       
      </div>
      
      
        
        
      <button  class="btn btn-info btn-lg" onclick="logOut()">
      
           Log out
        </button>
        
        
    
    </div>
  </div>
  
  <div class="popup">
    <div class="shadow"></div>
    <div class="inner_popup">
        <div class="notification_dd">
            <ul class="notification_ul">
                <li class="title">
                    <p>All Notifications</p>
                    <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
                </li> 
                <li class="starbucks success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="baskin_robbins failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="mcd success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="baskin_robbins failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="pizzahut failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="kfc success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>
            </ul>
        </div>
    </div>
  </div>
  
</div>
                    

                       
          '; 
          
  return $print;
}

?>