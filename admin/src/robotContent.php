<?php
/* Замена текстового контента асинхронно */

function __autoload( $className ) {  
    include $_SERVER['DOCUMENT_ROOT'].'/admin/src/Classes/' . $className . '.php';
}
$Dirweg = new Dirweg();

$id = $_POST['id'];
$file = $Dirweg->serdirroot.'content/'.$id.'.txt';
$value = $_POST['value'];
$result = file_put_contents($file, $value, LOCK_EX);