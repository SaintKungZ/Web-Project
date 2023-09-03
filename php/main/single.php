<?php

session_start();
include('../config/connected_server/connected_server.php');
include('../config/blog/single/get_data_blog.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" charset="UTF-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../resource/css/all.css" />

    <title>Blog-Single</title>
    <?php
        include('../structure/main/all_import_stylesheet_fonts_icon_in_tag_head.php');
    ?>

</head>

<body>

  
    
    <main id="main">
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
        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry entry-single">

                            <div class="entry-img">
                                <img src="<?php echo ("../../resource/img/img_upload/" . $row_result['username'] . "/" . $row_result['img_upload']); ?>" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="#"><?php echo ($row_result['title']); ?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-person"></i>
                                        <a href="./all.php?page=1&username-search=<?php echo ($row_result['username']); ?>"><?php echo ($row_result['username']); ?></a>
                                    </li>

                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i>
                                        <a href="javascript:void(0);">
                                            <time datetime="<?php echo ($date); ?>"><?php echo ($date_set_format); ?></time>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    <?php echo ("&emsp;".$row_result['blog_content']); ?>
                                </p>

                                <p>
                                    <?php echo ($row_result['from_location']); ?>
                                </p>
                            

                            </div>

                            <div class="entry-footer">

                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    <li><a href="./all.php?page=1&tags-search=<?php echo ($row_result['anime_name']); ?>"><?php echo ($row_result['anime_name']); ?></a></li>
                                </ul>
                            </div>

                        </article><!-- End blog entry -->

                    </div><!-- End blog entries list -->

                    <?php
                        include('../config/blog/recent_blog_db.php');
                        include('../structure/blog/search_and_recent_blog.php');
                    ?>

                </div>

            </div>
        </section><!-- End Blog Single Section -->

    </main><!-- End #main -->

    <?php            
        include('../structure/main/all_import_javascript.php');
    ?>
    <footer>
        <p>Posted by สามสหายคล้ายจะเป็นลม</p>
    </footer>
</body>

</html>