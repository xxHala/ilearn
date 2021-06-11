<?php
session_start();
?>

<?php

include ("database.php");

include ("userInfo.php");
$do = $_REQUEST["do"];


if  ($do =='getnum')
{
        if ($result = $conn -> query("SELECT * FROM `question`"))  
                echo $result -> num_rows;
        else echo 0;        

}



//--- Enable for users--------------------------------------------------------------------------------
else if ($do =="Enable")
{
  $print='';

if ($_SESSION)
$print ='
                                     <div class="row float-end mb-3">   
                                        <div class="col userimg">  <img class="rounded-circle" src="'.$photo.'"/></div>
					<div class="col username"> <p class="name" >'.$name.'</p></div>

                                     </div>

					<p class="quotes" align=center>
                                                   <input type="text" style="max-width: 100%; width:100%; " class="m-2  form-control" id="tags" placeholder="tag1,tag2,...">
						   <textarea class="m-2 form-control" id="mypara"  style="max-width: 100%; width:100%;" placeholder="ضع استفسارك هنا!"  rows="2"></textarea>
					           <textarea class="m-2 form-control" id="mypara2" style="max-width: 100%; width:100%;" placeholder="ضع البرنامج هنا"  rows="3"></textarea>

					</p>
                                        
					<!-- image load to post -->
					<div class="post">
                                                        <img id="load2" class="postimg" src=""/>
					</div>

					<div class="postbar" style="padding: 10px 10px 1px 10px;">
							<input type="file" accept="images/*" id="chooseimg" onchange="loadFile(event)" onmouseover="onbuttoncolor()" onmouseout="outbuttoncolor()"/>
                                                        <button type="button" class="imgbttn" id="imgbttn"> ارفق صورة</button>
							<button type="button" id="postmypost" class="postmypost" onclick="mypost();">اسأل</button>
					</div> 

';

  echo $print;
}

//--- save New Answer--------------------------------------------------------------------------------
else if ($do == 'A')
{
if ($_SESSION)
{

  $text =$_REQUEST["text"];
  $Qid =$_REQUEST["Qid"];

  $conn -> query("INSERT INTO `answer`   (`id`, `q_id`, `time`, `likes`, `dislikes`, `content`, `user_id`) VALUES ('', '$Qid', '".date("Y-m-d")." ".date("H:i:s")."', '0', '0','$text', $id);");
  $conn -> close();
  $print="لقد تم ارسال اجابتك وسيتم نشرها بعد موافقه المسؤول";
  echo $print;
     }
else 
  echo 0;
     
}


//--- save New Questions --------------------------------------------------------------------------------
else if ($do == 'New')
{
if ($_SESSION)
{

  $text  =$_REQUEST["QuestionTxt"];
  $code  =$_REQUEST["CodeTxt"];
  $tags  =$_REQUEST["TagsTxt"];
  //$photo =$_REQUEST["photo"];

  $conn -> query("INSERT INTO `question` (`id`, `content`, `code`, `time`, `tag`, `likes`, `dislikes`,`photo`,`user_id`) VALUES (NULL, '$text','$code', '".date("Y-m-d")." ".date("H:i:s")."', '$tags', '0', '0', NULL, $id);");

if ($result = $conn -> query("SELECT * FROM `question` ORDER BY `id` DESC"))
      {   
          $row = $result -> fetch_row();
  
          $conn -> close();
          
          $print="لقد تم ارسال سؤالك وسيتم نشرها بعد موافقه المسؤول";
          echo $print;
     }
}

else 
  echo 0;



}
//--- Like & Dislike --------------------------------------------------------------------------------



else if ($do == 'L')
{

$i =$_REQUEST["id"];
$x =$_REQUEST["num"];

$conn -> query("UPDATE `question` SET `likes` = '$x' WHERE `question`.`id` = $i")  ; 
$conn -> close();

}

else if ($do == 'D')
{

$i =$_REQUEST["id"];
$x =$_REQUEST["num"];

$conn -> query("UPDATE `question` SET `dislikes` = '$x' WHERE `question`.`id` = $i")  ; 
$conn -> close();


}

else if ($do == 'AL')
{

$i =$_REQUEST["id"];
$x =$_REQUEST["num"];

$conn -> query("UPDATE `answer` SET `likes` = '$x' WHERE `answer`.`id` = $i")  ; 
$conn -> close();

}

else if ($do == 'AD')
{

$i =$_REQUEST["id"];
$x =$_REQUEST["num"];

$conn -> query("UPDATE `answer` SET `dislikes` = '$x' WHERE `answer`.`id` = $i")  ; 
$conn -> close();


}



//--- data for Questions --------------------------------------------------------------------------------

if ($do[0] == 'Q')
{



$print ="";
$user     = ["name" => "" , "photo" => ""];   

$question = ["id" => 0 ,"content" => "" ,"tag" => "" ,"code" => "" , "time" => "" , "likes" => 0 , "dlikes" => 0,  "answers" => 0, "photo"=>""];   
$answer   = ["id" => 0 ,"content" => "" , "time" => "" , "likes" => 0 , "dlikes" => 0];   

     
	if ($result = $conn -> query("SELECT * FROM `question` WHERE show_=1 ORDER BY `id` DESC"))  // all questions (rows)
        {
                               $n= $result -> num_rows;
                               $pages=ceil($n /10);
                               $i=0;
                               
                while ($row = $result -> fetch_row())
                       {
                       if ($i >= ($do[1]*10)-10 )
                       if ($i< $do[1]*10)
                       {
                               /////////////////////////////
                               
                               
                               
                               $question['id']     = $row[0];
                               $question['content']= $row[1];
                               if ($row[4])
                               $question['tag']    = '<button type="button" class="btn btn-dark btn-sm ">'. $row[4].'</button>';
                               else   $question['tag']  ="";
                               if ($row[2])
                               $question['code']   = '
                                                        <button onclick="x('. $question['id'] .');" class="btn btn-primary btn-sm d-flex m-2">view code</button>
                                                        <textarea disabled rows="10" cols="70" id="code'. $question['id'] .'" style="display: none;"> class="form-control ml-1 shadow-none textarea">'.$row[2].'</textarea>';
                               else   $question['code']  ="";
                               $question['time']   = $row[3];
                               $question['likes']  = $row[5];
                               $question['dlikes'] = $row[6];
                               if ($row[7])
                               $question['photo']  ='<img src="'.  'data:image/jpeg;base64,' . base64_encode($row[7])  .'" width=50%> ';
                               else   $question['photo']  ="";
                               
                               $id  =  $row[8];
                               
                               
                               if ($rAnswer = $conn -> query("SELECT * FROM `answer`  WHERE show_=1 AND `q_id` =". $question['id'])) 
                                     $question['answers']= $rAnswer -> num_rows;
                                       
                             
                               /////////////////////////////
                               
                               if ($rUser = $conn -> query("SELECT `name`,`photo` FROM `user` WHERE `id`='$id'"))  // user's info (rr)
                               while ($rr = $rUser -> fetch_row())
                                   {
                                                 $user['name']  =  $rr[0];
                                                 if ($rr[1] != null)
                                                       $user['photo'] ='data:image/jpeg;base64,' . base64_encode($rr[1]);
                                                 else  $user['photo'] = "assets/img/other_profile.png";      
                                    }  
                            
                            
                                
                                $print.='
                                
                                	 <!--  QUESTION -->
                                         <div class="card p-3 border m-3 mw-50"> <span class="dots"></span>
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex flex-row">
                                                    <div class="user-image m-2 "> <img src="'.$user['photo'].'" width="40" class="rounded-circle"> </div>
                                                            <div class="d-flex flex-column">
                                                                <h3 class="name m-2">'.$user['name'].'</h3> <span class="date text-secondary"><small>'. $question['time'].'</small></span>
                                                            </div>
                                                    </div>
                                                    <div> <span>'. $question['tag'].'</span> </div>
                                                 </div>
                                                 <p class="content m-3"> 
                                                         '. $question['content'].'
                                                         '. $question['code'].'
                                                         '.$question['photo'].'
										   
                                                        <div class="likedislike border-top">
                                                             <p class="like">
								<span id="thumbsup'.$question['id'].'" class="fa fa-thumbs-up" onclick="increase(';
                                                                $print.="'like".$question['id']."','dislike".$question['id']."','thumbsup".$question['id']."','thumbsdown".$question['id']."');";
                                                                $print.='"></span><span class="nooflike" id="like'.$question['id'].'">'. $question['likes'].' </span> اعجبني &nbsp <span id="thumbsdown'.$question['id'].'" class="fa fa-thumbs-down" onclick="decrease(';
                                                                $print.="'like".$question['id']."','dislike".$question['id']."','thumbsup".$question['id']."','thumbsdown".$question['id']."');";
                                                                $print.='"></span>
								<span class="noofdislike" id="dislike'.$question['id'].'">'. $question['dlikes'].' </span> لم يعجبني
								
								<span onclick="xComment('. $question['id'] .');" class="fa fa-comment m-4"><span class="ml-2">'.$question['answers'].'</span> اجابات </span>
							      </p>
							
                                                       </div>
                                                       <div  id="comment'. $question['id'] .'" style="display: none;" class="form"> 
                                                                <input id = "commentText'. $question['id'] .'"class="form-control " placeholder="اجب عن السؤال ...">
                                                                <div class="mt-2 d-flex justify-content-end"> 
                                                                        <button onclick="answer('. $question['id'] .');" class="btn btn-primary btn-sm  m-1 ">send</button> 
                                                                 </div>';
                          
                          
                          if ($rAnswer = $conn -> query("SELECT * FROM `answer`  WHERE show_=1 AND `q_id` =". $question['id']."  ORDER BY `likes` DESC;"))  // Answers (rrr)
                               while ($rrr = $rAnswer -> fetch_row())
                                   {
                                               $answer['id']     = $rrr[0];
                                               $answer['time']   = $rrr[2];
                                               $answer['content']= $rrr[5];
                                               $answer['likes']  = $rrr[3];
                                               $answer['dlikes'] = $rrr[4];
                                               $id = $rrr[6];
                                               
                                                if ($rUser = $conn -> query("SELECT `name`,`photo` FROM `user` WHERE `id`='$id'"))  // user's info (rr)
                                                       while ($rr = $rUser -> fetch_row())
                                                   {
                                                         $user['name']  =  $rr[0];
                                                         if ($rr[1] != null)
                                                               $user['photo'] ='data:image/jpeg;base64,' . base64_encode($rr[1]);
                                                         else  $user['photo'] = "assets/img/other_profile.png";      
                                                    }  


                                           $print.=' <div class=" bg-light  mw-50 p-2"> 
                                                            <div class="d-flex justify-content-between mt-2">
                                                                <div class="d-flex flex-row">
                                                                          <div class="user-image mr-2 "> <img src="'.$user['photo'].'" width="40" class="rounded-circle"> </div>
                                                                                   <div class="d-flex flex-column">
                                                                                        <h3 class="name m-2">'.$user['name'].'</h3> <span class="date text-secondary"><small>'.$answer['time'].'</small></span>
                                                                                    </div>
                                                                           </div>
                                                                 </div>
                                                                 <p class="content m-3">'. $answer['content'].'									   
                                                                         <div class="likedislike border-bottom">
                                                                                <p class="like">
                                                                                        <span id="Athumbsup'.$answer['id'] .'" class="fa fa-thumbs-up" onclick="increaseA(';$print.="'Alike".$answer['id'] ."','Adislike".$answer['id'] ."','Athumbsup".$answer['id'] ."','Athumbsdown".$answer['id'] ."');";$print.='"></span>
                                                                                        <span class="nooflike" id="Alike'.$answer['id'] .'">'.$answer['likes'].' </span> اعجبني &nbsp 

                                                                                        <span id="Athumbsdown'.$answer['id'] .'" class="fa fa-thumbs-down" onclick="decreaseA(';$print.="'Alike".$answer['id'] ."','Adislike".$answer['id'] ."','Athumbsup".$answer['id'] ."','Athumbsdown".$answer['id'] ."');";$print.='"></span>
                                                                                        <span class="noofdislike" id="Adislike'.$answer['id'] .'">'.$answer['dlikes'].'</span> لم يعجبني
										</p>
							
                                                                          </div>
				
                                                                </p>
				
                                                                </div>


                                            ';
                                                 
                                    }  
                          
                          $print .='                                
                                                                 
                                                        </div>
				
                                                </p>
				
		           </div>
			   <!--  -------- -->


                                
                                ';
                       }
                       else break;
                       $i++;     
                 }
                       
                echo $print;
        }
        else
                echo "no other Questions";
        $conn -> close();
                
                
}
?>