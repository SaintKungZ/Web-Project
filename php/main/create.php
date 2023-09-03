<?php
//เริ่ม session
session_start();
    if(!isset($_SESSION['username']))
        {
            $_SESSION['not_login'] = "Please sign in first.";
            header("location: ./sign_in&sign_up.php");
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" charset="UTF-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../resource/css/create.css" />

    <title>Create Blog</title>

    <?php
         include('../structure/main/all_import_stylesheet_fonts_icon_in_tag_head.php');
    ?>
    

</head>

<body>

<input type="checkbox" id="check">
<nav>
            <!--ส่วนแบนเนอร์-->
            <h2><div class="icon" style="color: white;">ANIME<b style="color: red;">TURE</b></div></h2>
         
            <ol>
            <li><a class="active" href="./index.php">Home</a></li>
          <?php if (isset($_SESSION['username'])): ?> 
              <?php if ($_SESSION['user_role'] == "admin"): ?>
                    <?php endif ?>                         
                <?php endif ?>  

                <li><a href="./all.php?page=1&clear_search=true">All-anime</a></li>

                <?php if (isset($_SESSION['username'])): ?>                    
                    <li><a href="./all.php?page=1&clear_search=true&user_id=<?php echo ($_SESSION['user_id']); ?>">My-Blog</a></li>
                <?php endif ?>

                <li><a href="./create.php">Create-review</a></li> 
                
                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="./sign_in&sign_up.php">Sign in/Sign up</a></li>                 
                <?php else: ?> 
                    <li><a href="./sign_in&sign_up.php?logout=true">Sign out</a></li>
                <?php endif ?>     
            </ol>

            <label for="check" class="bar">
              <span class="fa fa-bars" id="bars"></span>
              <span class="fa fa-times" id="times"></span>
            </label>

        </nav>

    <main id="main">

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2 data-aos="fade-up">Create Blog</h2>
                    <p data-aos="fade-up">Create a unique and beautiful review. It's easy and free</p>
                </div>

                <div class="row justify-content-center">

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-xl-9 col-lg-12 mt-4">

                            <form id="form_create_blog" action="../config/blog/management/add_blog_db.php" enctype="multipart/form-data" method="post" role="form" class="form_create_blog">

                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Drop your image here or click to upload</span>
                                    <input type="file" name="form_img_upload" class="drop-zone__input">
                                </div>
                                
                                <br><br>


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="form_title" class="form-control" id="title" placeholder="Anime_Name" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <input type="text" name="form_anime_Name" class="form-control" id="anime_Name" placeholder="Tag" required>
                                    </div>

                              
                                </div>

                                <div class="form-group col-mt-3">
                                    <textarea class="form-control" name="form_blog_content" rows="5" placeholder="Description Review" required></textarea>
                                </div>    
                                <div class="col-md-12 form-group">
                                        <input type="text" name="form_from_location" class="form-control" id="location" placeholder="Location from:" required>
                                    </div>                           

                                <div class="text-center css-button-create_blog"><button type="submit" name="create_blog" form="form_create_blog">Create Blog</button></div>

                            </form>
                        </div>

                    </div>

                </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <?php
        include('../structure/main/all_import_javascript.php');
    ?>   
   
    <!--Footer-->
    <footer>
        <p>Posted by สามสหายคล้ายจะเป็นลม</p>
    </footer>

</body>

</html>