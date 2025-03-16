<?php

$lname='';
$fname='';
$date='';
$mail='';
$password='';
$rank='user';
$discount='0';
$profile_picture='1';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $date=$_POST["date"];
    $mail=$_POST["mail"];
    $password=password_hash($_POST["password"],PASSWORD_DEFAULT);

    if(!$mail){
        exit("Please enter a valid email address");
    }

    if(empty($password)){
        die("Please enter a password");
    }

    $user_file = "assets/php/data/user_list.json";

    if (file_exists($user_file)) {
        $registered_user = json_decode(file_get_contents($user_file), true);
        if($registered_user == null){
            $registered_user = [];
        }
    }else{
        $registered_user = [];
    }

    foreach ($registered_user as $user) {
        if($user["mail"]==$mail){
            die("This mail is already registered");
        }
    }



    $new_user = [ "lname" => $lname, "fname" => $fname, "date" => $date, "mail" => $mail, "password" => $password, "rank" => $rank, "discount" => $discount, "profile_picture" => $profile_picture, "trip_file" => base64_encode("$mail") . ".json"];

    $registered_user[] = $new_user;

    if (file_put_contents($user_file, json_encode($registered_user, JSON_PRETTY_PRINT)) === false) {
        die("Error writing to file.");
    }

    header("location: login.php");
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
</head>
<body style="width: 100%; margin: 0; padding: 0; background: #DCDFDA">
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
    </div>
</div>

<div class="form-container">
    <div class="form-2">
        <form action="sign.php" method="post">

            <div class="form-item-2">
                <!--<label class="label-text" for="fname">First Name* :</label>-->
            <input class="input" type="text" id="fname" name="fname" maxlength="50" required placeholder="First Name...">
            </div>

            <div class="form-item-2">
            <!-- <label class="label-text" for="lname">Name* :</label> -->
            <input class="input" type="text" id="lname" name="lname" maxlength="50" required placeholder="Name...">
            </div>

            <div class="form-item-2">
                <!-- <label class="label-text" for="mail">E-mail* :</label> -->
            <input class="input" type="email" id="mail" name="mail" required placeholder="E-mail">
            </div>

            <div class="form-item-2">
                <!--  <label class="label-text" for="mail">Password* :</label> -->
            <input class="input" type="password" id="password" name="password" required placeholder="Password">
            </div>

            <div class="form-item-2">
                <!-- <label class="label-text" for="birthdate">Birthdate* :</label> -->
            <input class="input" type="date" id="birthdate" name="date" required>
            </div>

            <div class="form-item-2">
            <input type="checkbox" id="terms" required>
            <label style="font-family: 'Montserrat', sans-serif; text-align: center; color: #DCDFDA" for="terms">By checking this box, you declare that you have read and accepted our<a href="terms.html" target="_blank" style="text-decoration: none; color: #8FB43A"> terms</a></label>
            </div>

            <div class="form-item-2">
            <button type="submit" style="font-family: 'Montserrat', sans-serif; margin-bottom: 25px">Sign in</button>
            <br>
            </div>



            <div class="item-bsb">
                <p style="font-family: 'Montserrat', sans-serif; font-size: 25px; color: #DCDFDA">
                    You have an account ?
                </p>
                <a href="login.php">
                    <button style="font-family: 'Montserrat', sans-serif" type="button">Log in</button>
                </a>
            </div>

            <p style="font-family: 'Montserrat', sans-serif; text-align: center"> * Mandatory</p>

            </form>
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