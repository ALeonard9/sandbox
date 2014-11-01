<?php

session_start();

include 'connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
	<link rel='stylesheet' type='text/css' href='mystyle.css'>
	<title id="pageTitle">LeoNine Studios</title>
<font>";

$betID = $_GET['betID'];

$sql = "SELECT * FROM bet.history where betID=" . $betID;

echo "<br><button onclick=location.href='updatewinner.php?betID=".$betID."&winner=Adam'>Adam Wins!</button>";
echo "<button onclick=location.href='updatewinner.php?betID=".$betID."&winner=Soumya'>Soumya Wins!</button>";
echo "<button onclick=location.href='delete.php?betID=".$betID."'>Delete Bet</button>";


if ($_SESSION['username'])
	{	
	$query = $db->query($sql);
	foreach($query as $item){
	echo"
	<!DOCTYPE html>
	<html>
	<form action='updatebet.php' method='POST'>
	<input type='hidden' name='id' value='".$item['betID']."'>
	<table>
		<tr><td>Description:</td><td><input type='text' name='description' value='".($item['betDescription']."'></td></tr></br>
		<tr><td>Amount:</td><td><input type='text' name='amount' value='".$item['betAmount']."'></td></tr></br>
		<tr><td>Status:</td><td><input type='text' name='status' value='".$item['betStatus']."'></td></tr></br>
		<tr><td>Winner:</td><td><input type='text' name='winner' value='".$item['betWinner']."'></td></tr></br>
		<tr><td>Date:</td><td><input type='text' disabled='disabled' name='date' value='".$item['betDate']."'></td></tr></br>
		<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table></html>");
	
	}
	
	}
else
	{
	die("You must login");
	}
?>

