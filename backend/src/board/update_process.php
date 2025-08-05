<?php

    // 데이터베이스 연결 및 세션 시작
    include "./db_connect.php";

    // form 입력 값 가져오기
    $id = $_GET['id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // sql문 작성
    $query = "UPDATE list SET subject='$subject', content='$content' WHERE no='$id'";

    // 쿼리 실행
    if ($result = $db_conn->query($query)) {
        header("Refresh: 2; URL='read.php?id=$id'");
        echo "게시글 수정이 완료되었습니다. 게시글로 돌아갑니다.";
        exit();
    } else {
        echo "잘못된 접근입니다.";
    }

    // 데이터베이스 종료
    $db_conn->close();

?>