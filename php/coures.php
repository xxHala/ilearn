<?php
session_start();
?>

<?php

include ("database.php");
include ("userInfo.php");
$do = $_REQUEST["do"];


if  ($do =='getnum')
{
        if ($result = $conn -> query("SELECT * FROM `course`"))  
                echo $result -> num_rows;
        else echo 0;        

}

//editL -------------------------------------------------------------------
else if ($do =='editL')
{  
$title = $_REQUEST["title"];
$des = $_REQUEST["desc"];
$content = $_REQUEST["content"];
$video = $_REQUEST["video"];
if ($video)
        $video ="https://www.youtube.com/embed/".$video;
$time = $_REQUEST["time"];
$cid = $_REQUEST["cid"];
$lid = $_REQUEST["lid"];

$print =0;

$q= "UPDATE `lecturer` SET `title`='$title',`description`='$des',`time`='$time',`video`=' $video',`content`='$content' WHERE `id`= '$lid' AND`c_id`='$cid';";

if ($title)
{   
$q= "UPDATE `lecturer` SET `title`='$title',`description`='$des',`time`='$time',`video`=' $video',`content`='$content' WHERE `id`= '$lid' AND`c_id`='$cid';";
   if ($result = $conn -> query($q))
   echo 1;

 }          
  echo 0; 
}

// new lectuer -------------------------------------------------------------------
else if ($do =='NewL')
{  
$title = $_REQUEST["title"];
$des = $_REQUEST["desc"];
$content = $_REQUEST["content"];
$video = $_REQUEST["video"];
if ($video)
        $video ="https://www.youtube.com/embed/".$video;
$time = $_REQUEST["time"];
$cid = $_REQUEST["cid"];

$print =0;
if ($title)
{
if ($result = $conn -> query("SELECT * FROM `lecturer` WHERE `c_id`=$cid"))
 $lid= $result -> num_rows +1;
       
$q= "INSERT INTO `lecturer`(`id`, `c_id`, `title`, `description`, `time`, `video`, `content`) VALUES ('$lid', '$cid', '$title', '$des', '$time' ,'$video', '$content');";
   if ($result = $conn -> query($q))
      if ($result = $conn -> query("SELECT * FROM `lecturer` WHERE `c_id`=$cid AND `id`=$lid"))
             while ($row = $result -> fetch_row()) 
             {
             $print=1; break;
             }
 }           
  echo $print; 
}
        

// All courses for teacher as a row -------------------------------------------------------------------
else if ($do =='All')
{  

   if ($result = $conn -> query("SELECT * FROM `course` WHERE `teacher_id`=".$id." ORDER by `show_` ,`s_id`"))  
       while ($row = $result -> fetch_row()) 
          {
          echo '
          <tr class="mw-100" id="c'.$row[0].'">
                      <td>
                          ';
                          if ($re = $conn -> query("SELECT `title` FROM `subject` WHERE `id` =".$row[1])) 
                             while ($r = $re -> fetch_row())
                              echo  $r[0];

                          //getSubject ($row[1])
                          
                          echo '
                      </td>
                      <td>
                          <a>
                             '.$row[2].'
                          </a>
                          <br/>'; 
                          if ($row[11])
                         echo ' <small class="text-muted"> تنتهي في '.$row[11].' </small>';
                     echo'     
                      </td>
                      <td>
                          <a>
                            '.$row[8].'
                          </a>
                      </td>
                      
                      <td id="Badge'.$row[0].'" class="project-state">';
                      
                      if ($row[6] == 0)
                              echo '    <span  class="badge badge-warning">لم يتم الموافقه عليها بعد </span>';
                      else if ("".date("Y-m-d")." ".date("H:i:s") <= $row[11] || $row[11]==null )
                              echo '    <span class="badge badge-success">مستمرة</span>';
                      else
                              echo '    <span class="badge badge-dark">منتهيه</span>';
                      
                       
                      echo '</td>
                      <td class="project-actions text-right">
                          <!--a class="btn btn-primary btn-sm" href="project-detail.html"><i class="fas fa-folder"></i>تفاصيل</a-->
                          <a class="btn btn-info btn-sm" href="project-edit.php?id='.$row[0].'"><i class="fas fa-pencil-alt"> </i> تعديل</a>';
                      
                      echo'
                          <button onclick="removeC('.$row[0].')" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>حذف </button>
                      </td>
                  </tr>
                  
          
          
          
          ';
          }
             

}


// All courses for admin as a row -------------------------------------------------------------------
else if ($do =='ALL')
{  

   if ($result = $conn -> query("SELECT * FROM `course` WHERE 1 ORDER by `show_` ,`s_id`"))  
       while ($row = $result -> fetch_row()) 
          {
          echo '
          <tr class="mw-100" id="c'.$row[0].'">
                      <td>
                          ';
                          if ($re = $conn -> query("SELECT `title` FROM `subject` WHERE `id` =".$row[1])) 
                             while ($r = $re -> fetch_row())
                              echo  $r[0];

                          //getSubject ($row[1])
                          
                          echo '
                      </td>
                      <td>
                          <a>
                             '.$row[2].'
                          </a>
                          <br/>'; 
                          if ($row[11])
                         echo ' <small class="text-muted"> تنتهي في '.$row[11].' </small>';
                     echo'     
                      </td>
                      <td>
                          <a>
                            '.getName($row[7]).'
                          </a>
                      </td>
                      
                      <td id="Badge'.$row[0].'" class="project-state">';
                      
                      if ($row[6] == 0)
                              echo '    <span  class="badge badge-warning">لم يتم الموافقه عليها بعد </span>';
                      else if ("".date("Y-m-d")." ".date("H:i:s") <= $row[11] || $row[11]==null )
                              echo '    <span class="badge badge-success">مستمرة</span>';
                      else
                              echo '    <span class="badge badge-dark">منتهيه</span>';
                      
                       
                      echo '</td>
                      <td class="project-actions text-right">
                          <!--a class="btn btn-primary btn-sm" href="project-detail.html"><i class="fas fa-folder"></i>تفاصيل</a-->
                          <a class="btn btn-info btn-sm" href="project-edit.php?id='.$row[0].'"><i class="fas fa-pencil-alt"> </i> تعديل</a>';
                      
                      if ($row[6] == 0)
                              echo'<button id="acceptButton'.$row[0].'" onclick="acceptC('.$row[0].')" class="btn btn-success btn-sm" ><i class="fas fa-check"></i>موافقه  </button>';
                     echo'
                          <button onclick="removeC('.$row[0].')" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>حذف </button>
                      </td>
                  </tr>
                  
          
          
          
          ';
          }
             

}


// Remove lectuer --------------------------------------------------------------------
else if ($do =='dleteL')
{
$lid = $_REQUEST["lid"];
$cid = $_REQUEST["cid"];

if ($result = $conn -> query("DELETE FROM `lecturer` WHERE `id`= '$lid' AND`c_id`='$cid'"))
    if ($result = $conn -> query("UPDATE `lecturer` SET `id`= `id`-1 WHERE `id`>'$lid' AND`c_id`='$cid'"))
        echo 1;
else echo 0;        

}// Remove course--------------------------------------------------------------------
else if ($do =='Remove')
{
$cid = $_REQUEST["cid"];

if ($result = $conn -> query("DELETE FROM `course` WHERE `id`= $cid "))
        echo 1;
else echo 0;        

}

// Accept course--------------------------------------------------------------------
else if ($do =='Accept')
{
$cid = $_REQUEST["cid"];

if ($result = $conn -> query("UPDATE `course` SET `show_` = '1' WHERE `course`.`id` =$cid "))
        echo 1;
else echo 0;        

}

// enroll--------------------------------------------------------------------
else if ($do =='Enroll')
{
if ($_SESSION)
{

 $cid  = $_REQUEST["cid"];
//

            
if ($result = $conn -> query("SELECT * FROM `course` WHERE `teacher_id` = $id  AND `id`= $cid "))
        while ($rrr = $result -> fetch_row())
        {
                  $print = "انت معلم لهذه الدوره ";
                 break;
         }
                 
               

if ($print != "انت معلم لهذه الدوره ") 
{ 
  if($conn -> query("INSERT INTO `enroll` (`u_id`, `c_id`) VALUES ('$id', '$cid')"))
    $print = "لقد تم تسجيلك بنجاح  ";
  else  $print = "انت بالفعل مسجل بهذه الدورة ";  

}
  
echo $print;
}

else 
  echo 0;
}

// comments for lectuer--------------------------------------------------------------------
else if ($do =='NewCommentL')
{


if ($_SESSION)
{
$text = $_REQUEST["text"];
$lid  = $_REQUEST["lid"];
$cid  = $_REQUEST["cid"];

 if( $conn -> query(" INSERT INTO `Lcomment` (`l_id`, `c_id`, `u_id`, `date`, `text`) VALUES ('$lid','$cid', '$id', '".date("Y-m-d")." ".date("H:i:s")."', '$text') ;"))
 echo '
 <li>          <div class="singel-reviews">
                 <div class="reviews-author">
                     <div class="author-thum">
                       <img width="60" height="60" src="'.$photo.'" alt="Reviews">
                     </div>
                     <div class="author-name">
                     <h6>'.$name.'</h6>
                     <span>'.date("Y-m-d")." ".date("H:i:s").'</span>
                     </div>
                 </div>
                 <div class="reviews-description pt-20">
                         <p>'.$text.'</p>
                  </div>
                </div> <!-- singel reviews -->
 </li>
 
 ';
 
}

else 
  echo 0;
}

// comments--------------------------------------------------------------------
else if ($do =='NewComment')
{
if ($_SESSION)
{
//"UPDATE `course` SET `rate` = '0' WHERE `course`.`id` = ".$cid  
//"SELECT `rate` FROM `course` WHERE `course`.`id` = ".$cid  

  
$text = $_REQUEST["text"];
$star = $_REQUEST["star"];
if (!$_REQUEST["star"])   $star =0;
$cid  = $_REQUEST["cid"];

 if( $conn -> query(" INSERT INTO `Ccomment` (`id`, `c_id`, `u_id`, `date`, `text`, `star`) VALUES (NULL, '$cid', '$id', '".date("Y-m-d")." ".date("H:i:s")."', '$text', '$star');"))
 echo '
 <li>          <div class="singel-reviews">
                 <div class="reviews-author">
                     <div class="author-thum">
                       <img width="60" height="60" src="'.$photo.'" alt="Reviews">
                     </div>
                     <div class="author-name">
                     <h6>'.$name.'</h6>
                     <span>'.date("Y-m-d")." ".date("H:i:s").'</span>
                     </div>
                 </div>
                 <div class="reviews-description pt-20">
                         <p>'.$text.'</p>
                         <div class="rating">
                         <ul>';
                                 for($i=0;$i<$star;$i++) echo '<li><i class="fa fa-star"></i></li>';
                                 echo '
                         </ul>
                         <span>/ '.$star.' Star</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> <!-- singel reviews -->
                                                                                           </li>
 
 ';
   if ($result = $conn -> query("SELECT `rate` FROM `course` WHERE `course`.`id` = ".$cid ))  
                     while ($row = $result -> fetch_row()) 
                     {
                     $row[0]++;
                        if ($result = $conn -> query("UPDATE `course` SET `rate` = '".$row[0]."' WHERE `course`.`id` = ".$cid )) 
                        break;
                     }
 
}

else 
  echo 0;
}
// subjectSelect--------------------------------------------------------------------
else if ($do =='subjectSelect')
{
$print = '<select name="subject" id="inputStatus" class="form-control custom-select">
                  <option selected disabled>اختر</option>';

if ($result = $conn -> query("SELECT `id`,`title`FROM `subject`"))  
        {
             while ($row = $result -> fetch_row())
             {
             $print .= "<option value='".$row[0]."'  id='".$row[0]."'> ". $row[1] ." </option>";
             }
        }
$print .= '                </select>';  
echo $print;
}

// subjects-------------------------------------------------------------------- 
else if ($do =='S')
{
        $print="";
        $subject = ["id" => 0 ,"title" => "" , "desc" => "" , "color" => "" , "photo" => ""];   
        
        if ($result = $conn -> query("SELECT * FROM `subject`"))  
        {
             while ($row = $result -> fetch_row())
             {
                     $subject["id"]=$row[0];
                     $subject["title"]=$row[1];
                     $subject["desc"]=$row[2];
                     $subject["color"]=$row[3];
                     $subject["photo"]='data:image/jpeg;base64,' . base64_encode($row[4]);  
                     
                     
                     $print.='  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-box '.$subject["color"].'">
                            <img
                                src="'.$subject["photo"].'"
                                class="img-fluid"
                                alt="s"
                                width="100"
                                height="100"
                            >
                            <h1></h1>
                        </br>
                        <h3>'.$subject["title"].'</h3>
                        <p>'.$subject["desc"].'</p>
                        <a href="courses.php?id='.$subject["id"].'&where=1" class="read-more">
                            <span>اقرأ المزيد</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
           
                     ';
             }
        
        }else  $print="لا يوجد مواضيع حاليا";
        
             
        echo $print;
}


?>

