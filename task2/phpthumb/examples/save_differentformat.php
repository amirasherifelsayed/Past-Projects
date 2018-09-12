<?php

require_once '../ThumbLib.inc.php';

$thumb = PhpThumbFactory::create('test.jpg');
$thumb->adaptiveResize(300, 300);
$thumb->save('test.png', 'png');

?>
