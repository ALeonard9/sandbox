<?php

session_start();

include '../connectToDB.php';
include 'functions/functions.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head>
<font>";

$gameID = $_GET['gameID'];

$sql = "SELECT * FROM smash.game g left join smash.users u on g.winner_user = u.user_id where  game_id=".$gameID;

$sql2 = "SELECT * FROM smash.users";

$sql3 = "SELECT l.l_user_id AS user, l.l_deck_id AS deck1, k.l_deck_id AS deck2 FROM smash.gamelog l, smash.gamelog k WHERE l.l_game_id = k.l_game_id AND l.l_user_id = k.l_user_id AND l.l_deck_id < k.l_deck_id AND l.l_game_id =".$gameID;

if ($_SESSION['username'])
	{
	$query = $db->query($sql);
	foreach($query as $item){
	echo "
	<form action='updateGame.php' method='POST' id='myForm2'>
	<table>
		<tr><td>GameID:</td><td><input type='text' name='gameid' value='".($item['game_id']."' readonly></td></tr></br>
		<tr><td>Game Date:</td><td><input type='text' name='date' value='".$item['game_date']."' readonly></td></tr></br>
		<tr><td>Notes:</td><td><input type='text' name='notes' value='".$item['game_notes']."'></td></tr></br>
    <tr><td>Winner:</td><td><select name='winner' form='myForm2' >
    <option ");
    if (is_null($item['winner_user']))
    {
      echo "selected='selected' ";
    }
    echo "disabled='disabled' >Select Winner</option>";
    $queryopen = $db->query($sql2);
    foreach($queryopen as $thing){
      echo "<option ";
      if ($item['winner_user'] == $thing['user_id'])
      {
        echo "selected='selected' ";
      }
       echo "value=".$thing['user_id'].">".$thing['display_name']."</option>";
    }
   }
    echo "</select></td></tr></br>
		<tr><td><input type='submit' name='update' value='Submit'></td>
		<td><input type='button' value='Back' onClick='history.go(-1);return true;'></td>";
  if ($_SESSION['usergroup']=="Admin")
  {
    echo "<td><input type='submit' name='delete' value='Delete'></td>";
  }
	echo "</tr></table></form>";
  echo "<br><table><tr><td><u>Player </u></td><td><u>Deck 1 </u></td><td><u>Deck 2 </u></td></tr>";
  $query3 = $db->query($sql3);
  foreach($query3 as $stuff){
    $sql4 = "SELECT * FROM smash.users u where u.users_id=".$stuff['user'];
    $query4 = $db->query($sql4);
    $res = $query4->fetch();
    $user = $res['display_name'];
    $sql1 = "SELECT * FROM smash.deck d where d.deck_id=".$stuff['deck1'];
    $query1 = $db->query($sql1);
    $res1 = $query1->fetch();
    $deck1 = $res1['faction_name'];
    $sql5 = "SELECT * FROM smash.deck d where d.deck_id=".$stuff['deck2'];
    $query5 = $db->query($sql5);
    $res5 = $query5->fetch();
    $deck2 = $res5['faction_name'];
    // echo $stuff['user'];
    // $user = nameUser($stuff['user']);
    // echo $user;
    // // $deck1 = nameDeck($stuff['deck1']);
    // // $deck2 = nameDeck($stuff['deck2']);
    // // echo $deck1;
    echo "<tr><td>".($user."</td><td>".$deck1."</td><td>".$deck2."</td></tr>");
  }

  echo "</table></html>";

	}

else
	{
	die("You must login");
	}
?>
