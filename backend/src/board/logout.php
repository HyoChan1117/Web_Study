<?php

    session_start();    // 세션 시작
    session_unset();    // 세션 변수 해제
    session_destroy();  // 세션 종료
    header("Location: login.php");
    exit();
?>