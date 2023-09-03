<?php
    //ส่วนดึงข้อมูลของ recent_blog
    $sql_get_recent_blog = "SELECT * FROM blog_post ORDER BY blog_id DESC LIMIT 5 OFFSET 0"; 
    $result_sql_recent_blog = mysqli_query($conn, $sql_get_recent_blog);     
?>