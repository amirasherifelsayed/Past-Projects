<html>
<body>
    
    <?php
$uname = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

if ($uname && $email && $pass)
	{
	$conn = new mysqli("localhost", "root", "", "blog");
	if ($conn->connect_error)
		{
		die("Connection failed: " . $conn->connect_error);
		}

	$sql = " INSERT INTO users (username, email, password)  
VALUES ('$uname' , '$email' , '$pass')";
	if ($conn->query($sql) === TRUE)
		{
		echo "New record created successfully"; ?>
    <br />
     <a href="login-form.php">Login here.</a>
    
    <?php
		}
	  else
		{
		echo "Error: " . $sql . "<br />" . $conn->error;
		}

	$conn->close();
	}
  else
	{
	echo "Failed to connect to Database";
	}

?>

    
    </body>
</html>
