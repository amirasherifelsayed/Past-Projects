
<?php
session_start();

if ($_POST)
	{
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['password'] = $_POST['password'];
	if ($_SESSION['name'] && $_SESSION['password'])
		{
		$conn = new mysqli("localhost", "root", "", "blog");
		if ($conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$sql = " SELECT * FROM users WHERE username ='" . $_SESSION['name'] . "' ";
		$res = $conn->query($sql)->fetch_assoc();

		//    echo '<pre>';
		//    print_r($_SESSION);

		if ($res)
			{

			//  print_r($res);
			//  exit;

			$dbname = $res['username'];
			$dbpassword = $res['password'];
			$userid = $res['user_id'];
			if ($_SESSION['name'] == $dbname)
				{

				// print_r($res);

				if ($_SESSION['password'] == $dbpassword)
					{
					$_SESSION['user_id'] = $userid;
					header("location: users.php");
					}
				  else
					{
					print ("Your password is incorrect");
					}
				}
			  else
				{
				print ("Username doesn't exist");
				}

			//          print_r($_SESSION);
			//         exit;
			// echo '<pre>';
			//  print_r(($res->fetch_object()));
			// print_r(($res->fetch_assoc()));

			}

		$conn->close();
		}
	  else
		{
		echo "Missing Username or Password, Failed to connect to Database";
		}
	}
  else
	{
	echo "Coudln't";
	}

?>