<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <link rel='icon' href='https://s3.amazonaws.com/leoninestudios/favicon.ico' type='image/x-icon' />
        <link rel='stylesheet' type='text/css' href='../responsive.css' />
        <title id='pageTitle'>Smash Tracker</title>
<font>";



$sql = "SELECT * FROM smash.game g LEFT JOIN smash.users u ON g.winner_user = u.user_id order by game_id desc";

if ($_SESSION['username'])
        {
                $queryopen = $db->query($sql);

        echo "<br><h3>Games</h3>";
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<table border='2'>";
        echo "<tr><td>Game ID</td><td>Game Date</td><td>Winner</td></tr>";

                foreach($queryopen as $item){
                        echo "<tr><td><a href='gameDetails.php?gameID=".($item['game_id']."'>".$item['game_id']."</a></td><td>".$item['game_date']."</td><td>".$item['display_name']."</td></tr>");
                }
        echo "</table><br><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'>";
        echo "</html>";
        }
else
        die("You must login");

echo"</font></head></html>";
?>
