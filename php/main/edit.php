<?php
//เริ่ม session
session_start();
if(!isset($_SESSION['username']))
        {
            $_SESSION['not_login'] = "Please sign in first.";
            header("location: ./sign_in&sign_up.php");
        }

include('../config/connected_server/connected_server.php');
include('../config/blog/single/get_data_blog.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="../../resource/css/edit.css" />
    

    <title>Edit Blog</title>

    <?php
         include('../structure/main/all_import_stylesheet_fonts_icon_in_tag_head.php');
    ?>
    

</head>

<body>

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
                    <h2 data-aos="fade-up">Edit Blog</h2>
                    <p data-aos="fade-up">Make sure you press the Update button.</p>
                </div>

                <div class="row justify-content-center">

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-xl-9 col-lg-12 mt-4">

                            <form id="form_create_blog" action="../config/blog/management/edit_blog_db.php?blog_id=<?php echo ($_GET['blog_id']); ?>&old_img=<?php echo ($row_result['img_upload']); ?>" enctype="multipart/form-data" method="post" role="form" class="form_create_blog">

                                <div class="drop-zone">

                                    <?php if (empty($row_result['img_upload'])): ?>
                                        <span class="drop-zone__prompt">Drop your image here or click to upload</span>
                                    <?php else: ?>
                                        <div class="drop-zone__thumb" style="background-image: url(<?php echo ("../../resource/img/img_upload/" . $row_result['username'] . "/" . $row_result['img_upload']); ?>);"></div>
                                    <?php endif; ?>                                      
                                        <input type="file" name="form_img_upload" class="drop-zone__input">

                                </div>
                                
                                <br><br>


                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="form_title" class="form-control" id="title" placeholder="Title" value="<?php echo ($row_result['title']); ?>" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <input type="text" name="form_anime_Name" class="form-control" id="Anime_Name" placeholder="Anime_Name" value="<?php echo ($row_result['anime_name']); ?>" required>
                                    </div>

                              
                                </div>

                                <div class="form-group col-mt-3">
                                    <textarea class="form-control" name="form_blog_content" rows="5" placeholder="Description Review" required><?php echo ($row_result['blog_content']); ?></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                        <input type="text" name="form_from_location" class="form-control" id="location" placeholder="Location" value="<?php echo ($row_result['from_location']); ?>" required>
                                    </div>
                                
                                <div class="text-center css-button-create_blog"><button type="submit" name="create_blog" form="form_create_blog">Update Blog</button></div>

                            </form>
                        </div>

                    </div>

                </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <?php        
        include('../structure/main/all_import_javascript.php');
    ?>   
   

</body>

</html>