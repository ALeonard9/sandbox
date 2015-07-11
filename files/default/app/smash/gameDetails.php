<?php

session_start();

include '../connectToDB.php';
include 'functions/functions.php'

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='icon' href='https://s3.amazonaws.com/leoninestudios/favicon.ico' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title>
<font>";

$gameID = $_GET['gameID'];

$sql = "SELECT * FROM smash.game g, smash.users u WHERE g.winner_user = u.user_id AND game_id=".$gameID;

$sql2 = "SELECT * FROM smash.users";

$sql3 = "SELECT l.l_user_id AS user, l.l_deck_id AS deck1, k.l_deck_id AS deck2 FROM smash.gamelog l, smash.gamelog k WHERE l.l_game_id = k.l_game_id AND l.l_user_id = k.l_user_id AND l.l_deck_id < k.l_deck_id AND l.l_game_id =".$gameID;


if ($_SESSION['username'])
	{
	$query = $db->query($sql);
	foreach($query as $item){
	echo"
	<form action='updateGame.php' method='POST' id='myForm2'>
	<table>
		<tr><td>GameID:</td><td><input type='text' name='gameid' disabled='disabled' value='".($item['game_id']."'></td></tr></br>
		<tr><td>Game Date:</td><td><input type='text' disabled='disabled' name='date' value='".$item['game_date']."'></td></tr></br>
		<tr><td>Notes:</td><td><input type='text' name='notes' value='".$item['game_notes']."'></td></tr></br>
    <tr><td>Winner:</td><td><select name='winner' form='myForm2' >
    <option disabled='disabled' >Select Winner</option>";
    $queryopen = $db->query($sql2);
    foreach($queryopen as $thing){
      echo "<option";
      if ($item['winner_user'] = $thing['user_id'])
      {
        echo "selected='selected'";
      }
       echo "value=".($thing['user_id'].">".$thing['display_name']."</option>");
    }
    echo "</select></td></tr></br>
		<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></br>
    <td><br><button class='compact' onclick=location.href='deleteGame.php?gameID=".$item['game_id']."'>Delete Game</button></td></tr
	</table>");
  echo "<br><h3>Competitors</h3>
  <table><tr><td>Player</td><td>Deck 1</td><td>Deck 2</td></tr>";
  $query3 = $db->query($sql3);
  foreach($query3 as $stuff){
    $user = nameUser($stuff['user']);
    $deck1 = nameDeck($stuff['deck1']);
    $deck2 = nameDeck($stuff['deck2']);
    echo "<tr><td>".$user."</td><td>".$deck1."</td><td>".$deck2."</td></tr>";
  }

  echo "</table></html>");

	}

	}
else
	{
	die("You must login");
	}
?>
