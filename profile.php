<?php
session_start();



if(!isset($_SESSION['user'])){
    header("Location:login.php");
    exit();
}

$user = $_SESSION['user'];



?>

 html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link  rel="stylesheet" href="https://db.onlinewebfonts.com/c/485fe91395665a0ac50e25744ff3a19c?family=Get+Schwifty">
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/profileModification.js" defer></script>
</head>
<body style="width: 100%; margin: 0; padding: 0; ">
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
            <img id="pdp" src="assets/img/PP/<?php if(isset($_SESSION['user'])){echo $_SESSION['user']['profile_picture'];}else{echo 1;};?>.png" alt="profile icon" width="50" height="50" >
        </a>
        <a href="assets/php/logout.php" class="mid-link-item">
                        Log-out
        </a>
        <div id="theme" class="theme-container">
            <div class="litte-big-ball"></div>
        </div>
    </div>
</div>

<section class="profile-section">
        <div class="profile-container-3">
            <div class="my-account">
                <ul class="account-list">

                    <li class="list-item-name">
                        <h1>
                            My Account
                        </h1>
                    </li>

                    <li class="list-item">
                        <label>
                            Firstname
                        </label>
                        <div class="list-item-117">
                            <input type="text" value="<?php echo htmlspecialchars($_SESSION["user"]["fname"]); ?>" id="firstname" class="input-account" readonly>
                            <button class="edit" onclick="enableEdit('firstname')"><img src="assets/img/modif.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="save" onclick="saveEdit('firstname')" style="display:none"><img src="assets/img/check.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="cancel" onclick="cancelEdit('firstname')" style="display:none"><img src="assets/img/cross.png" alt="modif-icon" width="30" height="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div >
                    </li>
                    <li class="list-item">
                        <label>
                            Name
                        </label>
                        <div class="list-item-117">
                            <input type="text" value="<?php echo htmlspecialchars($_SESSION["user"]["lname"]); ?>" id="name" class="input-account" readonly>
                            <button class="edit" onclick="enableEdit('name')"><img src="assets/img/modif.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="save" onclick="saveEdit('name')" style="display:none"><img src="assets/img/check.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="cancel" onclick="cancelEdit('name')" style="display:none"><img src="assets/img/cross.png" alt="modif-icon" width="30" height="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div>
                    </li>
                    <li class="list-item">
                        <label>
                            Birthdate
                        </label>
                        <div class="list-item-117">
                            <input type="text" value="<?php echo htmlspecialchars($_SESSION["user"]["date"]); ?>" id="date" class="input-account" readonly>
                            <button class="edit" onclick="enableEdit('date')"><img src="assets/img/modif.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="save" onclick="saveEdit('date')" style="display:none"><img src="assets/img/check.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="cancel" onclick="cancelEdit('date')" style="display:none"><img src="assets/img/cross.png" alt="modif-icon" width="30" height="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div>
                    </li>
                    <li class="list-item">
                        <label>
                            E-mail
                        </label>
                        <div class="list-item-117">
                            <input type="email" value="<?php echo htmlspecialchars($_SESSION["user"]["mail"]); ?>" id="email" class="input-account" readonly>
                            <button class="edit-btn" onclick="enableEdit('email')"><img src="assets/img/modif.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="save-btn" onclick="saveEdit('email')" style="display:none"><img src="assets/img/check.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="cancel-btn" onclick="cancelEdit('email')" style="display:none"><img src="assets/img/cross.png" alt="modif-icon" width="30" height="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div>
                    </li>
                    <li class="list-item">
                        <label>
                            Password
                        </label>
                        <div class="list-item-117">
                            <input type="password" value="xxxxxxxxxx" id="password" class="input-account" readonly>
                            <button class="edit-btn" onclick="enableEdit('password')"><img src="assets/img/modif.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="save-btn" onclick="saveEdit('password')" style="display:none"><img src="assets/img/check.png" alt="modif-icon" width="30" height="30"></button>
                            <button class="cancel-btn" onclick="cancelEdit('password')" style="display:none"><img src="assets/img/cross.png" alt="modif-icon" width="30" height="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div>
                    </li>
                    <li class="list-item">
                        <label>Profile Picture</label>
                        <div class="list-item-117">
                            <select style="color: #333333" id="profile_picture_select" class="input" disabled onchange="previewProfilePicture(this.value)" >
                                <?php
                                $current_pic = $_SESSION['user']['profile_picture'];
                                $options = [
                                    "1" => "None",
                                    "2" => "Astronaut",
                                    "3" => "Robot",
                                    "4" => "Spiderman",
                                    "5" => "Alien",
                                    "6" => "Music"
                                ];
                                foreach ($options as $value => $label) {
                                    $selected = ($value == $current_pic) ? "selected" : "";
                                    echo "<option value=\"$value\" $selected>$label</option>";
                                }
                                ?>
                            </select>
                            <button class="edit" onclick="enableProfilePicEdit()"><img src="assets/img/modif.png" width="30"></button>
                            <button class="save" onclick="saveEdit('profile_picture_select')" style="display:none"><img src="assets/img/check.png" width="30"></button>
                            <button class="cancel" onclick="cancelEdit('profile_picture_select')" style="display:none"><img src="assets/img/cross.png" width="30"></button>
                            <img src="assets/img/gif/load.gif" alt="load-gif" width="30" height="30" style="place-self: center; display: none">
                        </div>
                    </li>
                    <li class="list-item" style="margin-top: 10px; place-self: center">
                        <img id="profile_picture_preview" src="assets/img/PP/<?php echo $_SESSION['user']['profile_picture']; ?>.png" alt="preview" width="80" height="80" style="border: 3px solid #4B5943; border-radius: 15px;">
                    </li>
                    <li class="list-item">
                        <form id="profile-form" action="modify.php" method="post" style="display: none;" onsubmit="return gatherAndSubmit()">
                            <input type="hidden" name="fname" id="hidden-fname">
                            <input type="hidden" name="lname" id="hidden-lname">
                            <input type="hidden" name="date" id="hidden-date">
                            <input type="hidden" name="mail" id="hidden-email">
                            <input type="hidden" name="password" id="hidden-password">
                            <input type="hidden" name="profile_picture" id="hidden-profile-picture">
                            <button type="submit">Submit Modification</button>
                        </form>
                        <button class="change-pannel" id="submitModif" style="display:none;border: 4px solid #4B5943" onclick="if(gatherAndSubmit()){ document.getElementById('profile-form').submit(); }">Submit</button>

                    </li>



                    <?php
                    if ($_SESSION["user"]["rank"] == "admin"){
                        echo   '<li class="list-item">
                                    <a href="admin.php">
                                        <button style="border: 4px solid #4B5943" class="change-pannel">
                                            Admin Pannel
                                        </button>
                                    </a>
                                </li>';
                    }
                    ?>
                    <?php
                    if ($_SESSION["user"]["discount"] == "0"){
                        echo   '<li class="list-item">
                                    <p>Discount availble:</p>
                                    <a>
                                        <button style="border: 4px solid #4B5943" class="change-pannel">
                                            None
                                        </button>
                                    </a>
                                </li>';
                    }elseif($_SESSION["user"]["discount"] == "100"){
                        echo   '<li class="list-item">
                                    <p>Discount availble:</p>
                                    <a href="triplist.php">
                                        <button style="border: 4px solid #4B5943" class="change-pannel">
                                            You have a free trip !!!!
                                        </button>
                                    </a>
                                </li>';
                    }else{
                        echo   '<li class="list-item">
                                    <p>Discount availble:</p>
                                    <a href="triplist.php">
                                        <button style="border: 4px solid #4B5943" class="change-pannel">
                                            <p>-' . htmlspecialchars($_SESSION["user"]["discount"]) . '% </p>
                                        </button>
                                    </a>
                                </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="profile-container">
            <div class="my-reservation">
                <ul style="padding: 0 40px; font-family: 'Montserrat', sans-serif">
                    <li class="list-item" >
                        <h1>
                            My reservation
                        </h1>
                    </li>
                    <li class="list-reservation">
                        <div style="background: #DCDFDA; padding: 7px; border: 5px solid #4B5943; border-radius: 15px; text-align: left">
                            <ul class="list-reservation">
                                <?php

                                $trip_file = 'assets/php/data/trip_file/' . $_SESSION['user']['trip_file'];
                                if (file_exists($trip_file)) {
                                    $trip_list = json_decode(file_get_contents($trip_file), true);
                                    foreach ($trip_list as $trips) {
                                        echo '<li class="list-reservation-2">
                                                   <a href="tripcheck.php?id='.$trips['start_date'].'">
                                                        '. $trips['trip_name'] .'
                                                    </a>
                                                    <br>
                                                        Depart date : '. $trips['start_date'] .'
                                            </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
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
<script>
    function gatherAndSubmit() {
        document.getElementById('hidden-fname').value = document.getElementById('firstname').value;
        document.getElementById('hidden-lname').value = document.getElementById('name').value;
        document.getElementById('hidden-date').value = document.getElementById('date').value;
        document.getElementById('hidden-email').value = document.getElementById('email').value;
        document.getElementById('hidden-password').value = document.getElementById('password').value;
        document.getElementById('hidden-profile-picture').value = document.getElementById('profile_picture_select').value;
        return true;
    }
</script>
</body>
</html>