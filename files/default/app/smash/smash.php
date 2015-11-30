<?php

session_start();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head><body><div class='container'>";
include('../navigation.php');

if ($_SESSION['username'])
        {
        if ($_SESSION['usergroup']=="Admin")
                {
                echo "<br><button class='compact' onclick=location.href='userRecords.php'>View Users</button>";
                echo "<br><button class='compact' onclick=location.href='factionRecords.php'>View Factions</button>";
                echo "<br><button class='compact' onclick=location.href='comboRecords.php'>View Combos</button>";
                echo "<br><button class='compact' onclick=location.href='gameRecords.php'>View Games</button>";
                echo "<br><button class='compact' onclick=location.href='newGame.php'>Add new game</button>";
        }
        if ($_SESSION['usergroup']=="Smash")
               {
                echo "<br><button class='compact' onclick=location.href='userRecords.php'>View Users</button>";
                echo "<br><button class='compact' onclick=location.href='factionRecords.php'>View Factions</button>";
                echo "<br><button class='compact' onclick=location.href='comboRecords.php'>View Combos</button>";
                echo "<br><button class='compact' onclick=location.href='gameRecords.php'>View Games</button>";
                echo "<br><button class='compact' onclick=location.href='newGame.php'>Add new game</button>";
              }
        }
else
        die("You must login");

include('../footer.php');
echo "</div></body></html>";
?>
