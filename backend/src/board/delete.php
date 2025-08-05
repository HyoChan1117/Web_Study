<?php

    // 데이터베이스 연결 및 세션 시작
    include "./db_connect.php";

    // id 값 가져오기
    $id = $_GET['id'];

    // sql문 작성
    $query = "DELETE FROM list WHERE no='$id'";

    // 쿼리 실행
    if ($result = $db_conn->query($query)) {
        header("Refresh: 2; URL='list.php'");
        echo "게시글이 삭제되었습니다.";
    } else {
        header("Refresh: 2; URL='list.php'");
        echo "잘못된 접근입니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();

?>