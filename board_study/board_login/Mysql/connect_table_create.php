<?php
    // MySQL에 연결하기 위한 변수 선언
    $servername = "localhost";
    $username = "hyochan";
    $password = "40957976";
    $database = "test";

    // MySQL 연결하기
    $conn = mysqli_connect($servername, $username, $password, $database);

    // 연결 체크하기
    if ($conn) {
        echo "MySQL 연결 성공";
    }
    else {
        die("연결 오류 : ". mysqli_connect_error());
    }

    // friend 테이블 생성
    $sql = "create table friend (
            num int not null auto_increment,
            name char(10) not null,
            tel char(15) not null,
            adress char(80),
            primary key(num))";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "friend 테이블 생성 완료!";
    }
    else {
        echo "테이블 생성 오류 : ". mysqli_error($conn);
    }

    mysqli_close($conn);
?>