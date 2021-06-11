<!DOCTYPE html>

<?php 

include ("database.php");


//subject information 
$subject = ["id" =>  $_GET['id'] ,"title" => "" ,"num"=>0];   
        if ($result = $conn -> query("SELECT * FROM `subject` WHERE `id`=".$subject["id"]))  
                     while ($row = $result -> fetch_row()) 
                             $subject["title"]=$row[1]; 
// type of courses
$t =$_GET['where'] ;
if ($t!= 1)
$q = "SELECT * FROM `course` WHERE `s_id` =".$subject["id"]." AND `show_` = 1 AND `title` LIKE '%".$t."%' OR `desc` LIKE '%".$t."%'";
else 
$q = "SELECT * FROM `course` WHERE `s_id` =".$subject["id"]."  AND `show_` = 1";
                                                          
        if ($result = $conn -> query($q))  
                       $subject["num"] =$result-> num_rows;
                             
        
?>


<html dir="rtl" lang="ar">
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
                            <a class="nav-link scrollto " href="courses.html">الدورات التدريبية</a>

                        </li>
                        <li>
                            <a class="nav-link scrollto" href="question.html">الاسئله</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="index.html#team">فريقنا</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="index.html#contact">تواصل معنا</a>
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
            <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                    <?php 
                    
                             echo '<h2>'.$subject["title"].'</h2>';
                             ?>
                        
                        <nav aria-label="breadcrumb" dir="ltr">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="courses.html">الدورات التدريبية</a> </li>
                                <li class="breadcrumb-item">
                                        <?php echo '<a href="http://i-learn.atwebpages.com/courses.php?id='. $subject["id"].'&where=1"> '. $subject["title"].'</a>';?>
                                </li>
                                <?php 
                                if ($t ==1)
                                        echo '<li class="breadcrumb-item active" aria-current="page"> الكل </li>';
                                else 
                                        echo '<li class="breadcrumb-item active" aria-current="page">'.$t.'</li>';
                                ?>
                                
                            </ol> 
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
            <!-- end hero Section -->
          <!--====== COURSES PART START ======-->
    
    <section id="courses-part" class="gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <ul class="nav float-left" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid" role="tab" aria-controls="courses-grid" aria-selected="true"><i class="fa fa-th-large"></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab" aria-controls="courses-list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                            </li>
                            
                            <?php 
                                    
                             echo '<li class="nav-item">العدد الكلي : '.$subject["num"].'</li>';
                             ?>

                        </ul> <!-- nav -->
                        
                        <div class="courses-search float-right" dir ="ltr" >
                                <input type="text" id ="textSearch" placeholder="بحث">
                                
                                <?php echo '<script type="text/javascript">
                                
                                        function search()
                                        { 
                                          var t =document.getElementById("textSearch").value.replace(/\s/g, "\u00a0");
                                          location.href = "http://i-learn.atwebpages.com/courses.php?id='.$subject["id"].'&where="+t; 
                                       
                                                                                   
                                         }                                                   
                                </script>';
                                ?>
                                
                                <button onclick ="search()"><i class="fa fa-search"></i></button>
                                
                              
                            
                        </div> <!-- courses search -->
                    </div> <!-- courses top search -->
                </div>
            </div> <!-- row -->
            <div class="tab-content" id="myTabContent">
              
               <!------------------------------------------------------------------------------------------------>
                   <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">
                   <?php 
                       
                              if ($result = $conn -> query($q)) 
                                      while ($row = $result -> fetch_row()) 
                                             {
                                               echo '
                                                        <div class="col-lg-4 col-md-6" >
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

                                               echo '
                                                    
                                                                    </ul>
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
                                            </div>
                                                                        <!-- singel course -->
                                        </div>
                                       
                                               ';
                                             }
                     
                    
                    ?>
               <!------------------------------------------------------------------------------------------------>    

                    </div> <!-- row -->
                </div>
                <div class="tab-pane fade" id="courses-list" role="tabpanel" aria-labelledby="courses-list-tab">
                    <div class="row">
                    
                  <?php 
                       
                              if ($result = $conn -> query($q)) 
                                      while ($row = $result -> fetch_row()) 
                                             {
                                               echo '
                                                        <div class="col-lg-12">
                                                            <div class="singel-course mt-30">
                                                            
                                                  <!------------------------------------------------------------->
                                                            
                                                            <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="thum">
                                            <div class="image">';
                                               if ($row[5] == null)
                                                    echo '<img src="images/course/cu-1.jpg" alt="Course">';
                                               else echo '<img src="'.'data:image/jpeg;base64,' . base64_encode($row[5]).'" alt="Course">';                    
                                                                    
                                               echo ' </div>
                                            <div class="price">
                                                <span>'.$row[3].'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cont">
                                            <ul>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
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
                                                                     
                                                    <a href="#"><img src="'.$photo.'" alt="teacher"></a>
                                                </div>
                                                <div class="name">
                                                    <a href="#"><h6>'.$name.'</h6></a>
                                                </div>
                                                <div class="admin">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-user"></i><span>'.$num.'</span></a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></div></div> <!--  row  -->
                                               ';
                                             }
                     
                    
                    ?>
               <!------------------------------------------------------------------------------------------------>    
  
                    
                    
                    
                    
                          <!-- row -->
         </div>
                                </div></div></div> <!-- container -->
                                
                                
<!--------if no courses------------> 
<?php
if ($subject["num"] ==0)
 echo '<p class="text-center m-5 p-5">لا يوجد نتائج .</p>';

?> 
    </section>
    
    <!--====== COURSES PART ENDS ======-->
   
       

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