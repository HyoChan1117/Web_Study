<?php

    // 세션 시작
    session_start();
    
    require_once('./db_conf.php');

    // 1. 연결 설정
    $db_conn = new mysqli(db_info::DB_URL, db_info::USER_ID, db_info::PASSWD, db_info::DB);

    // 연결 확인
    // if ($db_conn->errno) {
    //     echo 'DB 연결 실패';
    //     header("Location: register_process.php");
    // }

?>