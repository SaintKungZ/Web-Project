<?php
  session_start();
  include('../config/connected_server/connected_server.php');  
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" charset="UTF-8"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../resource/css/all.css" />

  <?php if(isset($_GET['user_id'])):?>
    <title>My-Blog</title>
  <?php else: ?>
    <title>All-Blog</title>
  <?php endif ?>

  <?php  
    include('../structure/main/all_import_stylesheet_fonts_icon_in_tag_head.php');
  ?>

</head>

<body>

  <?php
    include('../config/blog/all/show_all_blog_db.php');

    if(isset($_GET['user_id'])||(isset($_SESSION['user_role'])&&$_SESSION['user_role'] == "admin"))
    {
      include('../structure/blog/blog_confirm_deletion.php');
    }
  ?>


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

<br>
<br>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries css-all_blog">

            <?php while ($row_result_page_all_blog = mysqli_fetch_array($result_sql_page_all_blog)) : ?>
              <article class="entry">

                <div class="entry-img">

                  <?php if (empty($row_result_page_all_blog['img_upload'])): ?>
                    <img class="img-fluid" src="../../resource/img/img_upload/0_no_image/0_NO_image.png" alt="image">
                  <?php else: ?>
                    <img class="img-fluid" src="<?php echo ("../../resource/img/img_upload/" . $row_result_page_all_blog['username'] . "/" . $row_result_page_all_blog['img_upload']); ?>" alt="image">
                  <?php endif; ?>   
                 
                </div>

                <h2 class="entry-title">
                  <a href="./single.php?blog_id=<?php echo ($row_result_page_all_blog['blog_id']); ?>"><?php echo ($row_result_page_all_blog['title']); ?></a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center">
                      <i class="bi bi-person"></i>
                      <a href="./all.php?page=1&username-search=<?php echo ($row_result_page_all_blog['username']); ?>"><?php echo ($row_result_page_all_blog['username']); ?></a>
                    </li>

                    <li class="d-flex align-items-center">
                      <i class="bi bi-clock"></i>
                      <a href="javascript:void(0);">
                        <?php
                        $date = $row_result_page_all_blog['date_of_create_blog'];
                        $date_set_format_page_all_blog = date_format(date_create($date), "F j, Y");
                        ?>
                        <time datetime="<?php echo ($date); ?>"> <?php echo ($date_set_format_page_all_blog); ?> </time>
                      </a>
                    </li>
                    
                  </ul>
                </div>

                <div class="entry-content">
                  <p>                    
                    <?php
                    /*<!-- ส่วนแบ่ง blog_content ออกมาแสดงเป็นตัวอย่าง -->*/
                      //wordwrap() ตัดสตริงเป็นบรรทัดใหม่เมื่อถึงความยาวที่กำหนด (กำหนด FALSE หมายถึงใหเคำนึกถึงความหมายของคำที่ตัดด้วย๗ 
                      $split_content = wordwrap($row_result_page_all_blog['blog_content'], 1100, "\n", FALSE);
                      //expand() จะแบ่งสตริงออกเป็นอาร์เรย์ โดยจะแบ่งตามรูปแบบที่กำหนด
                      $sub_content = explode("\n", $split_content); 
                      //แสดงตัวอย่าง content ที่ทำการแบ่งมาแล้ว                    
                    echo ("&emsp;".$sub_content[0].".....");
                    ?>
                  </p>

                  <div class="read-more">
                    <a class="read_more_button" href="./single.php?blog_id=<?php echo ($row_result_page_all_blog['blog_id']); ?>">Read More</a>
                    <?php if(isset($_GET['user_id'])):?>
                      <a class="edit_button" href="./edit.php?blog_id=<?php echo ($row_result_page_all_blog['blog_id']); ?>">Edit</a>
                    <?php endif ?> 

                    <!-- กรณีอยู่หน้า my_blog -->
                      <?php if(isset($_GET['user_id'])):?>
                        <!-- javascript:void(0); คือการบอกไม่ต้องทำอะไร -->
                        <!-- หลังกดถ้ายืนยันการลบจะส่งค่า blog_id กับ name_img ไปเพื่อทำการลบข้อมูล -->

                        <a href="javascript:void(0);" class="delete_button" 
                        id="../config/blog/management/delete_blog_db.php?
                              blog_id=<?php echo ($row_result_page_all_blog['blog_id']); ?>&
                              name_img=<?php echo ($row_result_page_all_blog['img_upload']);?>&
                              creator_name=<?php echo ($row_result_page_all_blog['username']);?>&
                              from_my_blog=true
                            ">Delete</a>                          
                      <?php endif ?> 
                    
                    <!-- กรณีอยู่หน้า all_blog(admin เป็นคนลบ) -->
                    <?php if(!isset($_GET['user_id'])&&(isset($_SESSION['user_role'])&&$_SESSION['user_role'] == "admin")):?>   
                      <a href="javascript:void(0);" class="delete_button" 
                      id="../config/blog/management/delete_blog_db.php?
                            blog_id=<?php echo ($row_result_page_all_blog['blog_id']); ?>&
                            name_img=<?php echo ($row_result_page_all_blog['img_upload']);?>&
                            creator_name=<?php echo ($row_result_page_all_blog['username']);?>
                          ">Delete</a>                          
                    <?php endif ?> 


                  </div>
                  
                </div>

              </article><!-- End blog entry -->
            <?php endwhile; ?>

            <?php
              include('../config/blog/all/blog_page_number_db.php');
              include('../structure/blog/blog_page_number.php');
            ?>            

          </div><!-- End blog entries list -->

          <?php
            include('../config/blog/recent_blog_db.php');            
            include('../structure/blog/search_and_recent_blog.php');
          ?>

        </div>

      </div>
    </section><!-- End Blog Section -->



  </main><!-- End #main -->

  <?php 
  include('../structure/main/all_import_javascript.php');
  ?>
  <footer>
        <p>Posted by สามสหายคล้ายจะเป็นลม</p>
    </footer>

</body>

</html>