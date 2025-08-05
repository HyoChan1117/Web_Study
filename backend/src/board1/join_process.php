<?php

    // 데이터베이스 연결
    include "./db_connect.php";

    // form 입력 값 가져오기
    $name = $_POST['name'];
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    // sql문 작성
    $query = "INSERT INTO login (name, id, pw)
              VALUE ('$name', '$id', '$pw');";

    // 쿼리 실행
    if ($result = $db_conn->query($query)) {
        header("Refresh: 2; URL='login.php'");
        echo "회원가입에 성공하였습니다.";
    } else {
        echo "잘못된 접근입니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();

?>