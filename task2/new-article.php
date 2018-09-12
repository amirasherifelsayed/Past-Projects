<?php
session_start();
require_once 'phpthumb/ThumbLib.inc.php';

if (!isset($_SESSION['name']))
	{
	echo "Access Denied";
	exit;
	}
  else
	{
	echo $_SESSION['name'] . " 's session.";
	}

if (isset($_POST['submit']))
	{
	$title = $_POST['title'];
	$body = $_POST['body'];
	$category = $_POST['category'];
	$imgname = basename($_FILES['image']['name']);
	$imgpath = "img/" . $imgname;
	$user_id = $_SESSION['user_id'];
	$date = date('Y-m-d G:i:s');
	if ($title && $body && $category && $imgname && $imgpath)
		{
		$conn = new mysqli("localhost", "root", "", "blog");
		if ($conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$sql = " INSERT INTO posts (user_id, title, body, category, posted, image)  
      VALUES ('$user_id' , '$title' , '$body' , '$category' , '$date' , '$imgpath')";
		if ($conn->query($sql) === TRUE)
			{
                move_uploaded_file($_FILES["image"]["tmp_name"], $imgpath);
               $thumb = PhpThumbFactory::create($imgpath);
               $thumb->adaptiveResize(300, 300);
               $newImagePath = "img/IMG_".$imgname;    
               $thumb->save($newImagePath, 'png');
			//print_r('<br/><span style="color:#32CD32;">New article added successfully.</span>');
			header("Refresh:1; url= users.php");
			}
		  else
			{
			echo "Error: " . $sql . "<br />" . $conn->error;
			}

		$conn->close();
        

		}
	  else
		{
		print_r('<br/><span style="color:red;">Some data items are missing, Try again.</span>');
		}
	}

?>
<!DOCTYPE html>
<html>
   <body>
      <br />
      <h2>Add Article Form</h2>
      <form method="post" name="Form" enctype="multipart/form-data" action="<?php
echo $_SERVER['PHP_SELF'] ?>">
         Title:<br />
         <input type="text" id="title" name="title">
         <br /><br />
         Article Image:<br />
         <input type="file" id ="image" name="image">
         <br /><br />
         Body:<br />
         <textarea name="body" cols=50 rows="10"></textarea>
         <br /><br />
         Category:<br />
         <input type="text" id="category" name="category">
         <br /><br />
                 <h5 style="color:red">** Please attempt to fill all feilds.</h5>
         <input type="submit" value="submit" name="submit">
         <input type="reset">
         <br /><br />
               <a href='logout.php'> Logout here. </a>
      </form>
   </body>
</html>