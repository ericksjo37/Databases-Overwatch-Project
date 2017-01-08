<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	$timeplayed = $_POST['Hours'] . ":" . $_POST['Minutes'] . ":00.0000000";
	//Insert into table
	if(!($stmt = $mysqli->prepare("INSERT INTO ow_players_heroes(pid, hid, eliminations, deaths, playtime) VALUES (?,?,?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("iiiis",$_POST['Pid'],$_POST['Hid'],$_POST['Eliminations'],$_POST['Deaths'],$timeplayed))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " new player-hero relationship to ow_players_heroes.";
	} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Players' Heroes (INSERT)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='3_players_heroes.php'>Back to Players' Heroes</a></h3>
</body>

</html>