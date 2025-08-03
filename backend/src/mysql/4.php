<?php

    require_once 'db_conf.php';
    // 1. 연결 설정
    $db_conn = new mysqli(DB_INFO::DB_HOST, DB_INFO::DB_USER, DB_INFO::DB_PASSWORD, DB_INFO::DB_NAME);

    // 연결 결과 확인
    if ($db_conn->errno) {
        echo "연결 실패: " . $db_conn->connect_error;
        exit;
    }

    echo "DBMS 연결 성공, gsc db 선택 완료";


    // 2. SQL 전송
    // 새로운 레코드를 생성
    // 2-1 : SQL문 작성
    $sql = "select * from student";
    $result = $db_conn->query($sql);
    
    // mysqli_result => fetch_field(), fetch_fields()
    $field_info = $result->fetch_fields();

    // 4. 연결 종료
    $db_conn->close();

?>