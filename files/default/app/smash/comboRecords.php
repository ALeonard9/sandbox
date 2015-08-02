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



$sqlComboRecords = "SELECT * FROM smash.comboRecord order by deck1, deck2";
$sqlUnusedDecks = "SELECT * FROM smash.unusedCombos";
$sqlcountUnusedDecks = "SELECT count(*) as count FROM smash.unusedCombos";

if ($_SESSION['username'])
        {
                $queryopen = $db->query($sqlComboRecords);
                $querydecks = $db->query($sqlUnusedDecks);
                $querycountdecks = $db->query($sqlcountUnusedDecks);
                  $resultsCount = $querycountdecks->fetch(PDO::FETCH_ASSOC);
        echo "<br><h3>Combo Records</h3>";
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<table border='2'>";
        echo "<tr><td>Deck 1</td><td>Deck 2</td><td>Wins</td><td>Total Games</td><td>Win Percentage</td></tr>";

                foreach($queryopen as $item){
                        echo "<tr><td>".($item['deck1']."</td><td>".$item['deck2']."</td><td>".$item['wins']."</td><td>".$item['games']."</td><td>".$item['win_percentage']."</td></tr>");
                }
        echo "</table>";
        echo "<br><h3>Unused Combos: ".$resultsCount['count']."</h3>";
        echo "<table border='2'>";
        echo "<tr><td>Deck 1</td><td>Deck 2</td></tr>";

                foreach($querydecks as $item){
                        echo "<tr><td>".($item['deck1']."</td><td>".$item['deck2']."</td></tr>");
                }
        echo "</table><br><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'>";

        echo "</html>";
        #if ($_SESSION['usergroup']=='Admin')

        #if ($_SESSION['usergroup']=='User')
        }
else
        die("You must login");

echo"</font></head></html>";
?>
