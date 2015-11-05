<?php

session_start();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <link rel='stylesheet' type='text/css' href='responsive.css'>
  <link rel='apple-touch-icon' sizes='57x57' href='./apple-icon-57x57.png'>
  <link rel='apple-touch-icon' sizes='60x60' href='./apple-icon-60x60.png'>
  <link rel='apple-touch-icon' sizes='72x72' href='./apple-icon-72x72.png'>
  <link rel='apple-touch-icon' sizes='76x76' href='./apple-icon-76x76.png'>
  <link rel='apple-touch-icon' sizes='114x114' href='./apple-icon-114x114.png'>
  <link rel='apple-touch-icon' sizes='120x120' href='./apple-icon-120x120.png'>
  <link rel='apple-touch-icon' sizes='144x144' href='./apple-icon-144x144.png'>
  <link rel='apple-touch-icon' sizes='152x152' href='./apple-icon-152x152.png'>
  <link rel='apple-touch-icon' sizes='180x180' href='./apple-icon-180x180.png'>
  <link rel='icon' type='image/png' sizes='192x192'  href='./android-icon-192x192.png'>
  <link rel='icon' type='image/png' sizes='32x32' href='./favicon-32x32.png'>
  <link rel='icon' type='image/png' sizes='96x96' href='./favicon-96x96.png'>
  <link rel='icon' type='image/png' sizes='16x16' href='./favicon-16x16.png'>
  <meta name='apple-mobile-web-app-title' content='Leonine'>
  <link rel='manifest' href='./manifest.json'>
  <meta name='msapplication-TileColor' content='#ffffff'>
  <meta name='msapplication-TileImage' content='./ms-icon-144x144.png'>
  <meta name='theme-color' content='#ffffff'>

</head>
</html>";

if ($_SESSION['username'])
        {
        if ($_SESSION['usergroup']=="Admin")
                {
                echo "<br><button class='compact' onclick=location.href='bet/betting.php'>Betting Game</button>";
                echo "<br><button class='compact' onclick=location.href='bet/betting.php'>TV</button>";
                echo "<br><button class='compact' onclick=location.href='videogame/videogame.php'>Video Games</button>";
                echo "<br><button class='compact' onclick=location.href='bet/betting.php'>Movies</button>";
                echo "<br><button class='compact' onclick=location.href='smash/smash.php'>Smash Up</button></td>";
                // echo "<br><table style='border-spacing: 0px; padding: 0px; border-collapse:separate;'><tr><td><button class='compact' onclick=location.href='betting.php'>Betting Game</button></td></tr>";
                // echo "<tr><td><button class='compact' onclick=location.href='betting.php'>TV</button></td></tr>";
                // echo "<tr><td><button class='compact' onclick=location.href='videogame.php'>Video Games</button></td></tr>";
                // echo "<tr'><td><button class='compact' onclick=location.href='betting.php'>Movies</button></td></tr>";
        }
        if ($_SESSION['usergroup']=="User")
                echo "<br><button class='compact'  onclick=location.href='bet/betting.php'>Betting Game</button></td>";

        if ($_SESSION['usergroup']=="Smash")
                header("Location: smash/smash.php");

        }
else
        die("You must login");
?>
