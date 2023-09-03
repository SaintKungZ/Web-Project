<?php 
    session_start();
    include('../../connected_server/connected_server.php');

    if(isset($_GET['blog_id']))
        {
            $var_blog_id = $_GET['blog_id'];
            $sql_delete = "DELETE FROM blog_post WHERE blog_id = $var_blog_id"; 
            $result = mysqli_query($conn,$sql_delete);

            if(isset($_GET['name_img'])&&!empty($_GET['name_img'])&&isset($_GET['creator_name']))
            {
                $var_name_img = $_GET['name_img'];
                $var_creator_name = $_GET['creator_name'];
                $path_img = "../../../../resource/img/img_upload/" . $var_creator_name . "/" .  $var_name_img;
                unlink($path_img);
            } 

            if($result)
                {
                    mysqli_close ($conn);
                    
                    if($_GET['from_my_blog'])
                        {
                            $location = "location: ../../../main/all.php?page=1&user_id=".$_SESSION['user_id'];                           
                        }
                        
                    else
                        {
                            $location = "location: ../../../main/all.php?page=1";
                        }                  

                    header($location);  
                }
        }     
?>
