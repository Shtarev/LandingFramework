<?php
function __autoload( $className ) {  
    include $_SERVER['DOCUMENT_ROOT'].'/admin/src/Classes/'.$className.'.php';
}
// для ссылок
$Dirweg = new Dirweg();
/* АДМИН */
$passw = 12345;
$contentedit = $Dirweg->browdirurl.'admin/contentedit/'; // браузерный путь до папки с редактором от корня
$admindir = $Dirweg->browdirurl.'admin/'; // браузерный путь до папки admin от корня
$jsRoot = '<script type="text/javascript">var root = \''.$admindir.'\'</script>'.PHP_EOL; //браузерный путь до папки admin от корня для js

/* АДМИН + ОБЩАЯ ЧАСТЬ */
// поиск файлов в директории
function fileSuch($dir, $name) {
    $scandir = scandir($dir.'/');
    foreach($scandir as $value){
        $fileName = pathinfo($value, PATHINFO_FILENAME);
        if($fileName == $name) {
            return $value;
        }
    }
}

/**
* Сканируется директория с файлами контента
* Создаются переменные по имени файла контента и с содержимым файла
* $img заполняется отдельно т.к. нужен массив
*/
$scandir = scandir($Dirweg->serdirroot.'content/');
foreach($scandir as $value){
    $fileName = pathinfo($value, PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME);
    if($fileName['extension'] == 'txt' && $fileName['filename'] != 'img') {
        $block = array();
        $block = file($Dirweg->serdirroot.'content/'.$fileName['basename'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $a = $fileName['filename'];
        $$a = $block[0];    
    }
}

$img = file($Dirweg->serdirroot.'/content/img.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>