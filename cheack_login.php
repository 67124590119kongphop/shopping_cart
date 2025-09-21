<?php 
// print_r($_POST);
session_start();
        if(isset($_POST['m_user'])){
        //connection
                  include("condb.php");
        //รับค่า user & mem_password
                  $m_user = mysqli_real_escape_string($con,$_POST['m_user']);
                  $m_pass = mysqli_real_escape_string($con,$_POST['m_pass']);

                
                    //query 
                              $sql="SELECT * FROM tbl_member 
                              WHERE m_user='".$m_user."' 
                              AND m_pass='".$m_pass."'";
                              $result = mysqli_query($con, $sql);

                               //echo $sql;

                              // echo mysqli_num_rows($result);

                              //exit;
                    
                              if(mysqli_num_rows($result)==1){

                                  $row = mysqli_fetch_array($result);

                                  $_SESSION["member_id"] = $row["member_id"];
                                  $_SESSION["m_level"] = $row["m_level"];
                                  $_SESSION["m_name"] = $row["m_name"];   
                                  $_SESSION["m_img"] = $row["m_img"];     
                                      

                                      if($row['m_level']=="admin"){                                     
                                          Header("Location: admin/");
                                          
                                      }elseif($row['m_level']=="member"){
                                          Header("Location: member/");
                                      }
                                
                                 
                                 


                              }else{
                                    echo "<script>";
                                    echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                                    echo "window.history.back()";
                                    echo "</script>";
                              }


                    //close else chk trim

                    //exit();




        }else{


             Header("Location: index.php"); //user & mem_password incorrect back to login again

        }
?>