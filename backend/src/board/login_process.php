<?php

    // 데이터베이스 연결
    include "./db_connect.php";

    // 세션 시작
    session_start();

    // form 입력 값 가져오기
    $id = $_POST['id'];
    $password = $_POST['password'];

    // sql문 작성
    $query = "SELECT name, password FROM login WHERE id='$id'";
    
    // 쿼리 실행
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();

    if ($row > 0) {
        if ($password != $row['password']) {
            header("Refresh: 2; URL='login.php'");
            echo "비밀번호가 틀렸습니다.";
        } else {
            $_SESSION['name'] = $row['name'];
            header("Location: list.php");
        }
    } else {
        header("Refresh: 2; URL='login.php'");
        echo "존재하지 않는 계정입니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>