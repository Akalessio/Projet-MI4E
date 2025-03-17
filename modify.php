<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

$lname='';
$fname='';
$date='';
$mail='';
$password='';
$profile_picture='';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $date=$_POST["date"];
    $mail=$_POST["mail"];
    $profile_picture=$_POST["profile_picture"];
    if($_POST["password"]!=$_SESSION["user"]["password"]){
        $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
    }
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
            die("Unable to load user file");
        }
    }else{
        die("User file does not exist");
    }

    foreach ($registered_user as &$new_user) {
        if($new_user["mail"]==$mail){
            $new_user = [ "lname" => $lname, "fname" => $fname, "date" => $date, "mail" => $mail, "password" => $password, "rank" => $new_user['rank'], "discount" => $new_user["discount"], "profile_picture" => $profile_picture ];
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['fname'] = $fname;
            $_SESSION['user']['lname'] = $lname;
            $_SESSION['user']['date'] = $date;
            $_SESSION['user']['profile_picture'] = $profile_picture;
        }
    }

    if (file_put_contents($user_file, json_encode($registered_user, JSON_PRETTY_PRINT)) === false) {
        die("Error writing to file.");
    }



    header("location: profile.php");
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
        <form action="modify.php" method="post">

            <div class="form-item-2">
                <label class="label-text" for="fname">First Name* :</label>
                <input class="input" type="text" id="fname" name="fname" maxlength="50" required placeholder="First Name..." value="<?php echo htmlspecialchars($_SESSION['user']['fname'])?>">
            </div>

            <div class="form-item-2">
                <label class="label-text" for="lname">Name* :</label>
                <input class="input" type="text" id="lname" name="lname" maxlength="50" required placeholder="Name..." value="<?php echo htmlspecialchars($_SESSION['user']['lname'])?>">
            </div>

            <div class="form-item-2">
                <label class="label-text" for="mail">E-mail* :</label>
                <input class="input" type="email" id="mail" name="mail" required placeholder="E-mail" value="<?php echo htmlspecialchars($_SESSION['user']['mail'])?>">
            </div>

            <div class="form-item-2">
                <label class="label-text" for="mail">Password* :</label>
                <input class="input" type="password" id="password" name="password" required placeholder="Password" value="value="<?php echo htmlspecialchars($_SESSION['user']['password'])?>"">
            </div>

            <div class="form-item-2">
                <label class="label-text" for="birthdate">Birthdate* :</label>
                <input class="input" type="date" id="birthdate" name="date" required value="<?php echo htmlspecialchars($_SESSION['user']['date'])?>">
            </div>

            <div class="form-item-2">
               <label class="label-text">Profiles Picture:</label>
               <select class="input" name="profile_picture" required>
                   <option value="1">none</option>
                   <option value="2">astronaut</option>
                   <option value="3">robot</option>
                   <option value="4">spiderman</option>
                   <option value="5">alien</option>
                   <option value="6">music</option>

               </select>
            </div>

            <div class="form-item-2-3">
                <img class="profile_picture" src="assets/img/user.png" alt="user base png">
                <img class="profile_picture" src="assets/img/PP/2.png" alt="user base png">
                <img class="profile_picture" src="assets/img/PP/3.png" alt="user base png">
                <img class="profile_picture" src="assets/img/PP/4.png" alt="user base png">
                <img class="profile_picture" src="assets/img/PP/5.png" alt="user base png">
                <img class="profile_picture" src="assets/img/PP/6.png" alt="user base png">
            </div>

            <div class="form-item-2">
                <button type="submit" style="font-family: 'Montserrat', sans-serif; margin-bottom: 25px">Save changes</button>
                <br>
            </div>

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