<?php

    // 입력값 유효성 검사
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // 유효하지 않는 값일 경우
    // 유효하지 않는 값입니다. -> 글쓰기 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='insert.php'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    // 세션 시작
    session_start();

    // 세션 변수 저장
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (INSERT)
        $sql = "INSERT INTO board1 (name, account, title, content) VALUES ('$name', '$account', '$title', '$content')";

        // 쿼리 작성
        $result = $db_conn->query($sql);

        // 글쓰기 완료 -> 게시판 목록 페이지 리다이렉션
        header("Refresh: 2; URL='index.php'");
        echo "글쓰기 완료!";
        exit;

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>