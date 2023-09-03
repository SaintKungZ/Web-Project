<!-- เป็นหน้าที่จัดการหลังกดส่งข้อมูลมาจาก form หน้า create.php -->
<?php
    session_start();
    include('../../connected_server/connected_server.php');

    //ตั้งค่า timezone
    date_default_timezone_set('Asia/Bangkok');   


    if(isset($_SESSION['user_id'])&&isset($_SESSION['username'])&&isset($_POST['create_blog'])&&isset($_POST['form_title'])&&isset($_POST['form_anime_Name'])&&isset($_POST['form_from_location'])&&isset($_POST['form_blog_content']))
    {
        

        $var_username = $_SESSION['username']; 
        $var_user_id = $_SESSION['user_id'];              
        $var_title = $_POST['form_title'];
        $var_anime_name = $_POST['form_anime_Name'];        
        $var_blog_content = $_POST['form_blog_content'];
        $var_from_location = $_POST['form_from_location'];        
        $var_date_of_create_blog = date("Y-m-d");
               
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

                //<---ส่วนเปลี่ยนชื่อไฟล์รูปภาพที่ upload มาใหม่--->  
                $type = strrchr($_FILES['form_img_upload']['name'], "."); 

                $newname_img = $date . $numrand . $type; 
                $new_path = $path."/". $newname_img; 
                

                move_uploaded_file($_FILES['form_img_upload']['tmp_name'], $new_path);

                //<---ส่วนเพิ่มข้อมูลลง database กรณีมีรูปภาพ---> 

                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, "INSERT INTO blog_post (user_id,username,title,anime_name,blog_content,from_location,date_of_create_blog,date_of_last_edit_blog,img_upload) VALUES(?,?,?,?,?,?,?,?,?)");

                    mysqli_stmt_bind_param($stmt, "issssssss", $var_user_id,$var_username,$var_title,$var_anime_name,$var_blog_content,$var_from_location,$var_date_of_create_blog,$var_date_of_create_blog,$newname_img);

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);           
                
            }

        else
            {
                //<---ส่วนเพิ่มข้อมูลลง database กรณีไม่มีรูปภาพ--->   

                 $stmt = mysqli_stmt_init($conn);
                 mysqli_stmt_prepare($stmt, "INSERT INTO blog_post (user_id,username,title,anime_name,blog_content,from_location,date_of_create_blog,date_of_last_edit_blog) VALUES(?,?,?,?,?,?,?,?)");

                 mysqli_stmt_bind_param($stmt, "isssssss", $var_user_id,$var_username,$var_title,$var_anime_name,$var_blog_content,$var_from_location,$var_date_of_create_blog,$var_date_of_create_blog);

                 mysqli_stmt_execute($stmt);

                 mysqli_stmt_close($stmt);    
            }
    }
   
    mysqli_close ($conn);
    
    $location = "location: ../../../main/all.php?page=1&user_id=".$_SESSION['user_id'];
    header($location);  
?>




