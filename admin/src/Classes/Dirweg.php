<?php
class Dirweg 
{  
    public $browdirurl; // браузерный путь к директории
    public $serdirurl; // серверный путь к директории
    public $browdirroot; // браузерный путь к корню
    public $serdirroot; // серверный путь к корню
    public $file; // название файла из которого сраболал скрипт

    public function __construct(){
        $pieces = explode('/', $_SERVER['PHP_SELF']);    
        $this->file = array_pop($pieces);

        $url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];  
        $this->browdirurl =  "http://".mb_strstr($url, $this->file, true);
        
        $this->browdirroot =  "http://".$_SERVER['SERVER_NAME'].'/';

        $url = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];  
        $this->serdirurl =  mb_strstr($url, $this->file, true);
        
        $this->serdirroot = $_SERVER['DOCUMENT_ROOT'].'/';  
	  }
}