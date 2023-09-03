<!-- ส่วนเลือกเลขหน้า -->
<div class="blog-pagination">
    
    <?php if($num_page!=0):?>
        <ul class="justify-content-center">  
           
        <!------------------------------------------ กรณีอยู่หน้า My_blog ---------------------------------------------------->
        <?php if(isset($_GET['user_id'])):?> 

                <!-- ส่วนสร้างปุ่มกลับไปหน้าก่อนหน้า -->            
                <li><a id="page_previous" href="./all.php?page=<?php echo($_SESSION['page']-1) ?>&user_id=<?php echo ($_GET['user_id']); ?>">Previous</a></li>            

                <!-- ส่วนสร้างปุ่มเลขหน้าต่างๆ -->
                <?php for ($i = $fist_page; $i <= $last_page; $i++) : ?>
                    <li class="mode-page-number">
                        <a class="page-number" href="./all.php?page=<?php echo ($i); ?>&user_id=<?php echo ($_GET['user_id']); ?>">
                            <?php echo ($i); ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- ส่วนสร้างปุ่มไปหน้าถัดไป -->
                <li><a id="next_previous" href="./all.php?page=<?php echo($_SESSION['page']+1) ?>&user_id=<?php echo ($_GET['user_id']); ?>">Next</a></li>

            
        <!------------------------------------------ กรณีอยู่หน้า All_blog ---------------------------------------------------->
        <?php else:?> 

                <!-- ส่วนสร้างปุ่มกลับไปหน้าก่อนหน้า -->            
                <li><a id="page_previous" href="./all.php?page=<?php echo($_SESSION['page']-1) ?>">Previous</a></li>            

                <!-- ส่วนสร้างปุ่มเลขหน้าต่างๆ -->
                <?php for ($i = $fist_page; $i <= $last_page; $i++) : ?>
                    <li class="mode-page-number">
                        <a class="page-number" href="./all.php?page=<?php echo ($i); ?>">
                            <?php echo ($i); ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- ส่วนสร้างปุ่มไปหน้าถัดไป -->
                <li><a id="next_previous" href="./all.php?page=<?php echo($_SESSION['page']+1) ?>">Next</a></li>

        <?php endif;?> 


            
        </ul>
    <?php else:?>
        <div class="section-title">
            <?php if(isset($_SESSION['search'])):?>
                <h2>No results found</h2>
                <p>Try different or more general keywords.</p>
            <?php else:?>
                <h2>No Blog</h2>
                <p>No review yet. Let's create your blog.</p>
            <?php endif;?> 
        </div>
    <?php endif;?>    
</div>

<script>

    /*<!-- ส่วนกำหนดว่าจะให้เลขหน้าไหนขึ้นสีแดงหลังกดไปแล้ว -->*/

    var mode_page = document.getElementsByClassName("mode-page-number");
    var page_number;

    for (let i = 0; i < mode_page.length; i++)
        {
            page_number = document.getElementsByClassName("page-number")[i].innerHTML;

            if (page_number==<?php echo($_SESSION['page']) ?>)
                {
                    mode_page[i].classList.add("active");
                }
        }

    /*<!-- ส่วนกำหนดว่าห้ามกดไปหน้าก่อนหน้าถ้าอยู่ที่หน้าแรกแล้ว-->*/   
    if(<?php echo($_SESSION['page'])?>==1)
        {
            document.getElementById("page_previous").setAttribute('href',"#");
        }

    /*<!-- ส่วนกำหนดว่าห้ามกดไปหน้าถัดไปถ้าอยู่ที่หน้าสุดท้ายแล้ว-->*/   
    if(<?php echo($_SESSION['page'])?>==<?php echo($num_page) ?>)
        {
            document.getElementById("next_previous").setAttribute('href',"#");
        }
</script>


