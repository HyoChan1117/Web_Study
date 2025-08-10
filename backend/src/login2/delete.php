<?php

    // try
    try {
        // 데이터베이스 연결을 위한 변수값 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // 계정 정보 비교 알고리즘 불러오기
        require_once "./check_account.php";

        // sql문 작성 (DELETE)
        $sql_del = "DELETE FROM board WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql_del);

        header("Refresh: 2; URL='index.php'");
        echo "삭제 성공!";
    }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 해당 게시글 페이지 리다이렉션
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>