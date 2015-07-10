<?php

session_start();

include '../connectToDB.php';

$numPlayers = $_POST['num_players'];

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title>
<font>";



if ($_SESSION['username'])
	{
    echo"
    <!DOCTYPE html>
    <html>
    <form action='newGameUpdate.php' method='POST'>	<table>
    <input type='hidden' name='num_players' value='".$numPlayers."'>
    <input type='hidden' name='gameid' value='".$gameid."'>";;
    $x = 1;

    while($x <= $numPlayers) {
        echo "<tr><td>User ".$x.":</td><td><input type='text' name='user".$x."'></td></tr></br>
        <tr><td>Deck 1:</td><td><input type='text' name='deck1".$x."'></td></tr></br>
        <tr><td>Deck 2:</td><td><input type='text' name='deck2".$x."'></td></tr></br></br></br>";
        $x++;
    }

		echo"<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table></html>";

	}
else
	{
	die("You must login");
	}
?>
