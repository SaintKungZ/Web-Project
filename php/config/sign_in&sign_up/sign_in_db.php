<!-- เป็นหน้าที่จัดการหลังกดส่งข้อมูลมาจาก form หน้า login -->
<?php
    session_start();
    include('../connected_server/connected_server.php');

    $errors = array();

    if(isset($_POST['login_user'])){ 

     
        $username_or_email = mysqli_real_escape_string($conn, $_POST['username_or_email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);



        if (empty($username_or_email)) {
            array_push($errors, "Username is required");
        }       
        if (empty($password)) {
            array_push($errors, "Password is required");
        }


        if (count($errors) == 0) {
            $password = md5($password); 

        // <---ส่วนเตรียม prepared statement--->

            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, "SELECT * FROM register WHERE (username = ? OR email = ?) AND password = ? ");

            mysqli_stmt_bind_param($stmt, "sss", $username_or_email,$username_or_email,$password);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            if(mysqli_num_rows($result)==1)
                { 
                    
                    $row_result = mysqli_fetch_array($result);

               
                    $_SESSION['username'] = $row_result['username'];  
                    $_SESSION['user_id'] = $row_result['user_id'];         
                    $_SESSION['user_role'] = $row_result['role'];     
                      
                    header("location: ../../main/index.php"); 
                }

            else
                {
                    array_push($errors, "Wrong username/password combination");
                    $_SESSION['login_error'] = "Wrong username or password. Try again.";
                    header("location: ../../main/sign_in&sign_up.php");
                }
        }

        else{ 
            array_push($errors, "Username & Password is required");
            $_SESSION['login_error'] = "Username & Password is required";
            header("location: ../../main/sign_in&sign_up.php");
        }
    }
    mysqli_close ($conn);
?>