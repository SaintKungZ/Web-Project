<!-- เป็นหน้าที่จัดการหลังกดส่งข้อมูลมาจาก form หน้า register -->
<?php
session_start();
include('../connected_server/connected_server.php');

$errors = array();


if (isset($_POST['reg_user'])) 
    { 


        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        if (empty($username)) 
            {
                array_push($errors, "Username is required");
            }
        if (empty($email)) 
            {
                array_push($errors, "Email is required");
            }
        if (empty($password_1) || empty($password_2)) 
            {
                array_push($errors, "Password is required");
            }

        if ($password_1 != $password_2) 
            {
                array_push($errors, "Those passwords didn’t match. Try again.");
                $_SESSION['register_error'] = "Those passwords didn’t match. Try again.";
            }



            // <---ส่วนเตรียม prepared statement--->


                    $user_check_stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($user_check_stmt, "SELECT * FROM register WHERE username = ? OR email = ?");

                    
                    mysqli_stmt_bind_param($user_check_stmt, "ss", $username,$email);

      
                    mysqli_stmt_execute($user_check_stmt);

            
                    $mysqli_result = mysqli_stmt_get_result($user_check_stmt);

             
                    mysqli_stmt_close($user_check_stmt);

     
        $result = mysqli_fetch_assoc($mysqli_result); 


        if ($result) { 

            if ($result['username'] === $username&&$result['email'] === $email) 
                {
                    array_push($errors, "That username and email is taken. try another.");
                    $_SESSION['register_error'] = "That username and email is taken. try another.";
                }
            
            else{
                if ($result['username'] === $username) 
                    {            
                        array_push($errors, "That username is taken. try another.");
                        $_SESSION['register_error'] = "That username is taken. try another.";
                    }
                if ($result['email'] === $email) 
                    {
                        array_push($errors, "That email is taken. try another.");
                        $_SESSION['register_error'] = "That email is taken. try another.";
                    }
            }       
            
        }

        if (count($errors) == 0) 
            { 


                $password = md5($password_1); 


                // <---ส่วนเตรียม prepared statement--->


                        $add_new_account_stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($add_new_account_stmt, "INSERT INTO register (username,email,password) VALUES (?,?,?)");

                   
                        mysqli_stmt_bind_param($add_new_account_stmt, "sss", $username,$email,$password);


                        mysqli_stmt_execute($add_new_account_stmt);

                
                        mysqli_stmt_close($add_new_account_stmt);
            
         
                $_SESSION['username'] = $username;       

                header('location: ../../main/sign_in&sign_up.php'); 
            }

        else 
            {        
                header("location: ../../main/sign_in&sign_up.php"); 
            }
    }
mysqli_close ($conn);
?>
