<?php

session_start();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='stylesheet' type='text/css' href='mystyle.css' />
        <title id='pageTitle'>LeoNine Studios</title>
</head>
</html>";


if ($_SESSION['username'])
        {
        if ($_SESSION['usergroup']=="Admin")
                {
                echo "<br><table><tr><td><button  onclick=location.href='betting.php'>Betting Game</button></td>";
                echo "<td><button style='background-color:#FFFFFF;color:#20416c;height:180px;width:450px;font-size:50pt;' onclick=location.href='betting.php'>TV</button></td></tr>";
                echo "<tr><td><button style='background-color:#FFFFFF;color:#20416c;height:180px;width:450px;font-size:50pt;' onclick=location.href='videogame.php'>Video Games</button></td>";
                echo "<td><button style='background-color:#FFFFFF;color:#20416c;height:180px;width:450px;font-size:50pt;' onclick=location.href='betting.php'>Movies</button></td></tr>";
        }
        if ($_SESSION['usergroup']=="User")
                echo "<br><table><tr><td><button  onclick=location.href='betting.php'>Betting Game</button></td>";
        }
else
        die("You must login");
?>
 