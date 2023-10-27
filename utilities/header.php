<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Wild Swimming and Camping</title>
    <link rel="icon" href="img/icon.svg">
    <!-- css link  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- fontawesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php session_start(); ?>   
    <!-- overlay  -->
    <div id="overlay"></div>
    <!-- mobile menu  -->
    <div id="mobile-menu" class="mobile-main-menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="information.php">Information</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="availability.php">Availability</a></li>
            <li><a href="explore.php">Explore</a></li>
            <li><a href="features.php">Features</a></li>
            <li><a href="localAttractions.php">Local Attractions</a></li>
            <li><a href="reviews.php">Reviews</a></li>
            
            <?php if((isset($_SESSION['userID']) && !empty($_SESSION['userID']))): ?>
                <li><a href="history.php">Booking History</a></li>
                <li><a href="utilities/logout.php" >Logout</a></li>    
            <?php else: ?>
                <li><a href="login.php">Login</a></li>   
            <?php endif; ?>
        </ul>
    </div>
    
    <!-- desktop navigation  -->
    <header>
        <div class="logo-container">
            <a href="index.php" class="brand" title="Global Wild Swimming and Camping">
                <img src="img/icon.svg" alt="logo brand" class="logo-brand">
                GWSC
            </a>
        </div>
        <ul class="navigation">
            <li class="navigation-items">
                <a href="index.php">Home</a>
            </li>
            <li class="navigation-items">
                <a href="information.php">Information <i class="fa-solid fa-angle-down"></i></a>
                <ul class="dropdown">
                    <li><a href="availability.php">Availability</a></li>
                    <li><a href="features.php">Features</a></li>
                    <li><a href="explore.php">Explore</a></li>
                    <li><a href="localAttractions.php">Local Attractions</a></li>
                </ul>
            </li>
            <li class="navigation-items">
                <a href="contact.php">Contact</a>
            </li>
            <li class="navigation-items"> 
                <a href="reviews.php">Reviews</a>
            </li>
                <?php if((isset($_SESSION['userID']) && !empty($_SESSION['userID'])) || (isset($_COOKIE['userID']) && !empty($_COOKIE['userID']))): ?>
                <li class="navigation-items">
                    <a href="history.php">Booking History</a>
                </li>
                <li class="navigation-items">
                    <a href="utilities/logout.php">Logout</a>
                </li>
                <?php else: ?>
                <li class="navigation-items">
                    <a href="login.php">Login</a>
                </li>
                <?php endif; ?>                
            </li>
        </ul>
    </header>

    <!-- hamburger menu  -->
    <button id="menu-btn" class="hamburger" type="button">
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
    </button>
