<?php

session_start();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='icon' href='https://s3.amazonaws.com/leoninestudios/favicon.ico' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title>
</head>
</html>";


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
echo"</font></head></html>";
?>
