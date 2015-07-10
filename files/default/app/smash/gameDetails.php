<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='icon' href='https://s3.amazonaws.com/leoninestudios/favicon.ico' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title>
<font>";

$gameID = $_GET['gameID'];

$sql = "SELECT * FROM smash.game g, smash.users u where g.winner_user = u.user_id and game_id=".$gameID;

$sql2 = "SELECT * FROM smash.users";


if ($_SESSION['username'])
	{
	$query = $db->query($sql);
	foreach($query as $item){
	echo"
	<form action='updatebet.php' method='POST' id='myForm2'>
	<table>
		<tr><td>GameID:</td><td><input type='text' name='gameid' disabled='disabled' value='".($item['game_id']."'></td></tr></br>
		<tr><td>Game Date:</td><td><input type='text' disabled='disabled' name='date' value='".$item['game_date']."'></td></tr></br>
		<tr><td>Winner:</td><td><select name='winner' form='myForm2' >"
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
    <td><br><button class='compact' onclick=location.href='deleteGame.php?gameID=".$item['game_date']."'>Delete Game</button></td></tr
	</table></html>");

	}

	}
else
	{
	die("You must login");
	}
?>
