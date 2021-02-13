<?php
class fotorobot {
	
public $foto = "";
public $fotosname = "";
	
function __construct($copyOrUpload,$filename,$shir,$vis,$uploaddir,$keinfoto){

if (isset($_FILES[$filename]) & $_FILES[$filename]['error'] == UPLOAD_ERR_OK)
{

$fotoname = $_FILES[$filename]['name'];

if($posi = strrpos($filename, 'File')) {
    $name = substr($filename, 0, $posi);
    $pos = strrpos($fotoname,'.');
    $extension = substr($fotoname,$pos);
    $extension = strtolower($extension);
    
    $scandir = scandir($_SERVER['DOCUMENT_ROOT'].$uploaddir);
    foreach($scandir as $value){
        $alteFoto = pathinfo($value, PATHINFO_FILENAME); 
        if($alteFoto == $name) {
            list($shir, $vis, $type) = getimagesize($_SERVER['DOCUMENT_ROOT'].$uploaddir.$value); // размеры статичного фото($type здесь не используется, позже будет переназначена)
            unlink($_SERVER['DOCUMENT_ROOT'].$uploaddir.$value);
        }
    }
    $fotoname = $name.$extension;
}
else {
    $pos = strrpos($fotoname,'.');
    $extension = substr($fotoname,$pos);
    $extension = strtolower($extension);
    $fotoname = uniqid().$extension;
}

$this->foto = $uploaddir.$fotoname;
$foto = $uploaddir.$fotoname;
$this->fotosname = $fotoname;
if ($copyOrUpload == "upload"){
$upload_result = move_uploaded_file($_FILES[$filename]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$foto);
if($upload_result == true){echo "<font color='#008000'>Фото загружено</font><br>";}else{echo "<font color='#FF0000'>Фото НЕ загружено</font><br>";}
}
if ($copyOrUpload == "copy"){
$upload_result = copy($_FILES[$filename]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$foto);
if($upload_result == true){echo "<font color='#008000'>Фото загружено</font><br>";}else{echo "<font color='#FF0000'>Фото НЕ загружено</font><br>";}
}
$MusterProzent = 100/$shir*$vis;
list($width, $height, $type) = getimagesize($_SERVER['DOCUMENT_ROOT'].$foto);
$VergleichProzent = 100/$width*$height;
if ($MusterProzent <= $VergleichProzent)
{
	$prozent1 = 100/$width*$shir;
	$prozent = 100-$prozent1;
	$x = $width/100*$prozent;
	$widthNEW=$width-$x;
	$y = $height/100*$prozent;
	$heightNEW = $height-$y;
if($type==1){$src=imagecreatefromgif($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==2){$src=imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==3){$src=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==6){$src=imagecreatefromwbmp($_SERVER['DOCUMENT_ROOT'].$foto);}
$dst = imagecreatetruecolor($widthNEW,$heightNEW);
imagecopyresized ($dst, $src, 0, 0, 0, 0, $widthNEW, $heightNEW, $width, $height);
$src = $dst;
$dst = imagecreatetruecolor($shir,$vis);
$unterschied = $heightNEW-$vis;
$unterschied = $unterschied/2;
imagecopy($dst, $src, 0, 0, 0, $unterschied, $widthNEW,$heightNEW);
if($type==1){imagegif($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==2){imagejpeg($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==3){imagepng($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==6){imagewbmp($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}	
imagedestroy($dst);
imagedestroy($src);
}
if ($MusterProzent > $VergleichProzent)
{
	$prozent1 = 100/$height*$vis;
	$prozent = 100-$prozent1;	
	$x = $height/100*$prozent;
	$heightNEW = $height-$x;
	$y = $width/100*$prozent;
	$widthNEW = $width-$y;
if($type==1){$src=imagecreatefromgif($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==2){$src=imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==3){$src=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==6){$src=imagecreatefromwbmp($_SERVER['DOCUMENT_ROOT'].$foto);}
$dst = imagecreatetruecolor($widthNEW,$heightNEW);
imagecopyresized ($dst, $src, 0, 0, 0, 0, $widthNEW, $heightNEW, $width, $height);
$src = $dst;
$dst = imagecreatetruecolor($shir,$vis);
$unterschied = $widthNEW-$shir;
$unterschied = $unterschied/2;
imagecopy($dst, $src, 0, 0, $unterschied, 0, $widthNEW,$heightNEW);
if($type==1){imagegif($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==2){imagejpeg($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==3){imagepng($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}
if($type==6){imagewbmp($dst, $_SERVER['DOCUMENT_ROOT'].$foto);}		
imagedestroy($dst);
imagedestroy($src);
}
if (isset($img) & $img != ""){
unlink($_SERVER['DOCUMENT_ROOT'].$img);
}
}
else
{   
	if ($id == ""){
	$nofoto = $_SERVER['DOCUMENT_ROOT'].$keinfoto;
	$newname = uniqid();
	$uploadfoto = $_SERVER['DOCUMENT_ROOT'].$uploaddir.$newname.".jpg";
	copy($nofoto, $uploadfoto);
	$this->foto = $uploaddir.$newname.".jpg";
    $this->fotosname = $newname.".jpg";
	}
	elseif ($this->foto == ""){
	$nofoto = $_SERVER['DOCUMENT_ROOT'].$keinfoto;
	$newname = uniqid();
	$uploadfoto = $_SERVER['DOCUMENT_ROOT'].$uploaddir.$newname.".jpg";
	copy($nofoto, $uploadfoto);
	$this->foto = $uploaddir.$newname.".jpg";
    $this->fotosname = $newname.".jpg";
	}
}
}
}
?>