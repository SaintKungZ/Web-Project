<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="styletestnomenu.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" charset="UTF-8"></script>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../../resource/css/styletestnomenu4.css" />


        <title>test</title>
    
    </head>

    <body>
      
        <input type="checkbox" id="check">
        <!--nav-->
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
                    <li><a href="sign_in&sign_up.php?logout=true">Sign out</a></li>
                <?php endif ?>   
              
       
                </ol>
                <label for="check" class="bar">
              <span class="fa fa-bars" id="bars"></span>
              <span class="fa fa-times" id="times"></span>
            </label>
          
        </nav>
        <br>
        <br>
        <br>
        <div class="container-fluid">
          <!--ส่วนสไลด์-->
         
          <div class="row">
            <div class ="col-md-2">
            </div>
              <div class ="col-md-8">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                  
                        <div class="item active">
                          <img src="../../resource/img/main/4.png" alt="Attack On Titan" style="width: 100%;">
                          <div class="carousel-caption">
                            <h3>My Hero Academia</h3>
                            <p></p>
                          </div>
                        </div>
                  
                        <div class="item">
                          <img src="../../resource/img/main/2.png" alt="Charlotte" style="width: 100%;">
                          <div class="carousel-caption">
                            <h3>Blue Lock</h3>
                            <p></p>
                          </div>
                        </div>
                      
                        <div class="item">
                          <img src="../../resource/img/main/3.png" alt="Sword Art Online" style="width: 100%;">
                          <div class="carousel-caption">
                            <h3>Death Note</h3>
                            <p></p>
                          </div>
                        </div>
    
                    
                      </div>
                  
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>
              </div>
          </div>
          <div class ="col-md-2">

          </div>
        
          <br><br>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>

      <section class="about section-padding" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12 col-12">
            <div class="about-img"><img alt="" class="img-fluid" src="../../resource/img/main/pochita.png"></div>
          </div>
          <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
            <div class="about-text">
              <h1>About Us</h1>
              <p>นี่เป็นส่วนหนึ่งของ Project ของวิชา CP251 ที่ได้นำความรู้จากทั้งข้างนอกและข้างในห้องเรียน
                นำมาประยุกต์ใช้ จนออกมาเป็นเว็บไซต์นี้ ซึ่งเว็บไซต์นี้จัดทำขึ้นเพื่ออัปเดตข่าวสารใหม่ ๆ สำหรับ
                ผู้คนที่ไม่สามารถเข้าถึงข่าวสาร ดังนั้นทางผู้จัดทำจึงสร้างเว็บไซต์ที่ชื่อว่า ‘ANIMETURE’ ขึ้นเพื่อแก้ไขปัญหาดังกล่าว
                และทำให้ผู้คนเข้าถึงข่าวสารของอนิเมะได้ง่ายขึ้น และต้องการให้เว็บไซต์นี้เป็นแพลตฟอร์มที่สามารถให้
                ผู้คนที่มีความชอบเกี่ยวกับอนิเมะเหมือนกันได้บอกเล่าเรื่องราวและความคิดเห็นของกันและกันลงในแพลตฟอร์มนี้ได้ 
              </p>
              
            </div>
          </div>
        </div>
      </div>
    </section><!-- about section Ends -->
    
      <!--Footer-->
      <footer>
        <p>Posted by สามสหายคล้ายจะเป็นลม</p>
    </footer>


    </body>
</html>