<?php

    if (isset($_POST['username']) && isset($_POST['latte']) && isset($_POST['americano'])) {
        $username = $_POST['username'];
        $latte = $_POST['latte'];
        $americano = $_POST['americano'];

        setcookie('username', $username, time() + 3600, "/");
        setcookie('latte', $latte, time() + 3600, "/");
        setcookie('americano', $americano, time() + 3600, "/");
    
        header("Location: index.php");
    }

?>