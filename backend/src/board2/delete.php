<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 값일 경우
    // 유효하지 않는 값입니다. -> 해당 게시물 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (DELETE)
        $sql = "DELETE FROM board WHERE id=$id";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 예외 처리
        // 해당하는 게시물이 없을 경우
        // 해당하는 게시물이 없습니다. -> 게시판 목록 페이지 리다이렉션
        if (!$result) {
            header("Refresh: 2; URL='index.php'");
            echo "해당하는 게시물이 없습니다.";
            exit;
        }
        
        // 해당하는 게시물이 있을 경우
        // 삭제 완료! -> 게시판 목록 페이지 리다이렉션
        header("Refresh: 2; URL='index.php'");
        echo "게시물 삭제 완료!";
        exit;

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>