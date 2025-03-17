<?php
session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header("Location:login.php");
    exit();
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

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['end_date']) AND isset($_POST['start_date'])){
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        if($start>$end){
            die("Start date must be after end date");
        }
        $interval = $start->diff($end);
        $days = $interval->days;
    }else{
        die("error while loading date information");
    }
        $number=$_POST['number'];

        $option_1_1='';
        $option_1_2='';
        $option_1_3='';
        $option_1_4='';
        $option_2_1='';
        $option_2_2='';
        $option_2_3='';
        $option_2_4='';
        $option_3_1='';
        $option_3_2='';
        $option_3_3='';
        $option_3_4='';

        $option_1_1=$_POST['option_1_1'];
        $option_1_2=$_POST['option_1_2'];
        $option_1_3=$_POST['option_1_3'];
        $option_1_4=$_POST['option_1_4'];
        $option_2_1=$_POST['option_2_1'];
        $option_2_2=$_POST['option_2_2'];
        $option_2_3=$_POST['option_2_3'];
        $option_2_4=$_POST['option_2_4'];
        $option_3_1=$_POST['option_3_1'];
        $option_3_2=$_POST['option_3_2'];
        $option_3_3=$_POST['option_3_3'];
        $option_3_4=$_POST['option_3_4'];

        if($option_1_1!='' AND $option_1_2='' AND  $option_1_3='' AND  $option_1_4=''){
            die('select at least one' . htmlspecialchars($current_trip['step_type']));
        }

        $price=0;

    if($option_1_1!=''){
        $price+=$current_trip['option_1_1_price'];
    }
    if($option_1_2!=''){
        $price+=$current_trip['option_1_2_price'];
    }
    if($option_1_3!=''){
        $price+=$current_trip['option_1_3_price'];
    }
    if($option_1_4!=''){
        $price+=$current_trip['option_1_4_price'];
    }
    if($option_2_1!=''){
        $price+=$current_trip['option_2_1_price'];
    }
    if($option_2_2!=''){
        $price+=$current_trip['option_2_2_price'];
    }
    if($option_2_3!=''){
        $price+=$current_trip['option_2_3_price'];
    }
    if($option_2_4!=''){
        $price+=$current_trip['option_2_4_price'];
    }
    if($option_3_1!=''){
        $price+=$current_trip['option_3_1_price'];
    }
    if($option_3_2!=''){
        $price+=$current_trip['option_3_2_price'];
    }
    if($option_3_3!=''){
        $price+=$current_trip['option_3_3_price'];
    }
    if($option_3_4!=''){
        $price+=$current_trip['option_3_4_price'];
    }
    $price+=($current_trip['minimun_price']*$days*0.5);
    $price*=$number;

    $reservations_list = json_decode(file_get_contents('assets/php/data/trip_file/' . $_SESSION['user']['trip_file']), true);
    if($reservations_list==null){
        die("trip file is empty");
    }

    $error=false;

    foreach ($reservations_list as $reservation){
        if(($start_date>$reservation['start_date'] AND $start_date<$reservation['end_date']) OR
            ($end_date>$reservation['start_date'] AND $end_date<$reservation['end_date']) OR
            ($start_date<$reservation['start_date']  AND $end_date>$reservation['end_date']) OR
            ($start_date==$reservation['start_date'] AND $end_date==$reservation['end_date'])){
            $error=true;
        }
    }

    if($error){
        die("you already have a trip on this period of time");
    }

    $new_trip=[
            "trip_name"=>$current_trip['trip_name'],
            "trip_id"=>$current_trip['trip_id'],
            "option_1_1"=>$option_1_1,
            "option_1_2"=>$option_1_2,
            "option_1_3"=>$option_1_3,
            "option_1_4"=>$option_1_4,
            "option_2_1"=>$option_2_1,
            "option_2_2"=>$option_2_2,
            "option_2_3"=>$option_2_3,
            "option_2_4"=>$option_2_4,
            "option_3_1"=>$option_3_1,
            "option_3_2"=>$option_3_2,
            "option_3_3"=>$option_3_3,
            "option_3_4"=>$option_3_4,
            "price"=>$price,
            "start_date"=>$start_date,
            "end_date"=>$end_date,
            "duration"=>$days,
            "number"=>$number
    ];

    $_SESSION['new_trip']=$new_trip;

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
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required class="options-button">

                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date"  name="end_date" required class="options-button">
                </div>
                <div class="options">
                    <h2><?php echo htmlspecialchars($current_trip["step_type"])?></h2>
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <h2>Vehicle</h2>
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <h2>Activities</h2>
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                    <div class="options-button">
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
                <div class="options">
                    <label for="number">How many people</label>
                    <select id="number" name="number" class="options-button-number">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </form>
        </div>

        <div style="width: 200px; margin: auto">
            <a href="booking.php?id=<?php echo htmlspecialchars($current_trip["trip_id"])?>">
                <button class="options-button" style="margin: 0">BOOK</button>
            </a>
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