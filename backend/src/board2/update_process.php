<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id 값일 경우
    // 잘못된 접근입니다. -> 게시판 목록 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='index.php'");
        echo "잘못된 접근입니다.";
        exit;
    }

    // 입력값 유효성 검사
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // 유효하지 않는 값일 경우
    // 유효하지 않는 값입니다. -> 게시판 목록 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='index.php'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (UPDATE)
        $sql = "UPDATE board SET title='$title', content='$content' WHERE id='$id'";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 수정에 실패했습니다. -> 해당 게시글 페이지로 이동
        if (!$result) {
            header("Refresh: 2; URL='read.php?id=$id'");
            echo "수정에 실패했습니다.";
            exit;
        }

        // 수정 성공! -> 해당 게시글 페이지로 이동
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "수정 성공!";
        exit;
    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>