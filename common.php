<?php

$criteria = array();
$criteria["impact"] = "Impact";
$criteria["quality"] = "Quality / Product";
$criteria["useability"] = "Useability / Design";
$criteria["sustainability"] = "Sustainability";
$criteria["teamwork"] = "Teamwork";
$criteria["presentation"] = "Presentation";

$teams = array();
$teams[1] = "Karma Project";
$teams[2] = "Take Flight";
$teams[3] = "Pickment";
$teams[4] = "al-Multaqa";
$teams[5] = "Cenna";
$teams[6] = "Cardrive.me";
$teams[7] = "Smart Museum";
$teams[8] = "Alert2Sign";
$teams[9] = "Laha";
$teams[10] = "Playtime";
$teams[11] = "notifyME";
$teams[12] = "code2gether";
$teams[13] = "Noor 3ilm";
$teams[14] = "NsynK";
$teams[15] = "Landmarkr";
$teams[16] = "Safe Journey";

define("SECRET_SALT", "kjdsgkjiw4 7t43q89tw34 uihd dfisu");

$current_team = 1;
   
$uid = isset($_COOKIE["uid"]) ? $_COOKIE["uid"] : "::";
list($email, $judge, $hash) = explode(":", $uid);

$mysql = new mysqli("localhost", "root", "", "nyuadvote");

$logged_in = $hash === md5($email . $judge . SECRET_SALT);

if(isset($_REQUEST["action"])) {
    switch($_REQUEST["action"]) {
	case 'start':
	    $email = $_POST["email"];
	    $judge = $_POST["judge"] ? 1 : 0;

	    $hash = $email . ":" . $judge . ":" . md5($email . $judge . SECRET_SALT);
	    setcookie("uid", $hash, time() + (86400*30));
	    break;

	case 'vote':
	    if(!$email || !$logged_in) {
    		header("Location: start.php");
	    }

	    $team = intval($_POST["team"]);
	    $scores = array();
	    foreach($criteria as $key=>$label) {
		$scores[$key] = $_POST[$key];
	    }
	
	    error_log("Email: " . $email . " Team: " . $team . " Votes: " . var_export($scores, true));

	    $stmt = $mysql->prepare("REPLACE INTO votes (email, judge, team, votes, ipaddress, ts) VALUES (?, ?, ?, ?, ?, ?);");

            $stmt->bind_param("siissi", $b1, $b2, $b3, $b4, $b5, $b6);
	    $b1 = $email;
	    $b2 = $judge;
	    $b3 = $team;
	    $b4 = json_encode($scores);
	    $b5 = $_SERVER["REMOTE_ADDR"];
	    $b6 = time();

	    $stmt->execute();

	    $flash_message = "Your vote has been recorded. On to the next one! :)";

	    $current_team = $team + 1;

	    break;
	
	default:
	    
    }
} else {
    if(!$logged_in && $_SERVER["REQUEST_URI"] != "/start.php" && $_SERVER["REQUEST_URI"] != "/judges.php") {
       header("Location: /start.php");
    }
}

error_log("CTeam: " . $current_team);
