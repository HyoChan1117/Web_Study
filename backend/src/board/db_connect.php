<?php

    // 데이터베이스 연결을 위한 변수 선언
    $servername = 'db';
    $username = 'root';
    $password = 'root';
    $database = 'board';

    // 데이터베이스 연결
    $db_conn = new mysqli($servername, $username, $password, $database);

    // 연결 실패 시
    if ($db_conn->connect_error) {
        echo "DB 연결 실패";
        exit;
    }
?>