<!-- หน้า Sign in กับ Sign up-->
<?php
    session_start();
    include('../config/connected_server/connected_server.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     
    <!-- Favicons -->
    <link href="../../resource/img/main/logo_tab.JPG" rel="icon">
    <link href="../../resource/img/main/logo_tab.JPG" rel="apple-touch-icon">
    
    <title>Sign in & Sign up</title>
    <link rel="stylesheet" href="../../resource/css/sign_in&sign_up.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">

                    <form action="../config/sign_in&sign_up/sign_in_db.php" autocomplete="off" class="sign-in-form" method="post">
                        <div class="logo">
                           <img src="../../resource/img/sign_in&sign_up/ANIME.png" alt="img" height="100%" />                          
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not registred yet?</h6>
                            <a href="#" class="toggle switch_page">Sign up</a>                            
                        </div>

                        <?php if (isset($_SESSION['login_error'])||isset($_SESSION['not_login'])) : ?>
                            <!--กรณี sign-in ไม่สำเร็จ -->
                            <center>
                                <div class="notify-error">
                                    <h4>
                                        <?php
                                            if(isset($_SESSION['login_error']))
                                                {
                                                    echo $_SESSION['login_error']; //แสดงข้อความที่เก็บใน  $_SESSION['login_error']
                                                    unset($_SESSION['login_error']); //ลบ $_SESSION['login_error'] ทิ้ง
                                                }
                                            else
                                                {
                                                    echo $_SESSION['not_login']; //แสดงข้อความที่เก็บใน $_SESSION['not_login']
                                                    unset($_SESSION['not_login']); //ลบ $_SESSION['not_login'] ทิ้ง
                                                }                                           
                                        ?>
                                    </h4>                                    
                                </div>
                            </center>
                        <?php endif ?>


                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="username_or_email" class="input-field" autocomplete="off" required />
                                <label>Username or Your Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" name="login_user" value="Sign In" class="sign-btn" />
                            
                        </div>
                    </form>
                    <!-- end-sign-in-form -->


                    <!-- sign-up-form -->
                    <form action="../config/sign_in&sign_up/sign_up_db.php" autocomplete="off" class="sign-up-form" method="post">
                        <div class="logo">
                            <img src="../../resource/img/sign_in&sign_up/ANIME.png" alt="img" />                            
                        </div>

                        <div class="heading">
                            <h2>Get Started</h2>
                            <h6>Already have an account?</h6>
                            <a href="#" class="toggle switch_page">Sign in</a>
                    
                        </div>

                        <!--กรณี sign-up ไม่สำเร็จ -->
                        <?php if (isset($_SESSION['register_error'])) : ?>
                            <center>
                                <div class="notify-error">
                                    <h4>
                                        <?php
                                            echo $_SESSION['register_error']; //แสดงข้อความที่เก็บใน  $_SESSION['error']                                        
                                        ?>
                                    </h4>
                                </div>
                            </center>
                        <?php endif ?>


                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="username" class="input-field" autocomplete="off" required />
                                <label>Username</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" name="email" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password_1" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password_2" class="input-field" autocomplete="off" required />
                                <label>Confirm Password</label>
                            </div>

                            <input type="submit" name="reg_user" value="Sign Up" class="sign-btn" />

                        </div>
                    </form>
                    <!-- end-sign-up-form -->
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="../../resource/img/sign_in&sign_up/atot.jpg" class="image img-1 show" alt="img1" height="120%"/>
                        <img src="../../resource/img/sign_in&sign_up/Charlotte.jpg" class="image img-2" alt="img2" height="120%" />
                        <img src="../../resource/img/sign_in&sign_up/sao.jpg" class="image img-3" alt="img3"  height="120%"/>
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Let's get review from us</h2>
                                <h2>Let's go to Anime World</h2>
                                <h2>Welcome!</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->

    <script src="../../resource/js/sign_in&sign_up.js"></script>   
    <?php
        if (isset($_SESSION['register_error'])) 
            {
                echo "<script>switch_page();</script>";
                unset($_SESSION['register_error']); //ลบ $_SESSION['error'] ทิ้ง
            }
    ?>    
</body>

</html>