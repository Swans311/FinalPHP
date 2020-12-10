<?php 
/* Added this logic to show that we need something to switch the nav bar between logged in and out*/ 
$loggedin = False

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
      @font-face{
        font-family: logoFont;
        src: url(misc/css/Neon.ttf);
      }
      @font-face{
        font-family: titleFont;
        src: url(misc/css/AirstreamNF.ttf);
      }
      @font-face{
        font-family: textFont;
        src: url(misc/css/CherryCreamSoda-Regular.ttf);
      }
      /* .glow and @-webkit-keyframes glow create the glowing effect on the project logo*/
      .glow{
        font-size: 30px;
        animation: glow 1s ease-in-out infinite alternate;
      }
      @-webkit-keyframes glow {
        from {
          text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
        }
        to {
          text-shadow: 0 0 40px #fff, 0 0 60px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6, 0 0 90px #ff4da6, 0 0 100px #ff4da6;
        }
      }
      /* Creates the black/white checkered background*/
      .gz-body-bg{
        background-color: #eee;
        background-image: linear-gradient(45deg, black 25%, transparent 25%, transparent 75%, black 75%, black),
                          linear-gradient(-45deg, black 25%, transparent 25%, transparent 75%, black 75%, black);
        background-size: 90px 90px; 
        background-attachment: fixed;
      }
      .gz-nav-bg{
        background-image: radial-gradient(ellipse at top, #e75480,#f71a08)
      }
      .gz-nav-link{
        font-family: textFont; 
        font-size: 20px;
      }
    </style>
    <title>Document</title>
</head>
<body class="gz-body-bg"> 
<nav class="navbar sticky-top navbar-expand-lg navbar-dark text-white shadow-lg p-3 mb-6 gz-nav-bg">
    <!-- Project Name/Logo-->
    <a class="navbar-brand glow" href="#" style="font-family: logoFont;">Gourmandize</a>
      <!-- Nav links, pushed to left-->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link gz-nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link gz-nav-link" href="#">Review</a>
        </li>
      </ul>
    <!-- Search bar, centered on nav-->
    <form class="navbar-form mx-auto d-flex">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search">
      <button class="btn" type="submit"><img src="misc\img\search_24.svg" alt="Search Icon"><img/></button>
    </form>
    <!-- Nav links, pushed to right-->
    <div class="nav-item ml-auto">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link gz-nav-link" href="#">About Us</a>
        </li>
        <!-- Logic to switch between buttons depending on if the user is logged in-->
        <?php if($loggedin == False) :?>
          <li class="nav-item">
            <a class="nav-link gz-nav-link" href="#">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link gz-nav-link" href="#"><img src="misc\img\user.svg" alt="Profile Icon" style="height: 24px; weight:24px;">  Sign Up</a>
          </li>
        <?php else:?>
          <li class="nav-item">
            <a class="nav-link gz-nav-link" href="#">Log Out</a>
          </li>
          <li class="nav-item">
            <a class="nav-link gz-nav-link" href="#"><img src="misc\img\user.svg" alt="Profile Icon" style="height: 24px; weight:24px;">  Account</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </nav>
  <div class="container"style="height: 2000px;background-color: #fff; margin-top: 50px; border-radius: 25px; box-shadow: 0 0 10px 6px #0cf, 0 0 20px 12px #fff; padding: 0px;">
  <div class="container"style="height: 2000px; width:100%; background-color: #0095EF; border-radius: 25px; ">
  
  </div>
  </div>
</body>
</html>