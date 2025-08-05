<?php

    // 데이터베이스 연결
    include "./db_connect.php";

    // 세션 시작
    session_start();

    // form 입력 값 불러오기
    $name = $_SESSION['name'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // sql문 작성
    $query = "INSERT INTO list (name, subject, content)
              VALUE ('$name', '$subject', '$content')
              ";

    // 쿼리 실행
    if ($db_conn->query($query)) {
        header("Location: list.php");
        exit();
    } else {
        header("Refresh: 2; URL='list.php'");
        echo "글쓰기에 실패하셨습니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>