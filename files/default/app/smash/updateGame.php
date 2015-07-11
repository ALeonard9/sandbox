<?php

session_start();

include '../connectToDB.php';

$gameID = $_POST['gameid'];
$gameNotes = $_POST['notes'];
$gameWinner = $_POST['winner'];

$sql = "UPDATE `smash`.`game` SET `game_id`='".$gameID."', `winner_user`='".$gameWinner."', `game_notes`='".$gameNotes."' WHERE `game_id`='".$gameID."'";

if ($_SESSION['username'])
	{
		$db->exec($sql);
		header("Location: gameRecords.php");
		exit;
	}
else
	{
	die("You must login");
	}
?>
