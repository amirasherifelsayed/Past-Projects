<?php
session_start();

if ($_POST)
	{
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['password'] = $_POST['password'];
	if ($_SESSION['name'] && $_SESSION['password'])
		{
		$conn = new mysqli("localhost", "root", "", "task");
		if ($conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$sql = " SELECT * FROM users WHERE username ='" . $_SESSION['name'] . "' ";
		$res = $conn->query($sql)->fetch_assoc();
		if ($res)
			{

			//  print_r($res);
			//  exit;

			$dbname = $res['username'];
			$dbpassword = $res['password'];
			if ($_SESSION['name'] == $dbname)
				{
				if ($_SESSION['password'] == $dbpassword)
					{
					header("location: users.php");
					}
				  else
					{
					echo "Your password is incorrect";
					}
				}
			  else
				{
				echo "Username doesn't exist";
				}
			}

		$conn->close();
		}
	  else
		{
		echo "Missing Username or Password, Failed to connect to Database";
		}
	}

?>