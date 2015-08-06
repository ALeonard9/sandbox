<?php

session_start();

include '../connectToDB.php';
include 'functions/functions.php';

$numPlayers = $_POST['num_players'];
$players = array();
$u1 = $_POST['nuser1'];
$u2 = $_POST['nuser2'];
$u3 = $_POST['nuser3'];
$u4 = $_POST['nuser4'];

for ($x = 1; $x <= $numPlayers; $x++) {
  ${'u'.$x} = $_POST['user'.$x];
  array_push($players, ${'u'.$x});
}
shuffle($players);

$sql2 = "SELECT deck_id FROM smash.deck";
$decks = array();
$querydecks = $db->query($sql2);
foreach($querydecks as $deck){
  array_push($decks, $deck['deck_id']);
}
shuffle($decks);
$sql = "SELECT * FROM smash.users";
$queryopen = $db->query($sql);
echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head><body>

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
        <option disabled='disabled' >Select Player</option>";
        $sql = "select * from smash.users order by display_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option ";
                if ($item['user_id'] == $players[$x])
                {
                  echo "selected='selected' ";
                }
                echo "value=".($item['user_id'].">".$item['display_name']."</option>");
        };
        echo "</select></td></tr></br>
        <tr><td>Deck 1:</td><td><select form='myForm' name='deck1".$x."'>
        <option disabled='disabled' selected='selected'>Select Deck</option>";
        $sql = "select * from smash.deck order by faction_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option ";
                if ($item['deck_id'] == $decks[($x*2)+1])
                {
                  echo "selected='selected' ";
                }
                echo "value=".($item['deck_id'].">".$item['faction_name']."</option>");
        }
        echo "</select></td></tr></br>
        <tr><td>Deck 2:</td><td><select form='myForm' name='deck2".$x."'>
        <option disabled='disabled' selected='selected'>Select Deck</option>";
        $sql = "select * from smash.deck order by faction_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option ";
                if ($item['deck_id'] == $decks[($x*2)+2])
                {
                  echo "selected='selected' ";
                }
                echo "value=".($item['deck_id'].">".$item['faction_name']."</option>");
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
  echo"</font></body></html>";
?>
