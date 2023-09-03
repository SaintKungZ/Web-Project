<!-- ส่วน Search กับ Recent Posts -->
<div class="col-lg-4">

    <div class="sidebar">

            <!-- ส่วน Search -->
        <h3 class="sidebar-title">Search</h3>        
        <div class="sidebar-item search-form">
            
            <!------------------------------------------ กรณีอยู่หน้า My_blog ---------------------------------------------------->
                <?php if(isset($_GET['user_id'])):?> 
                    <form action="./all.php?page=1&user_id=<?php echo ($_GET['user_id']); ?>" method="post">
                        <input type="text" name="input-search">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>

            <!------------------------------------------ กรณีอยู่หน้า All_blog ---------------------------------------------------->
                <?php else:?> 
                    <form action="./all.php?page=1" method="post">
                        <input type="text" name="input-search">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                <?php endif;?>    

        </div><!-- End sidebar search formn-->

            <!-- ส่วน Recent Posts -->
        <?php if(mysqli_num_rows($result_sql_recent_blog)!=0):?>
            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">

                <?php while ($row_result_recent_blog = mysqli_fetch_array($result_sql_recent_blog)) : ?>
                    <div class="post-item clearfix">
                    <?php if (empty($row_result_recent_blog['img_upload'])): ?>
                        <img src="../../resource/img/img_upload/0_no_image/0_NO_image_2.png" alt="image">
                    <?php else: ?>
                        <img src="<?php echo ("../../resource/img/img_upload/" . $row_result_recent_blog['username'] . "/" . $row_result_recent_blog['img_upload']); ?>" alt="image">
                    <?php endif; ?>                    
                        <h4><a href="./single.php?blog_id=<?php echo ($row_result_recent_blog['blog_id']); ?>"><?php echo ($row_result_recent_blog['title']); ?></a></h4>
                        <?php
                            $date = $row_result_recent_blog['date_of_create_blog'];
                            $date_set_format_recent_blog = date_format(date_create($date), "M j, Y");
                        ?>
                        <time datetime="<?php echo ($date); ?>" > <?php echo ($date_set_format_recent_blog); ?> </time>
                    </div>
                <?php endwhile; ?>

            </div><!-- End sidebar recent posts-->
        <?php endif;?>  
        
    </div><!-- End sidebar -->

</div><!-- End blog sidebar -->
<!-- จบส่วน Search กับ Recent Posts -->