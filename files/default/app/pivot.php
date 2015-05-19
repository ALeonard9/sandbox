<?php

session_start();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='stylesheet' type='text/css' href='responsive.css' />
        <title id='pageTitle'>LeoNine Studios</title>
</head>
</html>";


if ($_SESSION['username'])
        {
        if ($_SESSION['usergroup']=="Admin")
                {
                echo "<br><button class='compact' onclick=location.href='betting.php'>Betting Game</button>";
                echo "<br><button class='compact' onclick=location.href='bet/betting.php'>TV</button>";
                echo "<br><button class='compact' onclick=location.href='videogame/videogame.php'>Video Games</button>";
                echo "<br><button class='compact' onclick=location.href='betting.php'>Movies</button>";
                // echo "<br><table style='border-spacing: 0px; padding: 0px; border-collapse:separate;'><tr><td><button class='compact' onclick=location.href='betting.php'>Betting Game</button></td></tr>";
                // echo "<tr><td><button class='compact' onclick=location.href='betting.php'>TV</button></td></tr>";
                // echo "<tr><td><button class='compact' onclick=location.href='videogame.php'>Video Games</button></td></tr>";
                // echo "<tr'><td><button class='compact' onclick=location.href='betting.php'>Movies</button></td></tr>";
        }
        if ($_SESSION['usergroup']=="User")
                echo "<br><table><tr><td><button  onclick=location.href='betting.php'>Betting Game</button></td>";
        }
else
        die("You must login");
?>
 