<!-- ไฟล์นี้ใช้เชื่อมต่อกับ Database project-->

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project"; // project คือชื่อ Database 

    // สร้างการเชื่อมต่อ
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //<---ส่วนเช็คการเชื่อมต่อ--->

    if(!$conn)  //กรณีเชื่อมต่อไม่สำเร็จ
        {
            die("Connection failed" . mysqli_connect_errno());
        }
    

?>