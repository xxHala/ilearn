<!DOCTYPE html>


<?php 

include ("database.php");

$course = ["id" =>  $_GET['c'] ];   
        if ($result = $conn -> query("SELECT * FROM `course`WHERE `id`=".$course["id"]))  
                     while ($row = $result -> fetch_row()) 
                     {               
                             if ($rTeacher = $conn -> query("SELECT `name`,`photo`,`email` FROM `user` WHERE `ID`=".$row[7])) //teacher info
                                   while ($rr = $rTeacher -> fetch_row()) 
                                             {
                                                      $course["teacher"]=$rr[0];  
                                                      if($rr[1]!= null)
                                                        $course["teacherPhoto"]='data:image/jpeg;base64,' . base64_encode($rr[1]);
                                                      else  $course["teacherPhoto"]="assets/img/other_profile.png"; 
                                                      $course["teacherEmail"] =$rr[2]; 
                                              } 
                                             
                             $course["title"]=$row[2]; 
                             $course["rate"]=$row[4]; 
                             $course["desc"]=$row[8]; 
                             $course["time"]=$row[9]; 
                             $course["cost"] =$row[3]; 
                             $course["SubjectId"]=$row[1];
                             $course["Max"]=$row[10];
                             $course["MaxTime"] = $row[11];

                             if ($row[5] == null)
                                  $course["photo"]= ' images/course/cu-1.jpg';
                             else $course["photo"] =' data:image/jpeg;base64,' . base64_encode($row[5]);                    
                                                          
                             
                     }
                     
                     
$lecture = ["id" =>  $_GET['l'] ];   
        if ($result = $conn -> query("SELECT * FROM `lecturer`WHERE `id`=".$lecture["id"]." AND`c_id` =".$course["id"]))  
                     while ($row = $result -> fetch_row()) 
                     {  
                                             
                             $lecture["title"]=$row[2]; 
                             $lecture["desc"]=$row[3]; 
                             $lecture["time"]=$row[4];
                             $lecture["video"]=$row[5];
                             $lecture["content"]=$row[6];  
                             
                     }
       if ($result ->num_rows ==0) $lecture["id"]=null;             
        
?>


<html lang="ar">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>I-LEARN</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/job.css" rel="stylesheet">
        
                        <link href="assets/css/drop.css" rel="stylesheet">
                        			<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

		<!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/css/cours/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="assets/css/cours/animate.css">
    
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="assets/css/cours/nice-select.css">
    
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="assets/css/cours/jquery.nice-number.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/cours/magnific-popup.css">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/cours/bootstrap.min.css">
    
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="assets/css/cours/font-awesome.min.css">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/cours/default.css">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/cours/style.css">
    
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="assets/css/cours/responsive.css">

    </head>
    <body >
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <img src="assets/img/logo.png" alt="">
                    <span>I-LEARN</span>
                </a>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li>
                             <a class="nav-link scrollto " href="index.html">الصفحة الرئيسية</a>
                        </li>
                        <li>
                          <a class="nav-link scrollto " href="job.html">الوظائف</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="courses.html">الدورات التدريبية</a>

                        </li>
                        <li>
                            <a class="nav-link scrollto" href="question.html">الاسئله</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="index.html#team">فريقنا</a>
                        </li>
                       
                        <li id="user">
                                <script>
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         if (this.responseText) 
                                         {
                                         document.getElementById("user").innerHTML=(this.responseText);
                                         }
                                         } };
                                          xmlhttp.open("GET","php/userInfo.php?do=getbar",true);
                                          xmlhttp.send();
                                          
                                         //log out 


                                           function logOut()
                                           {
                                            
                                            var xmlhttp = new XMLHttpRequest();
                                            xmlhttp.open("GET","php/userInfo.php?do=logOut",true);
                                            xmlhttp.send();
                                            location.href = "http://i-learn.atwebpages.com/index.html"; 
                                           }
                                        //-------------------------
                                        
                                </script>
</li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->

            </div>
        </header>
            <!-- Hero Area Start-->
       

        <!--====== COURSES SINGEl PART START ======-->
    
    <section id="corses-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="corses-singel-left mt-30">
                        <!-- course  -->
                        
                        <div class="corses-singel-image pt-50">
                               <a>
                                                        <ul>
                                                            
                                                            <li><span class="lecture"><h1><?php echo $lecture["title"]  ;?></h1></span></li>
                                                          
                                                            <?php if ($lecture["id"]!=null) 
                                                            echo '<li><span class="time d-none d-md-block"><i class="fa fa-clock-o"></i> <span>'. $lecture["time"] .'</span></span></li>'  ;?>
                                                            <li><span class="lecture">
                                                                    <details>
                                                                            <summary><p class="text-info"><?php echo $lecture["desc"]  ;?></p></summary>
                                                                            <p> <?php echo $lecture["content"] ;?></p>
                                                                    </details>
                                                             </span></li>
                                                        </ul>
                               </a>
                               
                               <?php 
                                       if ($lecture["id"]!=null)
                                       {
                                               if($lecture["video"])
                                               echo '<iframe width="600" height="500" src="'.$lecture["video"]  .'" class="mw-100" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> ';
                                       }
                                       else
                                               echo '<p class="text-center m-5 p-5">لم يتم اضافة محاضارت بعد.</p>';
                                       ?>

						
                        </div> 
						
						<!-- corses  -->
                        
                        <div class="corses-tab mt-30">
                            <ul class="nav nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">عن الدورة</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a id="instructor-tab" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">المدرس</a>
                                </li>
                     <?php 
                           if ($lecture["id"]!=null)
                           {
                           echo '
                                <li class="nav-item">
                                    <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">تعليقات الطلاب </a>
                                </li>';
                            }?>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="overview-description ">
                                        <div class="singel-description pt-40 ">
                                            <h6>مدخل إلى الدورة</h6>
                                            <p><?php echo $course["desc"] ; ?></p>
                                        </div>
                                        <div class="singel-description pt-40">
                                            <h6>مدة الدورة:</h6>
                                            <p>تبلغ المدة الجمالية للدورة <?php echo $course["time"] ; ?> ساعة تقريبًا.</p>
                                        </div>
                                      </div>    
                                </div>
                               
                                <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                    <div class="instructor-cont">
                                        <div class="instructor-author">
                                            <div class="author-thum">
                                                    <?php  echo '<img width="200" height="150" src="'.$course["teacherPhoto"].'" alt="Instructor">' ;?>
                                                
                                            </div>
                                            <div class="author-name">
                                                <a href="profile.html?id="><h5><?php  echo $course["teacher"];?></h5></a>
                                               
                                            </div>
                                        </div>
                                        <div class="instructor-description pt-25">
                                            <p><?php  echo $course["teacherEmail"];?></p>
                                        </div>
                                    </div> <!-- instructor cont -->
                                </div>
                           <?php 
                           if ($lecture["id"]!=null)
                           {
                               echo' <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="reviews-cont">
                                        <div class="title">
                                            <h6>تعليقات الطلاب</h6>
                                        </div>
                                        
                                        <ul id ="commentsList">';
                                        //<!-----comments------------------------------------------>
                                                                                  
                                                if ($re = $conn -> query("SELECT * FROM `Lcomment` WHERE `l_id` =". $lecture["id"]." AND `c_id` =".$course["id"]))   
                                                                           while ($r = $re -> fetch_row())
                                                                           {
                                                                                  if ($ru = $conn -> query("SELECT `name`,`photo` FROM `user` WHERE `ID`=". $r[2]))   //user
                                                                                           while ($rr = $ru -> fetch_row())
                                                                                             {
                                                                                                      $name=$rr[0];  
                                                                                                      if($rr[1]!= null)
                                                                                                            $photo='data:image/jpeg;base64,' . base64_encode($rr[1]);
                                                                                                      else  $photo="assets/img/other_profile.png";  
                                                                                               
                                                                 
                                                                                   echo '
                                                                                           <li>
                                                                                               <div class="singel-reviews">
                                                                                                    <div class="reviews-author">
                                                                                                        <div class="author-thum">
                                                                                                            <img width="60" height="60" src="'.$photo.'" alt="Reviews">
                                                                                                        </div>
                                                                                                        <div class="author-name">
                                                                                                            <h6>'.$name.'</h6>
                                                                                                            <span>'.$r[3].'</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="reviews-description pt-20">
                                                                                                        <p>'.$r[4].'</p>
                                                                                                    </div>
                                                                                                </div> <!-- singel reviews -->
                                                                                           </li>
                                                                                   ';
                                                                           }}


                                          
                                        //<!----------------------------------------------->
                                             
                                                          
                                                          echo ' </ul>
                                        
                                        <div class="title pt-15">
                                            <h6>اترك تعليق</h6>
                                        </div>
                                        
                                        <div class="reviews-form">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <textarea placeholder="تعليقك" id ="comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <button onclick="addComment()" class="main-btn">اضافة</button>
                                                        </div>
                                                    </div>
                                                </div> <!-- row -->
                                        </div>
                                       
                                                                <script type="text/javascript">
                                                                
                                                                        function  addComment()
                                                                        { var data = new FormData();
                                                                          data.append("do", "NewCommentL");
                                                                          data.append("text",document.getElementById("comment").value.replace(/\s/g, "\u00a0") );
                                                                          data.append("lid", '.$lecture["id"].');
                                                                          data.append("cid", '.$course["id"].');
                                                                          
                                                                        
                                                                          var xhr = new XMLHttpRequest();
                                                                          xhr.open("POST", "php/coures.php");
                                                                          xhr.onload = function() {
                                                                                 if (this.responseText != 0)
                                                                                            {
                                                                                                  //alert(this.responseText);
                                                                                                  document.getElementById("comment").value="";
                                                                                                  document.getElementById("commentsList").innerHTML+=this.responseText ;
                                                                                             }                                                                                                
                                                                                  else
                                                                                          {
                                                                                          alert ("عليك تسجيل الدخول اولا ..");
                                                                                          location.href = "http://i-learn.atwebpages.com/login-singup.html"; 
                                                                                          }
                                                                          };
                                                                            
                                                                          xhr.send(data);
                                                                                
                                                                        }
                                                                </script>
                                                                ';
                                     }                     ?>
                                        
                                    </div> <!-- reviews cont -->
                                </div>
                            </div> <!-- tab content -->
                        </div>
                    </div> <!-- corses singel left -->
                    
                </div>
                <div class="col-lg-4">
				 
                 <div class="accordion mt-5" id="accordionExample">
                 
                 <?php 
                          if ($result = $conn -> query("SELECT * FROM `lecturer` WHERE `c_id`=".$course["id"])) 
                               {  
                                       //$course["lectures"]= $result -> num_rows;
                                       while ($row = $result -> fetch_row()) 
                                               {
                                               if ($lecture["id"] == $row[0])
                                                echo ' 
                                                <div class="card">
                                                    <div class="card-header" id="heading'.$row[0].'">
                                                      <h5 class="mb-0">
                                                        <a href="" data-toggle="collapse" data-target="#collapse'.$row[0].'" aria-expanded="true" aria-controls="collapse'.$row[0].'">

                                                         '.$row[2].'
                                                        </a>
                                                      </h5>
                                                    </div>
                                                
                                                    <div id="collapse'.$row[0].'" class="collapse show" aria-labelledby="heading'.$row[0].'" data-parent="#accordionExample">
                                                      <div class="card-body">
                                                       
                                                       
                                                      <ul>
                                                            <li><i class="fa fa-file-video-o"></i> <span class="lecture"><h6>'.$row[2].'</h6></span></li>
                                                            <li><span class="head"><p>'.$row[3].'</p></span></li>
                                                            <li><span class="time d-none d-md-block"><i class="fa fa-clock-o"></i> <span> '.$row[4].'</span></span></li>
                                                        </ul>
                                                        
                                                     
                                                      </div>
                                                    </div>
                                                  </div>
                                                ';
                                                else
                                                echo '
                                                <div class="card">
                                                    <div class="card-header" id="heading'.$row[0].'">
                                                      <h5 class="mb-0">
                                                        <a href="http://i-learn.atwebpages.com/courseDes.php?c='.$row[1].'&l='.$row[0].'"  type="button" data-toggle="collapse" data-target="#collapse'.$row[0].'" aria-expanded="false" aria-controls="collapse'.$row[0].'">
                                                          '.$row[2].'
                                                        </a>
                                                      </h5>
                                                    </div>
                                                    <div id="collapse'.$row[0].'" class="collapse" aria-labelledby="heading'.$row[0].'" data-parent="#accordionExample">
                                                      <div class="card-body">
                                                      
                                                      <ul>
                                                            <li><i class="fa fa-file-video-o"></i> <span class="lecture"><a href="http://i-learn.atwebpages.com/courseDes.php?c='.$row[1].'&l='.$row[0].'"> <h6>'.$row[2].'</h6></a></span></li>
                                                            <li><span class="head"><p>'.$row[3].'</p></span></li>
                                                            <li><span class="time d-none d-md-block"><i class="fa fa-clock-o"></i> <span> '.$row[4].'</span></span></li>
                                                        </ul>
                                                        
                                                     
                                                     </div>
                                                    </div>
                                                  </div>

                                                ';
                                                
                                                }
                                     }
                 ?>
				
	  </div> </div> </div> </div>  </div> 
        </div> <!-- container -->
    </section>
    
    <!--====== COURSES SINGEl PART ENDS ======-->
       

<footer id="footer" class="footer">

    <div class="container">
        <div class="copyright">
            © Copyright
            <strong>
                <span>I-LEARN TEAM</span>
            </strong>
            . All Rights Reserved
        </div>
    </div>
</footer>                <!-- End Footer -->
                <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
                    <i class="bi bi-arrow-up-short"></i>
                </a>
                <!-- Vendor JS Files -->
				<!--====== jquery js ======-->
    <script src="assets/js/cours/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/cours/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/cours/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="assets/js/cours/slick.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="assets/js/cours/jquery.magnific-popup.min.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="assets/js/cours/waypoints.min.js"></script>
    <script src="assets/js/cours/jquery.counterup.min.js"></script>
    
    <!--====== Nice Select js ======-->
    <script src="assets/js/cours/jquery.nice-select.min.js"></script>
    
    <!--====== Nice Number js ======-->
    <script src="assets/js/cours/jquery.nice-number.min.js"></script>
    
    <!--====== Count Down js ======-->
    <script src="assets/js/cours/jquery.countdown.min.js"></script>
    
    <!--====== Validator js ======-->
    <script src="assets/js/cours/validator.min.js"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="assets/js/cours/ajax-contact.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/cours/main.js"></script>
    
    <!--====== Map js ======-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script src="assets/js/cours/map-script.js"></script>
                
            <!-- Hero Area End -->   

			</body>
			
			
    </html>