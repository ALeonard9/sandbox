<?php

session_start();

include '../connectToDB.php';

$numPlayers = $_POST['num_players'];
$sql = "select * from smash.users";
$queryopen = $db->query($sql);
echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='icon' href='https://s3.amazonaws.com/leoninestudios/favicon.ico' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title></head>
<font>";
if ($_SESSION['username'])
	{
    echo "
    <form action='newGameUpdate.php' method='POST' id='myForm'>	<table>
    <input type='hidden' name='num_players' value='".$numPlayers."'>
    <input type='hidden' name='gameid' value='".$gameid."'>";
    $x = 1;
    while($x <= $numPlayers) {
        echo "<tr><td>User ".$x.":</td><td><select form='myForm' name='user".$x."'>
        <option disabled='disabled' selected='selected'>Select Player</option>";
        $sql = "select * from smash.users order by display_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option value=".($item['user_id'].">".$item['display_name']."</option>");
        };
        echo "</select></td></tr></br>
        <tr><td>Deck 1:</td><td><select form='myForm' name='deck1".$x."'>
        <option disabled='disabled' selected='selected'>Select Deck</option>";
        $sql = "select * from smash.deck order by faction_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option value=".($item['deck_id'].">".$item['faction_name']."</option>");
        };
        echo "</select></td></tr></br>
        <tr><td>Deck 2:</td><td><select form='myForm' name='deck2".$x."'>
        <option disabled='disabled' selected='selected'>Select Deck</option>";
        $sql = "select * from smash.deck order by faction_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option value=".($item['deck_id'].">".$item['faction_name']."</option>");
        };
        echo "</select></td></tr></br>";
        $x++;
    }
		echo"<tr><td><input type='submit' value='Submit'></td></form>
		<td><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></td></tr></br>
	</table>";
	}
else
	{
	die("You must login");
	}
  echo"</font></html>";
?>
