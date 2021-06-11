<!DOCTYPE html>


<?php 

include ("database.php");

$course = ["id" =>  $_GET['id'] ];   
        if ($result = $conn -> query("SELECT * FROM `course`WHERE `id`=".$course["id"]))  
                     while ($row = $result -> fetch_row()) 
                     {
                   
                             if ($re = $conn -> query("SELECT * FROM `subject` WHERE `id`=".$row[1]))   //subject
                                   while ($r = $re -> fetch_row()) 
                                             $course["Subject"]=$r[1]; 
                                             
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
                        
        
?>

<htmllang="ar">
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
        <header  dir="rtl" id="header" class="header fixed-top">
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
</li>              </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            </div>
        </header>
            <!-- Hero Area Start-->
       <br><br>
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2><?php echo $course["title"] ;?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="courses.html">الدورات التدريبية</a></li>
                                <li class="breadcrumb-item">
                                    <?php echo '<a href="http://i-learn.atwebpages.com/courses.php?id='.  $course["SubjectId"].'&where=1"> '. $course["Subject"] .'</a>';?>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $course["title"] ;?></li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
            <!-- end hero Section -->
        <!--====== COURSES SINGEl PART START ======-->
    
    <section id="corses-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="corses-singel-left mt-30">
                        <div class="title">
                            <h3><?php echo $course["title"] ;?></h3>
                        </div> <!-- title -->
                        <div class="course-terms">
                            <ul>
                                <li>
                                    <div class="teacher-name">
                                        <div class="thum">
                                        <?php echo '<img width="50" height="60" src='.$course["teacherPhoto"] .' alt="Teacher">' ;?>
                                            
                                        </div>
                                        <div class="name">
                                            <span>المعلم</span>
                                            <h6><?php echo $course["teacher"] ;?> </h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course-category">
                                        <span>الفئة</span>
                                        <h6><?php echo $course["Subject"] ;?> </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="review">
                                        <span>التقييم</span>
                                        <ul>
                                        <?php
                                         $stars =0;
                                         if ($result = $conn -> query("SELECT `star` FROM `Ccomment` WHERE `c_id`=".$course["id"]))  
                                                             while ($row = $result -> fetch_row()) 
                                                              $stars += $row [0];
                                                              
                                                              $n =$result -> num_rows;
                                                              if ( $n != 0)
                                                              $stars /= $n; 
                                                              
                                                              for ($i=0; $i < $stars ;$i++ )
                                                              echo '<li><a href=""><i class="fa fa-star"></i></a></li>';
                                        ?>
                                           
                                            <li class="rating">(<?php echo $course["rate"] ;?>  تقييم)</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div> <!-- course terms -->
                        
                        <div class="corses-singel-image pt-50">
                        <?php echo '<img src="'.$course["photo"].'" alt="Courses">'  ;?>
                            
                        </div> <!-- corses singel image -->
                        
                        <div class="corses-tab mt-30">
                            <ul class="nav nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">عن الدورة</a>
                                </li>
                                <li class="nav-item">
                                    <a id="curriculam-tab" data-toggle="tab" href="#curriculam" role="tab" aria-controls="curriculam" aria-selected="false">وحدات الدورة</a>
                                </li>
                                <li class="nav-item">
                                    <a id="instructor-tab" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">المدرس</a>
                                </li>
                                <li class="nav-item">
                                    <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">التقيمات</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                <div  class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="overview-description ">
                                        <div class="singel-description pt-40 ">
                                            <h6>مدخل إلى الدورة</h6>
                                            <p><?php echo $course["desc"] ; ?></p>
                                        </div>
                                        <div class="singel-description pt-40">
                                            <h6>مدة الدورة:</h6>
                                            <p>تبلغ المدة الجمالية للدورة <?php echo $course["time"] ; ?> ساعة تقريبًا.</p>
                                        </div>
                                    </div> <!-- overview description -->
                                </div>
                                <div class="tab-pane fade" id="curriculam" role="tabpanel" aria-labelledby="curriculam-tab">
                                    <div class="curriculam-cont">
                                        <div class="title">
                                            <h6><?php echo $course["title"] ; ?></h6>
                                        </div>
                                        <div class="accordion" id="accordionExample">
                                        <?php 
                                                 if ($result = $conn -> query("SELECT * FROM `lecturer` WHERE `c_id`=".$course["id"])) 
                                                 {  $course["lectures"]= $result -> num_rows;
                                                                     while ($row = $result -> fetch_row()) 
                                                                     {
                                                                      
                        
                                                echo '
                                                                  <div class="card">
                                                                        <div class="card-header" id="heading'.$row[0].'">
                                                                            <a href="" data-toggle="collapse" data-target="#collapse'.$row[0].'" aria-expanded="false" aria-controls="collapse'.$row[0].'">
                                                                                <ul>
                                                                                    <li><i class="fa fa-file-o"></i></li>
                                                                                    <li><span class="lecture">'.$row[0].'</span></li>
                                                                                    <li><span class="head">'.$row[2].'</span></li>
                                                                                    <li><span class="time d-none d-md-block"><i class="fa fa-clock-o"></i> <span> '.$row[4].'</span></span></li>
                                                                                </ul>
                                                                            </a>
                                                                        </div>
                        
                                                                        <div id="collapse'.$row[0].'" class="collapse show" aria-labelledby="heading'.$row[0].'" data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <p>'.$row[3].'</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                ';
                                             }}
                                               
?>  
                                           
                                              </div>
                                    </div> <!-- curriculam cont -->
                                </div>
                                <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                    <div class="instructor-cont">
                                        <div class="instructor-author">
                                            <div class="author-thum">
                                                    <?php  echo '<img width="200" height="150" src="'.$course["teacherPhoto"].'" alt="Instructor">' ;?>
                                                
                                            </div>
                                            <div class="author-name">
                                                <a href="profile.html?id="><h5><?php  echo $course["teacher"];?></h5></a>
                                                <!--span> full stack developer</span>
                                                <ul class="social">
                                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                </ul-->
                                            </div>
                                        </div>
                                        <div class="instructor-description pt-25">
                                            <p><?php  echo $course["teacherEmail"];?></p>
                                        </div>
                                    </div> <!-- instructor cont -->
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="reviews-cont">
                                        <div class="title">
                                            <h6>تقييمات الطلاب</h6>
                                        </div>
                                        <ul id="commentsList">
                                           
                                           <?php 
                                                                                           
                                                if ($re = $conn -> query("SELECT * FROM `Ccomment` WHERE `c_id` =". $course["id"]))   //subject
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
                                                                                                        <div class="rating">
                                                                                                            <ul>';
                                                                                                            for($i=0;$i<$r[5];$i++)
                                                                                                                    echo '<li><i class="fa fa-star"></i></li>';
                                                                                                                
                                                                                    echo '
                                                                                                            </ul>
                                                                                                            <span>/ '.$r[5].' Star</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> <!-- singel reviews -->
                                                                                           </li>
                                                                                   ';
                                                                           }}


                                           ?>
                                        </ul>
                                        <div class="title pt-15">
                                            <h6>اترك تعليق</h6>
                                        </div>
                                        <div class="reviews-form">
                                            <form action="#">
                                                <div class="row">
                                                    <!--div class="col-md-6">
                                                        <div class="form-singel">
                                                            <input type="text" placeholder="الاسم الاول">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                            <input type="text" placeholder="الاسم الاخير">
                                                        </div>
                                                    </div-->
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <div class="rate-wrapper">
                                                                <div class="rate-label">تقييمك:</div>
                                                                <div class="rate" >
                                                                    <div id="s1" class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div id="s2" class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div id="s3" class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div id="s4" class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div id="s5" class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <textarea  id="comment" placeholder="تعليقك"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                        
                                                         <script type="text/javascript">
                                                                        function rate()
                                                                        {
                                                                                for(var i =1; i<=5; i++){
                                                                                        if (document.getElementById("s"+i).className =="rate-item active")
                                                                                                return i;
                                                                                }
                                                                                
                                                                        }
                                                                        
                                                        </script>
                                                        <?php
                                                          
                                                          
                                                          echo '
                                                                <script type="text/javascript">
                                                                      
                                                                
                                                                
                                                                        function  addComment()
                                                                        { var data = new FormData();
                                                                          data.append("do", "NewComment");
                                                                          data.append("text",document.getElementById("comment").value.replace(/\s/g, "\u00a0") );
                                                                          data.append("star", rate());
                                                                          data.append("cid", '.$course["id"].');
                                                                          
                                                                          
                                                                        
                                                                          var xhr = new XMLHttpRequest();
                                                                          xhr.open("POST", "php/coures.php");
                                                                          xhr.onload = function() {
                                                                                  if (this.responseText != 0)
                                                                                          {   
                                                                                                  //alert(this.responseText);
                                                                                                  document.getElementById("comment").value="";
                                                                                                  for(var i =1; i<=5; i++){
                                                                                                        if (document.getElementById("s"+i).className =="rate-item active")
                                                                                                                document.getElementById("s"+i).className ="rate-item";
                                                                                                 
                                                              
                                                                                          }
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
                                                          ?>
                                                            <button type="button" class="main-btn" onclick="addComment()">اضافة</button>
                                                        </div>
                                                    </div>
                                                </div> <!-- row -->
                                            </form>
                                        </div>
                                    </div> <!-- reviews cont -->
                                </div>
                            </div> <!-- tab content -->
                        </div>
                    </div> <!-- corses singel left -->
                    
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="course-features mt-30">
                               <h4>معلومات سريعة عن الدورة </h4>
                                <ul>
                                    <?php 
                                            if ($rx = $conn -> query("SELECT * FROM `enroll` WHERE `c_id` =".$course["id"])) //student numbers
                                                           $course["students"]= $rx-> num_rows;
                                                
                                            if ($rx= $conn -> query("SELECT * FROM `test` WHERE `cid`=".$course["id"])) //tests numbers
                                                           $course["tests"]= $rx -> num_rows;
                                                   
                                    ?>
                                    <li><i class="fa fa-clock-o"></i>مدة الدورة : <span><?php echo   $course["time"] ;?> ساعة</span></li>
                                    <li><i class="fa fa-book" ></i>عدد المحاضرات: <span><?php echo  $course["lectures"] ;?></span></li>
                                    <li><i class="fa fa-beer"></i>الاختبارات :  <span><?php echo     $course["tests"] ;?></span></li>
                                    <li><i class="fa fa-user"></i>عدد الطلاب  :  <span><?php echo $course["students"]." / ". $course["Max"] ;?></span></li>
                                    <li dir="rtl"><span>تنتهي الدوره في : <?php echo $course["MaxTime"] ;?></span></li>
                                </ul>
                                <div class="price-button pt-10">
                                    <span><b><?php echo $course["cost"] ;?></b> :السعر </span>
                                    <?php
                                                          
                                                          echo '
                                                                <script type="text/javascript">
                                                                      
                                                                
                                                                
                                                                        function  enroll()
                                                                        { var data = new FormData();
                                                                          data.append("do", "Enroll");
                                                                          data.append("cid", '.$course["id"].');
                                                                          
                                                                          
                                                                        
                                                                          var xhr = new XMLHttpRequest();
                                                                          xhr.open("POST", "php/coures.php");
                                                                          xhr.onload = function() {
                                                                          

                                                                                  if (this.responseText == 0)
                                                                                          { 
                                                                                          document.getElementById("m").innerHTML= "..عليك تسجيل الدخول اولا";                                                                                          
                                                                                          document.getElementById("mf").innerHTML= "  <button class= '."  'btn btn-secondary'  ".' data-dismiss= '."  'modal'  ".' >اغلق </button><button class='."  'btn btn-primary'  ".' ><a href='."  'login-singup.html'  ".' ><p class='."  'text-white'  ".' >اتسجيل الدخول</p></a></button>";                                                                                          
                                                                                          //location.href = "http://i-learn.atwebpages.com/login-singup.html";
                                                                                          
                                                                                          }
                                                                                  else
                                                                                          {
                                                                                          
                                                                                          document.getElementById("m").innerHTML= this.responseText;
                                                                                          document.getElementById("mf").innerHTML= "  <button class= '."  'btn btn-secondary'  ".' data-dismiss= '."  'modal'  ".' >اغلق </button><button class='."  'btn btn-primary'  ".' ><a href='."  'courseDes.php?c=".$course["id"]."&l=1' ".' ><p class='."  'text-white'  ".' >الذهاب لصفحه المساق</p></a></button>";                                                                                          
                                                                                          //location.href = "http://i-learn.atwebpages.com/"; 

                                                                                          }
                                                                          };
                                                                            
                                                                          xhr.send(data);
                                                                                
                                                                        }
                                                                </script>
                                                                ';
                                                          ?>
                                                          
<!--Enroll------------------------------------------------->
<?php
if ($course["students"]==$course["Max"])
        echo ' <h5 class="text-danger float-right mt-2">اكتمل العدد </h5>';
else if (!("".date("Y-m-d")." ".date("H:i:s") <= $course["MaxTime"] || $course["MaxTime"]==null ))
        echo '<h5 class="text-danger float-right  mt-2"> انتهى وقت التسجيل </h5>';
else
        echo ' <a href="" onclick="enroll()" class="main-btn"  data-toggle="modal" data-target="#exampleModalCenter" >سجل الان</a>';

?>

                                   
                                
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">التسجيل للدوره </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
                <p class="text-center" id="m"></p>
      </div>
      <div class="modal-footer" id= "mf">

      </div>
    </div>
  </div>
</div>



<!------------------------------------------------->
                                </div>
                            </div> <!-- course features -->
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="You-makelike mt-30">
                                <h4>قد يعجبك ايضا </h4>
                                <?php
                                   $i=0;   
                                if ($result = $conn -> query( " SELECT * FROM `course` WHERE `s_id`=".$course["SubjectId"]." OR `title` LIKE '%".$course["title"]."%' OR `desc` LIKE '%".$course["title"]."%' "))  
                                          while ($row = $result -> fetch_row() ) 
                                             {
                                             if ($i>2) break;
                                             $i++;
                                             
                                                                                             
                                              if ($rEnroll = $conn -> query("SELECT * FROM `enroll` WHERE `c_id`=".$row[0])) 
                                                                                            $num= $rEnroll -> num_rows;
                                              
                                             echo '
                                                                     
                                                        <div class="singel-makelike mt-20">
                                                            <div class="image">
                                                                <img src="images/your-make/y-1.jpg" alt="Image">
                                                            </div>
                                                            <div class="cont">
                                                                <a href="courses-singel.php?id='.$row[0].'"><h4>'.$row[2].'</h4></a>
                                                                <ul>
                                                                    <li><a href=""><i class="fa fa-user"></i>'.$num.'</a></li>
                                                                    <li>'.$row[3].'</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                
                                             
                                             ';
                                             }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="releted-courses pt-95">
                        <div class="title">
                            <h3>قد يعجبك </h3>
                        </div>
                        
                        <div class="row">

                        <?php 
                                     $j=1;   
                                if ($result = $conn -> query( " SELECT * FROM `course` WHERE `s_id`=".$course["SubjectId"]." OR `title` LIKE '%".$course["title"]."%' OR `desc` LIKE '%".$course["title"]."%' ORDER BY `s_id`"))  
                                          while ($row = $result -> fetch_row() ) 
                                             {
                                             if ($j>2) break;
                                             $j++;
                                             echo '
                                                             
                                                                             
                                                                              <div class="col-md-6">
                                                                <div class="singel-course mt-30">
                                                                    <div class="thum">
                                                                        <div class="image">';
                                                                        
                                                                        
                                               if ($row[5] == null)
                                                    echo '<img src="images/course/cu-1.jpg" alt="Course"  width="350" height="250">';
                                               else echo '<img src="'.'data:image/jpeg;base64,' . base64_encode($row[5]).'" alt="Course"  width="350" height="250">';                    
                                                                    
                                             echo '

                                                                        </div>
                                                                        <div class="price">
                                                                            <span>'.$row[3].'</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont">
                                                                        <ul>';
                                         $stars =0;
                                         if ($re = $conn -> query("SELECT `star` FROM `Ccomment` WHERE `c_id`=".$row[0]))  
                                                             while ($ro = $re -> fetch_row()) 
                                                              $stars += $ro [0];
                                                              
                                                              if ( $re -> num_rows!=0)
                                                              $stars /= $re -> num_rows; 
                                                              
                                                              for ($i=0; $i< $stars ;$i++ )
                                                              echo '<li><i class="fa fa-star"></i></li>';                                                                   
                                                                        
                                             echo '</ul>
                                                                        <span>('.$row[4].' تقييم)</span>
                                                                        <a href="courses-singel.php?id='.$row[0].'"><h4>'.$row[2].'</h4></a>
                                                                        <div class="course-teacher">
                                                                             <div class="thum">';
                                                                           if ($rTeacher = $conn -> query("SELECT `name`,`photo` FROM `user` WHERE `ID`=".$row[7])) 
                                                                             while ($rr = $rTeacher -> fetch_row()) 
                                                                             {
                                                                                     $name=$rr[0];  
                                                                                     if($rr[1]!= null)
                                                                                        $photo='data:image/jpeg;base64,' . base64_encode($rr[1]);
                                                                                  else  $photo= "assets/img/other_profile.png";  
                                                                                                             
                                                                                                     }
                                                                                                                                                     
                                                                                if ($rEnroll = $conn -> query("SELECT * FROM `enroll` WHERE `c_id`=".$row[0])) 
                                                                                                                            $num= $rEnroll -> num_rows;
                                                                                                                              
                                                                               echo ' 
                                                                                            <a href="#"><img src="'.$photo.' " alt="teacher"></a>
                                                                                        </div>
                                                                                        <div class="name">
                                                                                        
                                                                                                                                         
                                                                                            <a href="profile.html?id='.$row[7].'"><h6>'.$name.'</h6></a>
                                                                                        </div>
                                                                                        <div class="admin">
                                                                                            <ul>
                                                                                                <li><a><i class="fa fa-user"></i><span> '.$row[10].' / '.$num.'  </span></a></li>
                                
                                                                                            </ul>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> <!-- singel course -->
                                                                                            </div>
                                             ';
                                             }
                                          
                        ?>
                        
                        </div> <!-- row -->
                    </div> <!-- releted courses -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== COURSES SINGEl PART ENDS ======-->
       

                <!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
        <div class="copyright">
            &copy; Copyright
            <strong>
                <span>I-LEARN TEAM</span>
            </strong>
            . All Rights Reserved
        </div>
    </div>
</footer>
<!-- End Footer -->
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