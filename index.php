<?php
session_start ();
function userLogin() {
    echo '
    <div id="userLogin" style="text-align: center;">
    <form action="index.php" method="post">
        <p>Enter your name:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="next" value="Enter" style="border-radius: 5px;"/>
    </form>
    </div>
    ';
}
 
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $fp = fopen ( "history.html", 'a' );
        fwrite ( $fp, "<div class='msg'><i>" . $_SESSION ['name'] . " joined the chat.</i><br></div>" );
        fclose ( $fp );
    } else {
        echo '<span class="error">Type something</span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
    
    $fp = fopen ( "history.html", 'a' );
    fwrite ( $fp, "<div class='msg'><i>" . $_SESSION ['name'] . " left the chat.</i><br></div>" );
    fclose ( $fp );
    
    session_destroy ();
    header ( "Location: index.php" ); 
}
 
?>
<!DOCTYPE html>
<html>
<head>
<title>HeyTalk</title>
<link href="img/chat.png" rel="icon">
<link href="img/chat.png" rel="apple-touch-icon">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php
    if (! isset ( $_SESSION ['name'] )) {
        userLogin ();
    } else {
        ?>
<div id="container">
        <div id="menu">
            <p class="welcome">
                Hi, <b><?php echo $_SESSION['name']; ?></b>
            </p>
            <p class="logout">
                <a id="exit" href="#">LogOut</a>
            </p>
            <div style="clear: both"></div>
        </div>
        <div id="chatspace">
            <?php
        if (file_exists ("history.html") && filesize ("history.html") > 0) {
            $handle = fopen ( "history.html", "r" );
            $contents = fread ( $handle, filesize ("history.html") );
            fclose ( $handle );
            
            echo $contents;
        }
        ?></div>
 
        <form name="message" action="">
            <input name="chat" type="text" id="chat" size="63"> 
            <input name="submitmsg" type="submit" id="submitmsg" value="Send">
        </form>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src="js/load.js"></script>
<?php
    }
?>
</body>
</html>