<?php
    
    if(isset($_GET['user_id']))
        {
            $var_user_id = $_GET['user_id'];

            if(isset($_SESSION['search']))
                {           
                    $var_input_search = $_SESSION['search'];

                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, "SELECT * FROM blog_post WHERE ( (username LIKE CONCAT('%',?,'%')) OR (title LIKE CONCAT('%',?,'%')) OR (anime_name LIKE CONCAT('%',?,'%')) OR (blog_content LIKE CONCAT('%',?,'%')) OR (from_location LIKE CONCAT('%',?,'%')) ) AND user_id = ?");

                    mysqli_stmt_bind_param($stmt,"sssssi",$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_input_search, $var_user_id);

                    mysqli_stmt_execute($stmt);

                    $result_sql_all_blog_for_search = mysqli_stmt_get_result($stmt);
                    $num_rows_all_blog = mysqli_num_rows($result_sql_all_blog_for_search);

                    mysqli_stmt_close($stmt);
                }

            else
                {
                    $sql_get_all_blog = "SELECT * FROM blog_post WHERE user_id = $var_user_id";
                    $result_sql_all_blog = mysqli_query($conn, $sql_get_all_blog);
                    $num_rows_all_blog = mysqli_num_rows($result_sql_all_blog);
                }    
        }
    
    else
        {
            if(isset($_SESSION['search']))
                {           
                    $var_input_search = $_SESSION['search'];

                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, "SELECT * FROM blog_post WHERE (username LIKE CONCAT('%',?,'%')) OR (title LIKE CONCAT('%',?,'%')) OR (anime_name LIKE CONCAT('%',?,'%')) OR (blog_content LIKE CONCAT('%',?,'%')) OR (from_location LIKE CONCAT('%',?,'%'))");

                    mysqli_stmt_bind_param($stmt,"sssss",$var_input_search,$var_input_search,$var_input_search,$var_input_search,$var_input_search);

                    mysqli_stmt_execute($stmt);

                    $result_sql_all_blog_for_search = mysqli_stmt_get_result($stmt);
                    $num_rows_all_blog = mysqli_num_rows($result_sql_all_blog_for_search);

                    mysqli_stmt_close($stmt);
                }


            else
                {
                    $sql_get_all_blog = "SELECT * FROM blog_post";
                    $result_sql_all_blog = mysqli_query($conn, $sql_get_all_blog);
                    $num_rows_all_blog = mysqli_num_rows($result_sql_all_blog);
                }    
        }
    


    $num_page = $num_rows_all_blog / 5;    

    if (is_float($num_page) || is_double($num_page)) 
        {
            $num_page =  intval($num_page) + 1;            
        }
    
    
    /*<!-- ส่วนกำหนดหน้าแรก และ หน้าสุดท้าย ที่จะแสดงให้กด -->*/

    $add_page = 0;
    $fist_page = 1; 
    $last_page = $num_page; 

    if($num_page>5)
        { 
            
            $last_page = 5;

            if($_SESSION['page']>3)
                {
                    $add_page = $_SESSION['page']-3;
                    $fist_page = 1 + $add_page;
                    $last_page = 5 + $add_page;

                    if($last_page>$num_page)
                        {
                            $fist_page = $num_page-4;
                            $last_page = $num_page;
                        }
                }
        }
    
?>
