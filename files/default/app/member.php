<?php

session_start();

if ($_SESSION['username'])
	{
	echo "Welcome, ".$_SESSION['username']."<br><a href='logout.php'>Logout?</a>";
	echo "<br><a href='video.html'>Video</a>";
	}
else
	die("You must login");
?>