<?php
include '../../connectToDB.php';

function nameDeck($deck_id)
  {
    $sql = "SELECT * FROM smash.deck d where d.deck_id=".$deck_id;
    $query = $db->query($sql);
    $res = $query->fetch();
    $faction_name = $res['faction_name'];
    return $faction_name;
  }
function nameUser($user_id)
  {
    $sql = "SELECT * FROM smash.users u where u.users_id=".$user_id;
    $query = $db->query($sql);
    $res = $query->fetch();
    $display_name = $res['display_name'];
    return $display_name;
  }
?>
