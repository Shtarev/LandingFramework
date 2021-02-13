<?php
session_start();
include('config/config.php');
$pass = new Pass($passw);
if(isset($_POST['ausgang'])){
    $pass->aus();
    $pass->pruf($pass_view);
}
else {
    $pass->pruf($pass_view);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- Ссылки для эдитора в админке -->
<link href="<?=$contentedit?>css/fontAwesome.css" rel="stylesheet">
<link href="<?=$contentedit?>css/style.css" rel="stylesheet">
<link href="<?=$admindir?>css/style.css" rel="stylesheet">
<script src="<?=$contentedit?>js/jquery.js"></script>
<title>MiniFramework for Landing</title>
</head>

<body>
<form method="post" action="">  
  <input type="hidden" name="ausgang">  
  <input type="submit" class="btn btn-danger" value="Ausgang" onClick="window.close();"> 
</form>
<br>
<!-- Статичное фото, всегда с одним именем например здесь foto_name это имя фото без расширения id должно быть  как имя -->
<img id="foto_name" class="pointer" src="/images/<?= fileSuch('images', 'foto_name'); ?>" alt="..." onClick="fotoChoice(this)" title="Кликни, чтоб заменить фото">
<img id="foto_name2" class="pointer" src="/images/<?= fileSuch('images', 'foto_name2'); ?>" alt="..." onClick="fotoChoice(this)" title="Кликни, чтоб заменить фото">
<hr>
<!--Блоки с текстом-->
<h3><input type="text" id="title_sample" name="title_sample" class="adminInput" style="width: 100%" value="<?= $title_sample ?>"></h3>
<div id="sample" onClick="editor(this)" contenteditable="true"><?= $sample ?></div>
<hr>
<h3>Block 1</h3>
<div id="block_1" onClick="editor(this)" contenteditable="true"><?= $block_1 ?></div>
<hr>
<h3>Block 2</h3>
<div id="block_2" onClick="editor(this)" contenteditable="true"><?= $block_2 ?></div>
<hr>
<h3>Block 3</h3>
<div id="block_3" onClick="editor(this)" contenteditable="true"><?= $block_3 ?></div>
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
    <form action="'.$admindir.'src/fotorobot.php" method="post">
        <input type="hidden" name="" value="'.$img[$key][0].'">
        <input type="button" value="Löschen" onClick="flag=false; fotoLoschen(this);">
    </form>
</div>
';
}
?>
<!--Добавить фото-->
<h3>Добавить Фото</h3>
<form action="<?=$admindir?>src/fotorobot.php" method="post" enctype="multipart/form-data">
	<input type="text" id="beschreibung" name="beschreibung" value="" placeholder="Beschreibung"><br><br>
	<input type="file" id = "foto" name="foto"><br><br>
	<input type="submit" value="Wahlen">
</form>
<!-- Ссылки для админки и эдитора в админке -->
<?= $jsRoot ?>
<script src="<?=$contentedit?>js/script.js"></script>
<script src="<?=$admindir?>js/script.js"></script>
</body>
</html>