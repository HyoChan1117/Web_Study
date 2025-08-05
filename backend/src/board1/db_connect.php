<?php

    // 데이터베이스 연결
    $hostname = 'db';
    $username = 'root';
    $password = 'root';
    $database = 'board1';

    $db_conn = new mysqli($hostname, $username, $password, $database);

    // DB 연결 실패
    if ($db_conn->connect_error) {
        echo "DB 연결 실패";
    }
?>