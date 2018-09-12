<html>
<?php
session_start();

if (!isset($_SESSION['name']))
	{
	echo "Access Denied";
	exit;
	}
  else
	{
	echo $_SESSION['name'] . " 's session.   </br></br>  <a href='logout.php'> Logout here.</a>";
	}

if (!isset($_GET['id']))
	{
	header('Location: users.php');
	exit();
	}
  else
	{
	$id = $_GET['id'];
	}

$conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_error)
	{
	die("Connection failed: " . $conn->connect_error);
	}

$sql = " SELECT title, body, category, image FROM posts WHERE post_id ='$id'";
$result = $conn->query($sql);
$res = $result->num_rows;

if ($res != 1)
	{
	header('Location: users.php');
	exit();
	}

$sqli = " SELECT * FROM comments WHERE post_id ='$id'";
$rests = $conn->query($sqli);

//    echo '<pre>';
//    print_r($_SESSION);

while ($row = $result->fetch_assoc())
	{
	if ($row)
		{
?>
   <body>
      <article>
         <h2>
            <?php
		echo $title = $row['title']; ?>
         </h2>
         <img width="100" height="100" src="<?php
		echo $row['image']; ?>"/>
         <p>
            <?php
		echo $body = $row['body']; ?>
         </p>
         <h6>
            <?php
		echo $row['category']; ?>
             <br /><br /><br /><br />
         </h6>
      </article>
       <?php
		while ($restx = $rests->fetch_assoc())
			{
			if ($restx)
				{
        ?>
        <h6>
            <?php
				echo $restx['name']; ?>
         </h6>
         <p>
            <?php
				echo $restx['comment']; ?>
         </p>
        <?php
				}
			}

         ?>
       <br /><br />
       -----------------------------------------------------------------
      <h3>Comments </h3>
      <form method="post" name="Form" action="#">
     <textarea name="comment" cols=50 rows="5"></textarea>
         <br /><br />
         <input type="submit" value="Comment" name="submit">
         <input type="reset">
          <br /><br />
      </form>
       


     <?php
		}
	}

if (isset($_POST['submit']))
	{
	$comment = $_POST['comment'];
	$postid = $id;
	$name = $_SESSION['name'];
	if ($comment && $postid && $name)
		{
		$conn = new mysqli("localhost", "root", "", "blog");
		if ($conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$sql = " INSERT INTO comments (post_id, name, comment)  
      VALUES ('$postid' , '$name' , '$comment')";
		if ($conn->query($sql) === TRUE)
			{
			print_r('<br/><span style="color:#32CD32;">New comment added successfully.</span>');
			header("Refresh:1;");
			}
		  else
			{
			echo "Error: " . $sql . "<br />" . $conn->error;
			}

		$conn->close();
		}
	}

?>
          </body>
</html>