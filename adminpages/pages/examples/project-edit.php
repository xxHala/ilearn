<?php 
include ("../../../php/database.php");

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
                                              
                             $course["teacherId"]=$row[7]; 
                                              
                             $course["title"]=$row[2]; 
                             $course["rate"]=$row[4]; 
                             $course["desc"]=$row[8]; 
                             $course["time"]=$row[9]; 
                             $course["cost"] =$row[3]; 
                             $course["SubjectId"]=$row[1];
                             
                             $course["Max"]=$row[10];
                             $course["MaxTime"] = $row[11];

                             if ($row[5] == null)
                                  $course["photo"]= ' ../../../images/course/cu-1.jpg';
                             else $course["photo"] =' data:image/jpeg;base64,' . base64_encode($row[5]);                    
                                                          
                             $photo   = $row[5];
                     }
         
         
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['submit']))
{


$title   = $_POST["Title"];
$des     = $_POST["Des"];
$subject = $_POST["subject"];
$cost    = $_POST["Cost"];
$time    = $_POST["Time"];
$maxSize = $_POST["MaxSize"];
$date    = $_POST["Date"];
$teacher = $_POST["Teacher"];


if ($date =="00-00-0000" ) $date =null;
if ($maxSize ==0 ) $maxSize =null;
if ($cost ==0 ) $cost ='free';

        if ($_FILES['Photo']['tmp_name'])
        if (getimagesize($_FILES['Photo']['tmp_name']) != false)
                $photo = addslashes(file_get_contents(($_FILES['Photo']['tmp_name'])));
                
          $q = "UPDATE `course` SET `s_id`= $subject ,`title`='$title',`cost`= '$cost' ,`teacher_id`= $teacher ,`desc`= '$des' ,`time`= $time ,`max_length`= $maxSize ,`end_time`= '$date' WHERE  `id`=".$course["id"]." AND`s_id`=".$course["SubjectId"].";";
          $q2= "UPDATE `course` SET `photo`= '$photo' WHERE  `id`=".$course["id"]." AND`s_id`=".$course["SubjectId"].";";
         if ($result = $conn -> query($q))
         if ($result = $conn -> query($q2))
                       header("location:project-edit.php?id=".$course["id"]);
           
          else
                  echo "<br /><div class='alert alert-danger' role='alert'>خطأ : لم يتم تعدبل الدورة حاول مجددا</div><br />";
                
}


///////////////////////////////////////////////////////

   

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> تعديل الدورة</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.html" class="nav-link">الصفحه الرئيسيه</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

        
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">3 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 رسائل جديد
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> معلم جديد
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> لديك طلب 
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=""  id="adminPhoto" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block" id="adminName"></a>
        </div>
      </div>
      
           
      <script>
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         if (this.responseText) 
                                         {
                                         document.getElementById("adminName").innerHTML=(this.responseText);
                                         }
                                         } };
                                          xmlhttp.open("GET","../../../php/userInfo.php?do=getname",true);
                                          xmlhttp.send();
                               
        </script>
    
      <script>
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         if (this.responseText) 
                                         {
                                         document.getElementById("adminPhoto").src=(this.responseText);
                                         }
                                         } };
                                          xmlhttp.open("GET","../../../php/userInfo.php?do=getPhoto",true);
                                          xmlhttp.send();
                               
        </script>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            <a href="../../index.html" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                لوحة التحكم
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
  
          
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                
			الرسائل
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mailbox/mailbox.html" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>صندوق الوارد</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../mailbox/compose.html" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ارسال رسااله</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../mailbox/read-mail.html" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>المقروء</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                الصفحات
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../examples/invoice.html" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>الدفع</p>
                </a>
              </li>
            
              
              <li class="nav-item">
                <a href="projects.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>الدورات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="project-add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اضافة دورة</p>
                </a>
              </li>
             
             
               <li class="nav-item">
                <a href="techers.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>المدرسين</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="students.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>الطلاب</p>
                </a>
              </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>تعديل الدورة</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../">الرئيسيه</a></li>
              <li class="breadcrumb-item active">تعديل الدورة</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<form action="" method="post" enctype="multipart/form-data">  

<!-- Main content -->
    <section class="content">
      <div class="row"> 
      
      <div class="col-md-6">
              <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">الرئيسيه</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                     </div>
                      
                      <div class="card-body">
                            
                                  <?php echo '<img class="card-img-top" src="'.$course["photo"].'" alt="course photo" >';?>
                                              <input type="file" name='Photo'>
                        
                              <div class="form-group">
                                <label for="inputName">اسم الدورة</label>
                                <?php echo ' <input type="text" id="inputName" class="form-control" name="Title" value="'.$course["title"].'"> ';?>
                              </div>
                              <div class="form-group">
                                <label for="inputDescription">عن الدورة</label>
                                <?php echo ' <textarea name="Des" id="inputDescription" class="form-control" rows="4">'.$course["desc"].'</textarea>  ';?>
                               
                              </div>
                              <div class="form-group" id="subjectSelect">
                                <label for="inputStatus">الموضوع</label>
                                
                                </div>
                                <?php
                                echo'
                                        <script>
                                                         var xmlhttp = new XMLHttpRequest();
                                                         xmlhttp.onreadystatechange = function() {
                                                         if (this.readyState == 4 && this.status == 200) {
                                                         
                                                         document.getElementById("subjectSelect").innerHTML+=(this.responseText);
                                                         document.getElementById("'.$course["SubjectId"].'").selected = "true";
                                                         
                                                         } };
                                                          xmlhttp.open("GET","../../../php/coures.php?do=subjectSelect",true);
                                                          xmlhttp.send();
                                                          
                                        </script>';
                        ?>
                              
                              <div class="form-group">
                                <label for="inputProjectLeader">المدرس</label>
                                 <?php
                                echo
                                '
                                <div class="user-panel pb-3 mb-3 d-flex">
                                        <div class="image">
                                          <img src="'.$course["teacherPhoto"].'" id="adminPhoto" class="img-circle elevation-2" alt="User Image">
                                        </div>
                                        <div class="info">
                                          <a href="profile.php?id='.$course["teacherId"].'" class="d-block" id="adminName">'.$course["teacher"].' </a>
                                        </div>
                                        <input type="text" name="Teacher" id="inputProjectLeader" class="form-control w-75 ml-3" value="'.$course["teacherId"].' ">
                                      </div>
                                
                
                                ';
                                ?>
                              </div>
                        </div>   <!-- /.card-body -->
              </div>
      </div>


        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">معلومات</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            
              <div class="form-group">
                <label for="inputEstimatedBudge">عدد المسجلين</label>
                <?php

                 if ($rx = $conn -> query("SELECT * FROM `enroll` WHERE `c_id` =".$course["id"])) //student numbers
                         $course["students"]= $rx-> num_rows;
                                                
                echo ' <input disabled type="number" id="inputEstimatedBudge" class="form-control" value="'.$course["students"].'" >';
                ?>

              </div>
              <div class="form-group">
                <label for="inputEstimatedBudget">سعر الدورة</label>
                 <?php              
                echo '<input required type="text" name="Cost" id="inputEstimatedBudget" class="form-control" value="'.$course["cost"].'">';
                ?>
                
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">الحد الاقصى</label>
                 <?php              
                echo '  <input type="number" name="MaxSize" id="inputSpentBudget" class="form-control" value="'.$course["Max"] .'" step="1"> ';
                ?>

              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">الجهد المطلوب بالساعات</label>
                 <?php              
                echo '<input type="number" name="Time" id="inputEstimatedDuration" class="form-control" value="'.$course["time"].'" step="0.1">';
                ?>
              </div>
              
              <div class="form-group">
                <label for="inputEstimatedDate">تاريخ نهاية الدورة</label>
               <?php              
                echo ' <input  type="date" name="Date" id="inputEstimatedDate" class="form-control" value="'.$course["MaxTime"].'">';
                ?>
              </div>
            </div> <!-- /.card-body -->
              </div>

      
      
       <div class="card card-info">
          
            <div class="card-header">
              <h3 class="card-title">المحاضرات</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
           <div class="card-body p-1">
            <table class="table">
            <!-- /thead-->
                <thead>
                  <tr>
                    <th>#</th> 
                    <th>اسم المحاضرة</th>
                    <th></th>
                  </tr>
                </thead>
            <!-- /tbody-->
               <tbody>
                 
               </tbody>
                <?php 
                                                 if ($result = $conn -> query("SELECT * FROM `lecturer` WHERE `c_id`=".$course["id"]." ORDER BY `id` ")) 
                                                 {  $course["lectures"]= $result -> num_rows;
                                                                     while ($row = $result -> fetch_row()) 
                                                                     {
                                                                      $v=$row[5];
                                                                      if ($row[5])
                                                                          $v ='https://youtu.be/'.substr($row[5],31);
                                                                       
                        
                                                echo '
                                                  <tr id="l'.$row[0].'">
                                                    <td>'.$row[0].'</td>
                                                    <td>'.$row[2].'</td>

                                                    <td class="text-right py-0 align-middle">
                                                      <div class="btn-group btn-group-sm">
                                                        <button  class="btn btn-info" data-toggle="modal" data-target="#exampleModal'.$row[0].'"><i class="fas fa-eye"></i> </button>
                                                        <button onclick="dleteL('.$row[0].','.$row[1].')"  class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                      </div>
                                                    </td>
                                                    </tr> 
                                                    
                                                     
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal'.$row[0].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel'.$row[0].'" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel'.$row[0].'">تفاصيل المحاضره</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                
                                                                     <div class="form-group">
                                                                        <label>العنوان</label>
                                                                        <input  value="'.$row[2].'" type="text" id="LEt'.$row[0].'" class="form-control" >
                                                                      </div>
                                                                       <div class="form-group">
                                                                        <label>الوصف</label>
                                                                        <textarea  id="LEd'.$row[0].'" class="form-control" rows="4" >'.$row[3].'</textarea>
                                                                      </div>
                                                                      
                                                                       <div class="form-group">
                                                                        <label>المحتوى</label>
                                                                        <textarea  id="LEc'.$row[0].'" class="form-control" rows="4">'.$row[6].'</textarea>
                                                                      </div>
                                                                      
                                                                       <div class="form-group">
                                                                        <label>رابط الفيديو</label>
                                                                        <input value="'.$v.'" type="text" id="LEv'.$row[0].'" class="form-control" >
                                                                      </div>
                                                                      
                                                                      <div class="form-group">
                                                                        <label>الوقت </label>
                                                                        <input  value="'.$row[4].'" type="text" id="LEtime'.$row[0].'" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}"   class="form-control" >
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                                        <button type="button" class="btn btn-primary" onclick="editL('.$row[0].','.$row[1].')">حفظ التعديلات</button>
                                                                      </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                ';
                                             }}
                                             
                                             
                                             
                                             ?>
                                             
                               
                                      <script type="text/javascript"> 
                                      
                                     
                                      function dleteL (id ,cid)
                                          {
                                        var data = new FormData();
                                        data.append("do", "dleteL");
                                        data.append("lid", id);
                                        data.append("cid", cid);

                                                                   
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.open("POST", "../../../php/coures.php");
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         
                                         if (this.responseText)
                                         {
                                          document.getElementById("l"+id).style.display = "none";
                                         }
                                         alert ("تم حذف المحاضره");
                                         }
                                         } ;
                                         xmlhttp.send(data);
                                          }
                                          
                                          function editL (id ,cid)
                                          {
                                        var data = new FormData();
                                        data.append("do", "editL");
                                        data.append("lid", id);
                                        data.append("cid", cid);
                                        data.append("title"  ,document.getElementById("LEt"+id).value.replace(/\s/g, "\u00a0") );
                                        data.append("desc"   ,document.getElementById("LEd"+id).value.replace(/\s/g, "\u00a0") );
                                        data.append("content",document.getElementById("LEc"+id).value.replace(/\s/g, "\u00a0") );
                                                                          
                                        var x=document.getElementById("LEv"+id).value.substring(17);
                                        data.append("video"  , x);
                                        data.append("time"   ,document.getElementById("LEtime"+id).value);     
                                        
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.open("POST", "../../../php/coures.php");
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         alert ("تم تعديل المحاضره");
                                         location.href = "project-edit.php?id="+cid; 
                                         }
                                         } ;
                                         xmlhttp.send(data);
                                          }
                  
                                      </script>                                             
                                                                   
                                     <tr >
                                        <td colspan="4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary float-rghit" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-plus"></i> اضافة محاضرة
                                        </button>
                                       </td>
                                      </tr> 
                                      
            </table>
            		
           </div>           
                         
       </div>

      
      
      
      
      </div>
      
     
    </section>

 <div class="row">
        <div class="col-12 p-3">
          <a href="projects.html" class="btn btn-secondary">الغاء</a>
          <input type="submit" name="submit" value="حفظ" class="btn btn-success float-right"/>
        </div>
      </div>
      
</form>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">اضافه محاضره</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                                 <!-----------------------New lectuer----------------------------------->
                                              <div class="modal-body">

                                                               
                                                                     <div class="form-group">
                                                                        <input  placeholder="العنوان" type="text" id="Lt" class="form-control" name="title">
                                                                      </div>
                                                                       <div class="form-group">
                                                                        <textarea placeholder="الوصف" name="des"  id="Ld" class="form-control" rows="4" ></textarea>
                                                                      </div>
                                                                      
                                                                       <div class="form-group">
                                                                        <textarea placeholder="المحتوى" name="des"  id="Lc" class="form-control" rows="4" ></textarea>
                                                                      </div>
                                                                      
                                                                       <div class="form-group">
                                                                        <input placeholder="رابط الفيديو" type="text" id="Lv" class="form-control" name="title">
                                                                      </div>
                                                                      
                                                                      <div class="form-group">
                                                                        <input  placeholder="الوقت 00:00:00" type="text" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" id="Ltime" class="form-control" required>
                                                                      </div>
                                                               

                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                <?php 
                                             
                                                        echo '<button type="button"  onclick="addL()"  class="btn btn-primary">حفظ</button>
                                                
                                                 <script type="text/javascript">
                                                                
                                                                        function  addL()
                                                                        {
                                                                         
                                                                          var data = new FormData();
                                                                          data.append("do", "NewL");
                                                                          data.append("title"  ,document.getElementById("Lt").value.replace(/\s/g, "\u00a0") );
                                                                          data.append("desc"   ,document.getElementById("Ld").value.replace(/\s/g, "\u00a0") );
                                                                          data.append("content",document.getElementById("Lc").value.replace(/\s/g, "\u00a0") );
                                                                          
                                                                          var x=document.getElementById("Lv").value.substring(17);
                                                                          data.append("video"  , x);
                                                                          data.append("time"   ,document.getElementById("Ltime").value);
                                                                          data.append("cid"    ,'.$course["id"].'  );

                                                                        
                                                                          var xhr = new XMLHttpRequest();
                                                                          xhr.open("POST", "../../../php/coures.php");
                                                                          xhr.onload = function() { 
                                                                          if (this.responseText ==0)
                                                                             alert("لم يتم اضافه المحاضرة حاول مره اخرى");
                                                                          else
                                                                          {
                                                                                alert("تمت الاضافه");
                                                                                location.href = "project-edit.php?id='.$course["id"].'"; 
                                                                          } 
                                                                          };
                                                                            
                                                                          xhr.send(data);
                                                                                
                                                                        }
                                                 </script> ';?>
                                              </div>
                                                 <!---------------------------------------------------------->
                                            </div>
                                          </div>
                                        </div>
                                                                              
                                     






  <footer class="main-footer">
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
