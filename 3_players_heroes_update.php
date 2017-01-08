<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","krusej-db","cNVk3SAKmS2mK3ZE","krusej-db");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	$timeplayed = "'" . $_POST['Hours'] . ":" . $_POST['Minutes'] . ":00.0000000'";
	//echo $timeplayed;
	
	//Update row
	if(!($stmt = $mysqli->prepare("UPDATE ow_players_heroes SET eliminations = ?, deaths = ?, playtime = " . $timeplayed . " WHERE ow_players_heroes.pid = ? AND ow_players_heroes.hid = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("iiii",$_POST['Eliminations'],$_POST['Deaths'],$_POST['Pid'],$_POST['Hid']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " hero details in ow_heroes.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
  <title>Overwatch Database: Players' Heroes (Update)</title>
  <link rel="stylesheet" href="style-home.css" type="text/css">
</head>

<body>
	<h3><a href='3_players_heroes.php'>Back to Players' Heroes</a></h3>
</body>

</html>