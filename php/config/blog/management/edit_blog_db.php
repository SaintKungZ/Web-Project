<!-- เป็นหน้าที่จัดการหลังกดส่งข้อมูลมาจาก form หน้า edit.php -->
<?php
    session_start();
    include('../../connected_server/connected_server.php');

    //ตั้งค่า timezone
    date_default_timezone_set('Asia/Bangkok');   


    if(isset($_GET['blog_id'])&&isset($_SESSION['user_id'])&&isset($_SESSION['username'])&&isset($_POST['create_blog'])&&isset($_POST['form_title'])&&isset($_POST['form_anime_Name'])&&isset($_POST['form_from_location'])&&isset($_POST['form_blog_content']))
    {
        $var_blog_id = $_GET['blog_id'];
        $var_username = $_SESSION['username'];
        $var_user_id = $_SESSION['user_id'];               
        $var_title = $_POST['form_title'];
        $var_anime_name = $_POST['form_anime_Name'];        
        $var_blog_content = $_POST['form_blog_content'];
        $var_from_location = $_POST['form_from_location'];        
        $var_date_of_last_edit_blog = date("Y-m-d");
               
        //<---ส่วนจัดการอัพโหลดภาพ กรณีที่มีการอัพโหลดรูปภาพ--->     
        if($_FILES["form_img_upload"]["size"]!=0)
            {
                $date = date("Ymd");

                $numrand = (mt_rand());

                $upload = $_FILES['form_img_upload'];

                $path = "../../../../resource/img/img_upload/".$var_username;                

                if(!is_dir($path))
                    {
                      mkdir($path); 
                    }
                
                if(isset($_GET['old_img'])&&!empty($_GET['old_img']))
                    {
                        $var_name_old_img = $_GET['old_img'];
                        $path_old_img = $path."/".$var_name_old_img;
                        unlink($path_old_img);
                    }

                //<---ส่วนเปลี่ยนชื่อไฟล์รูปภาพที่ upload มาใหม่--->  
      
                $type = strrchr($_FILES['form_img_upload']['name'], "."); 

                $newname_img = $date . $numrand . $type; 
                $new_path = $path."/". $newname_img; 
                
            
                move_uploaded_file($_FILES['form_img_upload']['tmp_name'], $new_path);

                //<---ส่วนเพิ่มข้อมูลลง database กรณีมีรูปภาพ---> 

                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, "UPDATE blog_post SET user_id = ?, username = ?, title = ?, anime_name = ?, blog_content = ?, from_location = ?, date_of_last_edit_blog = ?, img_upload = ? WHERE blog_id = ?");

                    mysqli_stmt_bind_param($stmt, "isssssssi", $var_user_id,$var_username,$var_title,$var_anime_name,$var_blog_content,$var_from_location,$var_date_of_last_edit_blog,$newname_img,$var_blog_id);

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);           
                
            }

        else
            {
                //<---ส่วนเพิ่มข้อมูลลง database กรณีไม่มีรูปภาพ--->   

                
                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt, "UPDATE blog_post SET user_id = ?, username = ?, title = ?, anime_name = ?, blog_content = ?, from_location = ?, date_of_last_edit_blog = ? WHERE blog_id = ?");

                 mysqli_stmt_bind_param($stmt, "issssssi", $var_user_id,$var_username,$var_title,$var_anime_name,$var_blog_content,$var_from_location,$var_date_of_last_edit_blog,$var_blog_id);

                 mysqli_stmt_execute($stmt);

                 mysqli_stmt_close($stmt);    
            }
    }
   
    mysqli_close ($conn);
    
    $location = "location: ../../../main/single.php?blog_id=$var_blog_id";
    header($location);  
?>




