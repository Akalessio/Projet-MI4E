<?php
session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}

if(isset($_GET['id'])){
    $page_id = $_GET['id'];
}else{
    die("Erreur 404");
}

$trip_list="assets/php/data/trip_list.json";

if(file_exists($trip_list)){
    $trips = json_decode(file_get_contents($trip_list), true);
    if($trips==null){
        die("trip file is empty");
    }
}else{
    die("trip file dont exist");
}

$current_trip='';

foreach($trips as $trip){
    if($page_id==$trip['trip_id']){
        $current_trip = $trip;
    }
}

if($current_trip==''){
    die("error while loading trip information");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/book.css">
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
                color:#8FB43A;
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

<section class="main-section">
        <div>
            <form class="book-options" action="booking.php" method="post">
                <div class="options">
                    <h2>Start Date</h2>
                    <input type="date"  name="start_date" required class="options-button">

                    <h2>End Date</h2>
                    <input type="date"  name="end_date" required class="options-button">
                </div>
                <div class="options">
                    <h2><?php echo htmlspecialchars($current_trip["step_type"])?></h2>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_1_1" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_1_1"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_1_1_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_1_2" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_1_2"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_1_2_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_1_3" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_1_3"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_1_3_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_1_4" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_1_4"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_1_4_price"])?>$
                            </span>
                        </label>
                    </div>
                </div>
                <div class="options">
                    <h2><?php echo htmlspecialchars($current_trip["step_type"])?></h2>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_2_1" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_2_1"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_2_1_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_2_2" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_2_2"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_2_2_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_2_3" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_2_3"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_2_3_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_2_4" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_2_4"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_2_4_price"])?>$
                            </span>
                        </label>
                    </div>
                </div>
                <div class="options">
                    <h2><?php echo htmlspecialchars($current_trip["step_type"])?></h2>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_3_1" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_3_1"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_3_1_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_3_2" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_3_2"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_3_2_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_3_3" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_3_3"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_3_3_price"])?>$
                            </span>
                        </label>
                    </div>
                    <div class="options-button" type="submit">
                        <label>
                            <input type="checkbox" name="option_3_4" value="1">
                            <span class="option">
                                <?php echo htmlspecialchars($current_trip["option_3_4"])?>
                            </span>
                            <span class="price">
                                <?php echo htmlspecialchars($current_trip["option_3_4_price"])?>$
                            </span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <div style="width: 200px; margin: auto">
            <a href="booking.php?id=<?php echo htmlspecialchars($current_trip["trip_id"])?>">
                <button class="options-button" style="margin: 0">BOOK</button>
            </a>
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