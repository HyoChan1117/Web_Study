<?php

    // 데이터베이스 연결
    include "./db_connect.php";

    // form 입력 값 가져오기
    $name = $_POST['name'];
    $id = $_POST['id'];
    $password = $_POST['password'];

    // sql문 작성
    $query = "INSERT INTO login (name, id, password)
              VALUE ('$name', '$id', '$password'
             )";

    // 쿼리 실행
    if ($db_conn->query($query)) {
        header("Refresh: 1; URL='login.php'");
        echo "회원가입에 성공하셨습니다.";
    } else {
        header("Refresh: 1; URL='join.php'");
        echo "회원가입에 실패하셨습니다. 회원가입 창으로 돌아갑니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>