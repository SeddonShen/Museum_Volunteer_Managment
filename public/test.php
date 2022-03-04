<?php
$data = json_decode(file_get_contents('php://input'), true);
header('Content-Type:application/json; charset=utf-8');
exit(json_encode($data)); 
// foreach ($data['url'] as $value) {
//         echo $value;
// }
// $urlarr = array('https://cdn.qxxpz.top/test/2.mp3','http://cdn.qxxpz.top/test/3.mp3');
// //unset($urlarr[0]);
// //echo 
// $firsturl=str_replace("https://cdn.qxxpz.top/","",$urlarr[0]);