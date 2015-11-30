<?php

session_start();

include '../connectToDB.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head><body><div class='container'>";
include('../navigation.php');



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

include('../footer.php');
echo "</div></body></html>";
?>
