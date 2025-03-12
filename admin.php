<?php
session_start();

if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}

$user = $_SESSION['user'];
$user_list='assets/php/user_list.json';

if(file_exists($user_list)){
    $registred_user=json_decode(file_get_contents($user_list), true);
    if($registred_user == null){
        $registred_user = [];
    }
}else{
    die('user_list not found');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail=$_POST["mail"];
    $action=$_POST["action"];

    $rank='';
    $discount='';

    switch ($action) {
        case "add_admin":
            $rank="admin";
            break;
        case "unban_account":
        case "remove_admin":
            $rank='user';
            break;
        case "add_vip":
            $rank="vip";
            break;
        case "ban_account":
            $rank="ban";
            break;
        case "free_trip":
            $discount="100";
            break;
        default:
            break;
    }

    foreach ($registred_user as &$user_read) {
        if($user_read['mail']==$mail AND $rank!=''){
            $user_read['rank']=$rank;
        }
        if($user_read['mail']==$mail AND $discount!=''){
            $user_read['discount']=$discount;
        }
    }

    unset($user_read);

    if($_SESSION['user']['mail']==$mail){
        if($rank!='')$_SESSION['user']['rank']=$rank;
        if($discount!='')$_SESSION['user']['discount']=$discount;
    }
    if(file_put_contents($user_list, json_encode($registred_user, JSON_PRETTY_PRINT)) === false){
        die('Error writing to file');
    }

   header('location:admin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile.css">
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

<section class="profile-section">
    <div class="profile-container-4">
        <div class="my-account">
            <ul class="account-list-bis" style="list-style: none">
                <li class="list-item-name">
                    <h1>
                        Account List
                    </h1>
                </li>
                <li>
                    <ul style="background: #DCDFDA; padding: 7px; border: 5px solid #4B5943; border-radius: 15px; text-align: left; list-style: none; place-self: center">
                        <li class="list-item">
                        <div class="account-list-item">
                            <p>
                                First Name
                            </p>
                            <p style="color: #002b5c">
                                Last Name
                            </p>
                            <p>
                                E-Mail
                            </p>
                            <p style="color: #002b5c">
                                    Password
                            </p>
                            <p>
                                Rank
                            </p>
                        </div>
                        </li >'
                        <?php
                        $user_list='assets/php/user_list.json';
                        if(file_exists($user_list)){
                            $registred_user=json_decode(file_get_contents($user_list), true);
                            if($registred_user == null){
                                $registred_user = [];
                            }
                        }else{
                            die('user_list not found');
                        }

                        foreach ($registred_user as $user_read) {
                            if($user_read!=null){
                                echo '<li class="list-item">
                            <div class="account-list-item">
                                <p>
                                    '.$user_read['lname'].'
                                </p>
                                <p style="color: #002b5c">
                                    '.$user_read['fname'].'
                                </p>
                                <p>
                                    '.$user_read['mail'].'
                                </p>
                                <p style="color: #002b5c">
                                    *******
                                </p>
                                <p>
                                    '.$user_read['rank'].'
                                </p>
                            </div>
                        </li >';
                            }
                        }
                       ?>
                    </ul>
                    <div>
                        <a href="profile.php">
                            <button class="change-pannel" style="margin-left: 15px">
                                Profile Pannel
                            </button>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="profile-container">
        <div class="my-reservation">
            <ul style="padding: 0 40px; font-family: 'Montserrat', sans-serif">
                <li class="list-item" >
                    <h1>
                        Admin Pannel
                    </h1>
                </li>
                <li class="list-reservation">
                    <p style="font-family: 'Montserrat', sans-serif; font-size: 30px; color: #DCDFDA">Change customer status</p>
                    <form action="admin.php" method="post">
                        <input type="email"  name="mail" required placeholder="Account E-mail..." class="input-account">
                        <ul class="ul-button">
                            <li>
                                <button class="green-light" type="submit" name="action" value="add_vip">
                                    Add VIP rank
                                </button>
                            </li>
                            <li>
                                <button class="red-light" type="submit" name="action" value="ban_account">
                                    Ban account
                                </button>
                            </li>
                            <li>
                                <button class="blue-light" type="submit" name="action" value="unban_account">
                                    Unban account
                                </button>
                            </li>
                            <li>
                                <button class="pink-light" type="submit" name="action" value="free_trip">
                                    Gift a free Trip
                                </button>
                            </li>
                            <li>
                                <button class="orange-light" type="submit" name="action" value="add_admin">
                                    Add Admin Rank
                                </button>
                            </li>
                            <li>
                                <button class="black-light" type="submit" name="action" value="remove_admin">
                                    Remove Admin Rank
                                </button>
                            </li>
                        </ul>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</section>

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