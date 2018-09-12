<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
 
include_once 'config.php';
include_once 'article.php';

$database = new Database();
$db = $database->getConnection();
 
$article = new Article($db);
 
$stmt = $article->read();
$num = $stmt->rowCount();
 

if($num>0){

    $products_arr=array();
    $products_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
 
        $product_item=array(
            "post_id" => $post_id,
            "user_id" => $user_id,
            "title" => $title,
            "body" => $body,
            "category" => $category,
            "posted" => $posted,
            "image" => $image
            
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No articles found.")
    );
}


?>