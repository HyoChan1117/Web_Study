<?php
    if(isset($_POST['user_name']) && isset($_POST['user_age'])) {
        echo "제 이름은 {$_POST['user_name']}입니다. 나이는 {$_POST['user_age']}입니다.";
    } else {
        echo "잘못된 접근입니다.";
    }
?>