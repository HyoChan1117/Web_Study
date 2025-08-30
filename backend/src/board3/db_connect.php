<?php

    // 데이터베이스 연결을 위한 변수 저장
    $hostname = 'db';
    $username = 'root';
    $password = 'root';
    $database = 'board1';

    // 데이터베이스 연결
    $db_conn = new mysqli($hostname, $username, $password, $database);
    
?>