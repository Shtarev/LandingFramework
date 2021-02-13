<?php
session_start();

function __autoload( $className ) {  
    include $_SERVER['DOCUMENT_ROOT'].'/admin/src/Classes/' . $className . '.php';
}
$Dirweg = new Dirweg();

include $Dirweg->serdirroot.'config/config_foto.php';

$uploaddir = "/images/";
$keinfoto = "/images/noimage.jpg";

/** Если мы здесь, то фильтруем причину
* 1) удаление фото галереи
* 2) загрузка нового фото галереи
* 3) замена статических фото
*/

if(isset($_POST['del'])) { // удаление фото
    $del = $_POST['del'];
    $blockDel = file($Dirweg->serdirroot.'content/img.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($blockDel as $key => $value) {
        if($value == $del) {
            unlink($Dirweg->serdirroot.'images/'.$blockDel[$key]);
            unlink($Dirweg->serdirroot.'images/'.$blockDel[$key+1]);
            unset($blockDel[$key+2], $blockDel[$key+1], $blockDel[$key]);
        }
    }
    $str = implode(PHP_EOL, $blockDel);
    file_put_contents($Dirweg->serdirroot.'content/img.txt', $str.PHP_EOL, LOCK_EX);
    header( 'Location: '.$_SERVER['HTTP_REFERER'] );
}
elseif(isset($_FILES['foto'])) { // Другие фото
    $filename =  array_keys($_FILES)[0];
    $shir = $fotoShirGross;
    $vis = $fotoVisGross;
    $copyOrUpload = "copy";
    $imgGross = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
    $shir = $fotoShirKlein;
    $vis = $fotoVisKlein;
    $copyOrUpload = "upload";
    $imgKlein = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
    $beschreibung = $_POST['beschreibung'];
    if($beschreibung == ''){$beschreibung = 'Keine Beschreibung';}
    file_put_contents($Dirweg->serdirroot.'content/img.txt', $imgGross->fotosname.PHP_EOL.$imgKlein->fotosname.PHP_EOL.$beschreibung.PHP_EOL, FILE_APPEND | LOCK_EX);
    header( 'Location: '.$_SERVER['HTTP_REFERER'] );
}
else { // сюда попадаем только если предыдущие отсеяны, то это - Статичное фото
    $filename =  array_keys($_FILES)[0];
    $shir = 0;
    $vis = 0;
    $copyOrUpload = "upload";
    $img = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
}




/*
if(isset($_FILES['ichFile'])) { // Статичное фото
    $filename =  array_keys($_FILES)[0];
    $shir = $fotoShirStat;
    $vis = $fotoVisStat;
    $copyOrUpload = "upload";
    $img = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
}
elseif(isset($_FILES['foto'])) { // Другие фото
    $filename =  array_keys($_FILES)[0];
    $shir = $fotoShirGross;
    $vis = $fotoVisGross;
    $copyOrUpload = "copy";
    $imgGross = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
    $shir = $fotoShirKlein;
    $vis = $fotoVisKlein;
    $copyOrUpload = "upload";
    $imgKlein = new fotorobot($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto);
    $beschreibung = $_POST['beschreibung'];
    if($beschreibung == ''){$beschreibung = 'Keine Beschreibung';}
    file_put_contents($Dirweg->serdirroot.'content/img.txt', $imgGross->fotosname.PHP_EOL.$imgKlein->fotosname.PHP_EOL.$beschreibung.PHP_EOL, FILE_APPEND | LOCK_EX);
    header( 'Location: '.$_SERVER['HTTP_REFERER'] );
}
elseif(isset($_POST['del'])) { // удаление фото
    $del = $_POST['del'];
    $blockDel = file($Dirweg->serdirroot.'content/img.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($blockDel as $key => $value) {
        if($value == $del) {
            unlink($Dirweg->serdirroot.'images/'.$blockDel[$key]);
            unlink($Dirweg->serdirroot.'images/'.$blockDel[$key+1]);
            unset($blockDel[$key+2], $blockDel[$key+1], $blockDel[$key]);
        }
    }
    $str = implode(PHP_EOL, $blockDel);
    file_put_contents($Dirweg->serdirroot.'content/img.txt', $str.PHP_EOL, LOCK_EX);
    header( 'Location: '.$_SERVER['HTTP_REFERER'] );
}
*/