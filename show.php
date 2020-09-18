<?php
date_default_timezone_set('Asia/Calcutta');
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $fp = fopen("history.html", 'a');
    fwrite($fp, "<div class='msg'>(".date("h:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>