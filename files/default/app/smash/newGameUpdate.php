<?php

session_start();

include '../connectToDB.php';

date_default_timezone_set('America/New_York');
$date = date('Y-m-d-H', time());
echo $date;
$asql = "INSERT INTO `smash`.`game` (game_date) VALUES ('".$date."')";
echo $asql;
$db->exec($asql);
$gameid =  $db->lastInsertId();
echo $gameid;

$numPlayers = $_POST['num_players'];
echo $numPlayers;
$x = 1;
$sql = "INSERT INTO `smash`.`gamelog` VALUES";
while($x <= $numPlayers) {
		${"u$x"} = $_POST['user1'];
		${"deck1$x"} = $_POST['deck1'.$x];
		${"deck2$x"} = $_POST['deck2'.$x];
		$sql .= " ('".$gameid."', '".${"u$x"}."', '".${"deck1$x"}."'),";
		$sql .= " ('".$gameid."', '".${"u$x"}."', '".${"deck2$x"}."'),";
		$x++;
}
$sql = rtrim($sql, ',');
echo $sql;
if ($_SESSION['username'])
	{
		$db->exec($sql);
	header("Location: smash.php");
		exit;
	}
else
	{
	die("You must login");
	}
?>
