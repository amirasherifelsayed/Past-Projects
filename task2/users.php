<html>
<?php
session_start();
if (!isset($_SESSION['name'])) {
    echo "Access Denied";
	exit;
} else {
echo $_SESSION['name'] . " 's session.   </br></br>  <a href='logout.php'> Logout here. </a><a href='new-article.php'>Add new article.</a>";
$conn = new mysqli("localhost", "root", "", "blog");
if ($conn->connect_error)
		{
		die("Connection failed: " . $conn->connect_error);
		}

	$rec_count = " SELECT * FROM posts";
	$res = $conn->query($rec_count);
	$per_page = 2;
	$pages = ceil($res->num_rows/ $per_page);
	if (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0){
		$page = $_GET['p'];
    } else {
		$page = 1;
	}
   // die($pages);
    $start = ($page - 1) * $per_page;
    $prev = $page - 1;
    $next = $page + 1;
    
    
    
//	if ($page <= 0)
//		{
//		$start = 0;
//		}
//	  else
//		{
//
//		}

	$res = $conn->query($rec_count);
	$sql = " SELECT post_id, title, LEFT (body, 100) AS body, category, image FROM posts limit $start , $per_page";
	$result = $conn->query($sql);
    
//    echo $sql;
//    print_r($conn);
//    print_r($result);
//    exit;
	while ($row = $result->fetch_assoc())
		{
		if ($row)
			{
?>
   <body>
       <?php
			$lastspace = strrpos($row['body'], ' ');
			$id = $row['post_id'];
			$title = $row['title'];
?>
      <article>
         <h2>
            <?php
			echo $title = $row['title']; ?>
         </h2>
         <img width="100" height="100" src="<?php
			echo $row['image']; ?>"/>
         <p>
            <?php
			echo substr($row['body'], 0, $lastspace) . "<a href='post.php?id=$id'>..</a>" ?>
         </p>
         <h6>
            <?php
			echo $row['category']; ?>
             <br /><br /><br /><br />
         </h6>
      </article>
    
   </body>
   <?php
			}
		  else
			{
			print_r("<br/><br/> You have 0 articles, start adding new articles here.");
			}
		}

	if ($prev > 0)
		{
		echo "<a href='users.php?p=$prev'>Prev</a></br>";
		}
    
    
    if ($page < $pages) {
        echo "<a href='users.php?p=$next'>Next</a>";
    }
//	else if ($page < $pages)
//		{
//		
//        //echo "<a href='users.php?p=$prev'>Prev</a></br>";
//		}
}

?>
</html>