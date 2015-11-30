<?php

session_start();

include '../connectToDB.php';

echo "<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
<head>
        <title id='pageTitle'>Smash Tracker</title>";
include('../header.php');
echo "</head><body><div class='container'>";
include('../navigation.php');

if ($_SESSION['username'])
	{
	echo"<script type='text/javascript'>
          function checkNumPlayers(selectedType){
            document.getElementById('u1').style.display = 'none';
            document.getElementById('u2').style.display = 'none';
            document.getElementById('u3').style.display = 'none';
            document.getElementById('u4').style.display = 'none';
            for (i = 1; i <= selectedType; i++) {
              document.getElementById('u'+ i).style.display = 'block';
            }
          }
  </script>
	<form action='newGamePlayers.php' form='thisForm' method='POST'>
    <table>
		  <tr>
        <td><font>How many players? (2-4): </font></td>
        <td><input type='number' name='num_players' min='2' max='4' oninput='checkNumPlayers(this.value)'/></td>
        </tr>";

    $x = 1;
    $y = 4;
    while($x <= $y) {
        echo "
        <tr id='u".$x."' style='display:none'><td><font>User ".$x.":</font></td><td><select form='thisForm' name='nuser".$x."'>
        <option disabled='disabled' selected='selected'>Select Player</option>";
        $sql = "select * from smash.users order by display_name";
        $queryopen = $db->query($sql);
        foreach($queryopen as $item){
                echo "<option
                value=".($item['user_id'].">".$item['display_name']."</option>");
        };
        echo "</select></td></tr>";
        $x++;
    }

	echo"<tr><td><input type='submit' value='Submit'/></td>
		<td><input type='button' value='Back' onClick='history.go(-1);return true;' /></td></tr>
	</table></form></body></html>";

	}
else
	{
	die("You must login");
	}
include('../footer.php');
echo "</div></body></html>";
?>
