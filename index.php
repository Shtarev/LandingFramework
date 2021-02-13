<?php include('config/config.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">
<script src="/js/jquery-3.4.1.js"></script>
<title>MiniFramework for Landing</title>
</head>

<body>
<a href="/admin.php">Admin</a>
<br>
<!-- Статичное фото, всегда с одним именем например здесь foto_name это имя фото без расширения -->
<img src="/images/<?= fileSuch('images', 'foto_name'); ?>" alt="...">
<img src="/images/<?= fileSuch('images', 'foto_name2'); ?>" alt="...">
<hr>
<!--Блоки с текстом-->
<h3><?= $title_sample ?></h3>
<div><?= $sample ?></div>
<hr>
<h3>Block 1</h3>
<div><?= $block_1 ?></div>
<hr>
<h3>Block 2</h3>
<div><?= $block_2 ?></div>
<hr>
<h3>Block 3</h3>
<div><?= $block_3 ?></div>
<hr>
<!--Вывод фото-->
<h3>Foto</h3>
<?php
$img = array_chunk($img, 3);
foreach($img as $key=>$value){
echo
'
<div>
    <a href="/images/'.$img[$key][0].'" target="_blank"><img src="/images/'.$img[$key][1].'" alt=""></a><p>'.$img[$key][2].'</p>
    <br>
</div>
';
}
?>
<script src="/js/script.js"></script>
</body>
</html>