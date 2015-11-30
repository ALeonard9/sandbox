<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>LeoNine Studios</title>";
include('../header.php');
echo "</head><body><div class='container'>";
include('../navigation.php');

if ($_SESSION['username'])
	{
	echo"
	<form action='newbetupdate.php' id='myForm' method='POST'>	<table>
		<tr><td>Description:</td><td><input type='text' name='description'></td></tr></br>
		<tr><td>Amount:</td><td><input type='number' name='amount'></td></tr></br>
    <tr><td>Status:</td><td><select name='status' form='myForm'>
    <option selected='selected' value='Open'>Open</option>
    <option value='Complete'>Complete</option></select></td></tr>
		<tr><td>Winner:</td><td><input type='text' name='winner'></td></tr></br>
		<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table>";

	}
else
	{
	die("You must login");
	}
include('../footer.php');
echo "</div></body></html>";
?>
