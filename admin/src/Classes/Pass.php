<?php 
class Pass {
    private $pass;
    private $text1 = 'Passwort eingeben';
    private $text2 = 'Kein gültiges Passwort<br>Passwort eingeben';
    private $text3 = 'Senden';
    function __construct($pass){
        //session_start();
        $this->pass = $pass;
    }
    protected function url() {
        return $_SERVER['DOCUMENT_ROOT'];
    }
    public function pruf($url) {
        $out = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/admin/src/auth/pass_form.php');
        if(!isset($_POST['pass'])){
            if(!isset($_SESSION['pass'])){
                $text = $this->text1;
                $out = str_replace ("{FRAZA}", $text, $out);
                $out = str_replace ("{KNOPKA}", $this->text3, $out);
                die($out);
            }
            else {
                if($_SESSION['pass'] != $this->pass){
                    $text = $this->text2;
                    $out = str_replace ("{FRAZA}", $text, $out);
                    $out = str_replace ("{KNOPKA}", $this->text3, $out);
                    die($out);
                }
            }
        }
        else {
            $_SESSION['pass'] = $_POST['pass'];
        }
        if($_SESSION['pass'] != $this->pass){
            $text = $this->text2;
            $out = str_replace ("{FRAZA}", $text, $out);
            $out = str_replace ("{KNOPKA}", $this->text3, $out);
            die($out);
        }
    }
    public function aus() {
        unset($_SESSION['pass']);
        session_destroy();
    }
}
?>