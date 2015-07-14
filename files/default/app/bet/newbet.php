<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>LeoNine Studios</title>
<font>";



if ($_SESSION['username'])
	{
	echo"
	<!DOCTYPE html>
	<html>
	<form action='newbetupdate.php' id='myForm' method='POST'>	<table>
		<tr><td>Description:</td><td><input type='text' name='description'></td></tr></br>
		<tr><td>Amount:</td><td><input type='number' name='amount'></td></tr></br>
    <tr><td>Status:</td><td><select name='status' form='myForm'>
    <option selected='selected' value='Open'>Open</option>
    <option value='Complete'>Complete</option></select></td></tr>
		<tr><td>Winner:</td><td><input type='text' name='winner'></td></tr></br>
		<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table></html>";

	}
else
	{
	die("You must login");
	}
?>
