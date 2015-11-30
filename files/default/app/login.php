<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

include 'connectToDB.php';

$sql = "SELECT * FROM phplogin.users WHERE userName = :username";
if ($username&&$password)
{
		$query = $db->prepare($sql);
		$query->execute(array(':username'=>$username));
				    $row_count = $query->rowCount();
					$results = $query->fetch(PDO::FETCH_ASSOC);
					$dbusername = $results['userName'];
					$dbpassword = $results['userPassword'];
					$dbusergroup = $results['userGroup'];
					$dbuserid = $results['userID'];

					if ($row_count>0)
						{
							if($dbusername==$username&&$dbpassword==$password)
							{
							#echo $results['userName'];
							#echo "You're in! Click  <a href='pivot.php'>here</a> to enter.";
							$_SESSION['username']=$dbusername;
							$_SESSION['usergroup']=$dbusergroup;
							$_SESSION['userid']=$dbuserid;
							// echo $dbusername;
							// echo $dbusergroup;
							// echo $dbuserid;
								header("Location: index.php");
								exit;
							}
							else
							{
							die("Username/password is incorrect.");
							}
						}
					else {
							die("User does not exist.");
						 }
} else
	die("Please enter a login");

?>
