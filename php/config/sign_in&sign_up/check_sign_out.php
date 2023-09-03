<?php

    //เช็คว่าถ้ามีการ logout
    if (isset($_GET['logout'])) {
        session_destroy(); //ลบ  session
        unset($_SESSION['username']); //ลบ ตัวแปร username  
        unset($_SESSION['user_role']); //ลบ ตัวแปร user_role
        unset($_SESSION['user_id']); //ลบ ตัวแปร user_id      
    }   

?>



