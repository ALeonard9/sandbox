<?php

session_start();

session_destroy();

echo "You have been logged out. Click <a href='index.php'>here</a> to return.";

?>