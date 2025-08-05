<?php

    // 데이터베이스 연결
    $hostname = 'db';
    $username = 'root';
    $password = 'root';
    $database = 'login';

    $db_conn = new mysqli($hostname, $username, $password, $database);

    // 연결 실패 시
    if ($db_conn->connect_error) {
        echo "DB 연결 실패";
    }

    echo "DB 연결 성공";

?>