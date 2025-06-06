<?php
session_start();

$mail='';
$password='';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $mail=$_POST["loginMail"];
    $password=$_POST["psw"];

    $user_file = 'assets/php/data/user_list.json';

    $found=false;

    if(file_exists($user_file)){
        $registered_users = json_decode(file_get_contents($user_file), true);
        foreach($registered_users as $user_read){
            if($mail==$user_read["mail"] && password_verify($password, $user_read["password"])){
                $_SESSION["user"] = [
                    "mail" => $user_read["mail"],
                    "fname" => $user_read["fname"],
                    "lname" => $user_read["lname"],
                    "date" => $user_read["date"],
                    "password" => $user_read["password"],
                    "rank" => $user_read["rank"],
                    "discount" => $user_read["discount"],
                    "profile_picture" => $user_read["profile_picture"],
                    "trip_file" => $user_read["trip_file"],
                ];
                if($user_read["rank"]=="ban"){
                    die('this account is banned');
                }
                $found=true;
            }
        }
    }else{
        die("User list not found");
    }

    if(!$found){
        header("location:login.php?error=invalid_credentials");
        exit();
    }

header("location:profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link  rel="stylesheet" href="https://db.onlinewebfonts.com/c/485fe91395665a0ac50e25744ff3a19c?family=Get+Schwifty">
    <script src="assets/js/main.js"></script>
    <script>
        (function () {
            const localTheme = localStorage.getItem('theme');
            if (localTheme === 'dark'){
                document.documentElement.classList.add('dark')
            }
        })();
    </script>
</head>
<body style="width: 100%; margin: 0; padding: 0;">
<div class="site-header">
    <div class="title">
        <h2>
            <a href="index.php">
                <span style=" font-family: 'Get Schwifty', sans-serif;
                font-size: 48px;
                font-weight: bold;
                color: #DCDFDA;
                display: inline-block">
                    Dimension'
                </span><span style=" font-family: 'Get Schwifty', sans-serif;
                font-size: 48px;
                font-weight: bold;
                color:#41e00b;
                display: inline-block">
                    Trip
                </span>
            </a>
        </h2>
    </div>
    <div class="right-icon">

        <div class="search-bar">
            <input type="text" placeholder="Search">
            <a href="#">
                <i class="fas fa-search"></i>
            </a>
        </div>
        <a href="triplist.php" class="mid-link-item">
            Book a trip
        </a>
        <a href="#contact" class="mid-link-item">
            Contact Us
        </a>
        <?php
        if(isset($_SESSION['user'])){
            echo '<a href="basket.php" class="mid-link-item">
                        <img src="assets/img/basket.png" alt="Basket" width="50" height="50">
                     </a>';
        }
        ?>

        <a href="profile.php">
            <img src="assets/img/PP/<?php if(isset($_SESSION['user'])){echo $_SESSION['user']['profile_picture'];}else{echo 1;};?>.png" alt="profile icon" width="50" height="50">
        </a>
        <?php
        if(!isset($_SESSION['user'])){
            echo '<a href="login.php" class="mid-link-item">
                        Login
                     </a>';
        }
        ?>
        <div id="theme" class="theme-container">
            <div class="litte-big-ball"></div>
        </div>
    </div>
</div>

<div class="form-container">
    <div class="form">
        <form action="login.php" method="post">
            <div class="form-item" style="margin: 50px">
                <label for="loginMail" class="label-text">E-mail :</label>
                <input type="email" id="loginMail" name="loginMail" required class="input" placeholder="E-mail" >
            </div>
            <div class="form-item" style="margin-bottom: 100px">
                <label for="psw" class="label-text">Password :</label>
                <input type="password" id="psw" name="psw" required class="input" placeholder="Password..." >
            </div>

            <div class="form-item">
                    <button type="submit" style="font-family: 'Montserrat', sans-serif; z-index: 999">Login</button>
            </div>
        </form>

        <div class="item-bsb">
            <p style="font-family: 'Montserrat', sans-serif; font-size: 25px; color: #4B5943">
                You don't have an account ?
            </p>
            <a href="sign.php">
                <button style="font-family: 'Montserrat', sans-serif">Sign-In</button>
            </a>
        </div>
    </div>
</div>

<div id="contact" class="site-footer">
    <div>
        <a href="https://github.com/Akalessio/Projet-MI4E" target="_blank" style="margin-left: 10px; text-decoration: none; font-family: 'Montserrat', sans-serif" class="team-div">
            <h1 class="mid-link-item-contact" style="pointer-events: none">
                Contact :
            </h1>
            <img src="assets/img/team.png" alt="team-logo" width="50" height="50">
            <h1 class="mid-link-item">
                Project-MI4E's team
            </h1>
        </a>
    </div>
    <div class="social-icon">
        <a href="https://www.instagram.com/" target="_blank">
            <img src="assets/img/insta.png" alt="instagram logo" height="75" width="75">
        </a>
        <a href="https://x.com/?lang=fr" target="_blank">
            <img src="assets/img/x.png" alt="x logo" height="50" width="50">
        </a>
        <a href="https://www.facebook.com/?locale=fr_FR" target="_blank" style="margin-left: 20px; margin-right: 20px">
            <img src="assets/img/face.png" alt="facebool logo" height="50" width="50">
        </a>
    </div>
</div>
</body>
</html>