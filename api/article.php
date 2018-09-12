<?php
class Article{
 
    private $conn;
    private $table_name = "posts";
    
    public $post_id;
    public $user_id;
    public $title;
    public $body;
    public $category;
    public $image;
    public $posted;
 
    public function __construct($db){
        $this->conn = $db;
    }
    
     
function read(){
 
    $uid = isset($_REQUEST['uid'])? $_REQUEST['uid'] : 0;
    // select all query
    $query = "SELECT post_id, user_id, title, body , category, posted, image FROM posts";
    if ($uid){
        $query .=" WHERE user_id = $uid ";
    }
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    return $stmt;
}
    
}