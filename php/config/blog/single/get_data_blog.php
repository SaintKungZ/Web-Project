<?php  

    //สำหรับดึงข้อมูล blog มาแสดงในหน้าเว็บ
    if (isset($_GET['blog_id'])) 
        {
            $blog_id = $_GET['blog_id'];
            $sql = "SELECT * FROM blog_post WHERE blog_id = $blog_id";
            $result_sql = mysqli_query($conn, $sql);
            $row_result = mysqli_fetch_array($result_sql);

            //ดึงค่า date มาแล้วจัด format
            $date=$row_result['date_of_create_blog'];     
            $date_set_format=date_format(date_create($date),"F j, Y");     
        
        }
?>

    
