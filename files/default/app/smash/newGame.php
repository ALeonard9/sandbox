<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head>
<font>";



if ($_SESSION['username'])
	{
	echo"
	<!DOCTYPE html>
	<html>
	<form action='newGamePlayers.php' method='POST'>	<table>
		<tr><td>How many players? (2-4): </td><td><input type='number' name='num_players' min='2' max='4'></td></tr></br>
		<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table></html>";

	}
else
	{
	die("You must login");
	}
echo"</font></head></html>";
?>
