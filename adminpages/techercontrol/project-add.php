<?php


include ("../../php/database.php");


if (isset($_POST['submit']))
{

$title   = $_POST["title"];
$des     = $_POST["des"];
$subject = $_POST["subject"];
$cost    = $_POST["cost"];
$time    = $_POST["time"];
$maxSize = $_POST["maxSize"];
$date    = $_POST["date"];
$teacher = $_POST["teacher"];
$photo = null;

if ($date =="00-00-0000" ) $date =null;
if ($maxSize ==0 ) $maxSize =null;
if ($cost ==0 ) $cost ='free';
else $cost.="$";

        if ($_FILES['photoFile']['tmp_name'])
        if (getimagesize($_FILES['photoFile']['tmp_name']) != false)
                $photo = addslashes(file_get_contents(($_FILES['photoFile']['tmp_name'])));
                
          $q= "INSERT INTO `course` (`id`, `s_id`, `title`, `cost`, `rate`, `photo`, `show_`, `teacher_id`, `desc`, `time`, `max_length`, `end_time`) VALUES (NULL, '$subject', '$title', '$cost', '0' ,'$photo', '0', '$teacher', '$des', '$time', '$maxSize', '$date');";
          if ($result = $conn -> query($q))
          {
                  if ($result = $conn -> query("SELECT `id` FROM `course` ORDER BY `course`.`id` DESC"))
                    { while ($row = $result -> fetch_row())
                     {$i =$row[0]; break;}
                          header("location:project-edit.php?id=".$i);}
          }
              
          else
                  echo "<br /><div class='alert alert-danger' role='alert'>خطأ : لم يتم اضافه الدورة حاول مجددا </div><br />";
                
}


include ("../../php/userInfo.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>اضافة دورة</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
          <img id ="adminPhoto" src="" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" id="adminName" class="d-block"></a>
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
          
            <a href="techercontrol.html" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                لوحة التحكم
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          
                   
        
          
          
          <li class="nav-item">
            <a href="projects.html" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                
			الدورات التي نشرتها
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="project-add.html" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                اضافة دورة
                <i class="fas fa-angle-left right"></i>
              </p>
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
            <h1>اضافة دورة</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="techercontrol.html">الرئيسيه</a></li>
              <li class="breadcrumb-item active">اضافة دورة</li>
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
              <h3 class="card-title">عام</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" >
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">اسم الدورة</label> <input type="text" name="title" id="inputName" class="form-control" required>  
              </div>
              <div class="form-group">
                <label for="inputDescription">وصف الدورة</label>
                <textarea name="des"  id="inputDescription" class="form-control" rows="4" ></textarea>
              </div>
              <div class="form-group" id="subjectSelect">
                <label for="inputStatus">الموضوع</label>
                
                </div>
                 <script>
                                         var xmlhttp = new XMLHttpRequest();
                                         xmlhttp.onreadystatechange = function() {
                                         if (this.readyState == 4 && this.status == 200) {
                                         
                                         document.getElementById("subjectSelect").innerHTML+=(this.responseText);
                                         
                                         } };
                                          xmlhttp.open("GET","../../../php/coures.php?do=subjectSelect",true);
                                          xmlhttp.send();
                               
        </script>
        
        <div class="form-group">
                <label for="inputProjectLeader">رقم المدرس</label> 
                <?php
                        echo '<input disabled required type="text" name="teacher" value="'.$id.'" id="inputProjectLeader" class="form-control">';
                ?>
              </div>
              
        <div class="form-group">
                <label for="photoFile">حمل صورة</label><br> <input type="file" id="photoFile" name='photoFile'>
              </div>



            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">تفاصيل</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">سعر الدورة</label> <input required type="number" name="cost" id="inputEstimatedBudget" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">الجهد المطلوب بالساعات</label> <input required type="number"  name="time" id="inputSpentBudget" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">العدد الاقصى</label> <input  type="number" name="maxSize"  id="inputEstimatedDuration" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDate">تاريخ نهاية الدورة</label> <input  type="date" name="date" id="inputEstimatedDate" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">

          <input type="submit" name="submit" value="انشاء دورة جديدة" class="btn btn-success float-right m-3">
        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
  
    <strong>Copyright &copy; 2014-2021 <a href="#">mohnad</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src=".../dist/js/demo.js"></script>
</body>
</html>
