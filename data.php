<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php
include ("database.php");

$do = $_REQUEST["do"];
// get user name
if ($do[0] =='n')
{
	session_start(); 
	$print=$_SESSION['name'];
	echo $print;
}
//--- data for check email in sign up -------------------------------------------------------------------

if ($do[0] =='E')
{

$email="";
for($i =1; $i<strlen($do); $i++)
 $email.= $do[$i];

$q="SELECT `email` FROM `user` WHERE `email` = '$email' ";
	$r1 =mysqli_query($conn, $q);
	$row = mysqli_fetch_row( $r1 );
	 if(isset($row ) ){
$print ='<i class="material-icons" style="color:red ; float:right" >error</i>
	 <h3 style="color:red;float:left">المستخدم موجود الرجاء تسجيل الدخول</h3>';
echo $print;
}
else
echo "";

}

//--- data for check email in sign in -------------------------------------------------------------------
if ($do[0] =='e')
{
$email="";
for($i =1; $i<strlen($do); $i++)
 $email.= $do[$i];

$q="SELECT `email` FROM `user` WHERE `email` = '$email' ";
	$r1 =mysqli_query($conn, $q);
	$row = mysqli_fetch_row( $r1 );
	 if(!isset($row ) ){
$print ='<i class="material-icons" style="color:red ; float:right" >error</i>
	 <h3 style="color:red;float:left">المستخدم غير موجود الرجاءانشاء حساب</h3>';
echo $print;   }
else
echo "";

}

//--- data for check pass -------------------------------------------------------------------
if ($do[0] =='p')
{
$email="";
for($i =1; $i<strlen($do); $i++)
 $email.= $do[$i];
 
$pass = $_REQUEST["pass"];

$q="SELECT `password` FROM `user` WHERE `email` = '$email' ";
	$r1 =mysqli_query($conn, $q);
	$row = mysqli_fetch_row( $r1 );
        
        
	 if(isset($row ) ){
        if($row!=$pass){
$print ='<i class="material-icons" style="color:red ; float:right" >error</i>
	 <h3 style="color:red;float:left">خطأ في كلمة المرور </h3>';
	 echo $print;   }}
else
echo "";

}






//--- data for jobs-------------------------------------------------------------------
if ($do[0] =='J')
{

 $print = "";



// Check connection
if ($conn) {

if ($result = $conn -> query("SELECT * FROM job")) {
    
     $n= $result -> num_rows;
     $pages=ceil($n /10);
     $i=0;
     

     $print .='<div>';
 while ($row = $result -> fetch_row())
    {
        if ($i >= ($do[1]*10)-10 )
        if ($i< $do[1]*10)
        {
            $photo="assets/img/JOB.jpg";
            
        if ($row[11] != null)
            $photo ='data:image/jpeg;base64,' . base64_encode($row[11]);
        if($row[3] != null) 
            $row[3]="$".$row[3];
     
        $print .='<div class="single-job-items mb-30">
                        <div class="job-items">
                            <div class="company-img">
                                <a href="'. $row[10]. '"><img src="' .$photo  . '" alt="" width="300px" height="150px"></a>
                            </div>
                            <div class="job-tittle job-tittle2">
                                <a href="'. $row[10]. '">
                                    <h4>'. $row[1]. '</h4>
                                </a>
                                <ul>
                                    <li>'. $row[2]. '</li>
                                    <li><i class="bi bi-geo-alt-fill"></i>'. $row[4]. '</li>
                                    <li>'. $row[3]. '</li>
                                    <li>'. $row[5]. ' </li>
                                </ul>
                            </div>
                        </div>
                        <div class="items-link items-link2 f-right">
                            <a href="'. $row[10]. '">apply using linkedIn</a>
                            <span>'. $row[9]. '</span>
                        </div>
                    </div>
        ';
            
            
        }
        else break;
        $i++;

    }

           $print .='</div>
          
     <div class="pagination-area pb-115 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                    ';

$i=$do[1]-1;
if ($i!=0)
$print .=' <li class="page-item"><a class="page-link" href="#heros"  onclick="getJobs('.$i.') "><i class="bi bi-arrow-left-short"></i></a></li>';

                                    
for($k=1; $k<= $pages ;$k++)
if($do[1] ==$k )
$print .=' <li class="page-item active"><a class="page-link"  href="#heros" onclick="getJobs('.$k.') ">'.$k.'</a></li>';
else
$print .=' <li class="page-item"><a class="page-link"         href="#heros" onclick="getJobs('.$k.') ">'.$k.'</a></li>';


$i=$do[1]+1;
if ($i<=$pages)
$print .=' <li class="page-item"><a class="page-link"  href="#heros"  onclick="getJobs('.$i.') "><i class="bi bi-arrow-right-short"></i></a></li>';


    $print .='
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
          
          ';


    // for($j=0; $j< $pages ;$j++ )   {
        
         
        //for($i=0; $i< 10 && $n!=0 ;$i++ )

     }

     
    
    


  // Free result set     $result -> free_result();
}


$conn -> close();



// Output
//if($print === "")  file('error.html' ,"<h1>no jobs</h1>") ;
echo $print === "" ? "no jobs" :  $print;   
//echo $print === "" ? 'error.html' :  $print;   




}


//----------------------------------------------------------------------


?>