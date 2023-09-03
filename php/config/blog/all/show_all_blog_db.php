<?php  


        
        if(isset($_GET['page']))
            {   
                $_SESSION['page'] = $_GET['page'];           
                $number_page = $_SESSION['page'];   
                $var_OFFSET = ($number_page-1)*5;                          
            }

        else
            {
                $var_OFFSET = 0; 
            }   

    // <---ส่วนสร้าง $_SESSION ข้อมูล search กรณีที่มีการ search--->

        if(isset($_POST['input-search']))
            {
                $_SESSION['search'] = $_POST['input-search'];      
            } 


        elseif(isset($_GET['username-search'])) 
            {
                $_SESSION['search'] = $_GET['username-search']; 
            } 
        

        elseif(isset($_GET['tags-search']))
            {
                $_SESSION['search'] = $_GET['tags-search']; 
            } 
        
    
    // <---ส่วนดึงข้อมูล Blog ที่จะนำมาแสดง--->
                           

        if(isset($_GET['user_id']))
            {
                $var_user_id = $_GET['user_id'];

                if(isset($_SESSION['search']))
                    {
                        $var_input_search = $_SESSION['search'];
                    
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, "SELECT * FROM blog_post WHERE ( (username LIKE CONCAT('%',?,'%')) OR (title LIKE CONCAT('%',?,'%')) OR (anime_name LIKE CONCAT('%',?,'%')) OR ( blog_content LIKE CONCAT('%',?,'%')) OR ( from_location LIKE CONCAT('%',?,'%')) ) AND user_id = ? ORDER BY blog_id DESC LIMIT 5 OFFSET ?");
                        
                        mysqli_stmt_bind_param($stmt,"sssssis",$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_user_id,$var_OFFSET);

                        mysqli_stmt_execute($stmt);

                        $result_sql_page_all_blog = mysqli_stmt_get_result($stmt);

                        mysqli_stmt_close($stmt);
                                
                    }  

                else
                    {
                        $sql_get_info_page_all_blog = "SELECT * FROM blog_post WHERE user_id = $var_user_id ORDER BY blog_id DESC LIMIT 5 OFFSET $var_OFFSET"; 
                        $result_sql_page_all_blog = mysqli_query($conn, $sql_get_info_page_all_blog);
                    }
            }
        
        //กรณีอยู่หน้า All-Blog
        else
            {
                if(isset($_SESSION['search']))
                    {
                        $var_input_search = $_SESSION['search'];
                    
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, "SELECT * FROM blog_post WHERE (username LIKE CONCAT('%',?,'%')) OR (title LIKE CONCAT('%',?,'%')) OR (anime_name LIKE CONCAT('%',?,'%')) OR ( blog_content LIKE CONCAT('%',?,'%')) OR ( from_location LIKE CONCAT('%',?,'%')) ORDER BY blog_id DESC LIMIT 5 OFFSET ?");
                        
                        mysqli_stmt_bind_param($stmt,"ssssss",$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_OFFSET);

                        mysqli_stmt_execute($stmt);

                        $result_sql_page_all_blog = mysqli_stmt_get_result($stmt);

                        mysqli_stmt_close($stmt);
                                
                    }  

                else
                    {
                        $sql_get_info_page_all_blog = "SELECT * FROM blog_post ORDER BY blog_id DESC LIMIT 5 OFFSET $var_OFFSET"; 
                        $result_sql_page_all_blog = mysqli_query($conn, $sql_get_info_page_all_blog);
                    }
            }

   

    
?>

