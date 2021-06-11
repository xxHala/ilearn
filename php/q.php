<?php
session_start();
?>

<?php

include ("database.php");
include ("userInfo.php");
$do = $_REQUEST["do"];



// All question for admin as a row -------------------------------------------------------------------
 if ($do =='ALL')
{  

   if ($result = $conn -> query("SELECT * FROM `question` WHERE 1 ORDER by `show_` ,`id`"))  
       while ($row = $result -> fetch_row()) 
          {
          
          echo '
          <tr class="mw-100" id="c'.$row[0].'">
                      <td>
                          <a>
                            '.getName($row[8]).'
                          </a>
                      </td>
			<td >
                          <a style=" width: 100px;">
                            '.$row[1].'
                          </a>
                      </td>
                      <td>
                          <a>
                             '.$row[3].'
                          </a>
                          <br/> 
                      </td>
             
                      
                      <td id="Badge'.$row[0].'" class="project-state">';
                      
                      if ($row[9] == 0)
                              echo '    <span  class="badge badge-warning">لم يتم الموافقة عليه بعد</span></td>';
                       else   echo '    <span  class="badge badge-success">تمت الموافقة عليه</span></td>';
                      
                     
                      
                      if ($row[9] == 0)
                              echo' <td class="project-actions text-right"><button id="acceptButton'.$row[0].'" onclick="acceptC('.$row[0].')" class="btn btn-success btn-sm" ><i class="fas fa-check"></i>موافقه  </button>';
                     echo' <td class="project-actions text-right">
                          <button onclick="removeC('.$row[0].')" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i>حذف </button>
                      </td>
                  </tr>
                  
          
          
          
          ';
          }
             

}


// Remove Question--------------------------------------------------------------------
else if ($do =='Remove')
{
$id = $_REQUEST["cid"];

if ($result = $conn -> query("DELETE FROM `question` WHERE `id`= $id  "))
        echo 1;
else echo 0;        

}

// Accept Question--------------------------------------------------------------------
else if ($do =='Accept')
{
$id = $_REQUEST["cid"];

if ($result = $conn -> query("UPDATE `question` SET `show_` = '1' WHERE `id` =$id  "))
        echo 1;
else echo 0;        

}



?>

