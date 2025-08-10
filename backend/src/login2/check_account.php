<?php
    
    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id 값이 넘어올 경우
    // 오류 메시지 출력 후 해당 게시글 리다이렉션
    if (empty($id)) {
        echo "잘못된 접근입니다.";
        exit;
    }

    // sql문 작성 (SELECT)
    $sql_select = "SELECT id, account FROM board WHERE id='$id'";

    // 쿼리 실행
    $result = $db_conn->query($sql_select);
    $row = $result->fetch_assoc();

    // 세션 시작
    session_start();

    // 세션 정보와 게시글 작성자 정보 비교
    // 정보가 다르다면
    // 오류 메시지 출력 후 해당 게시글 페이지 리다이렉션
    if ($result->num_rows <= 0) {
        header("Refresh: 2; URL='index.php'");
        echo "해당 게시글은 존재하지 않습니다.";
        exit;
    } else {
        if ($row['account'] != $_SESSION['id']) {
            header("Refresh: 2; URL='read.php?id=$id'");
            echo "접근할 수 없는 계정입니다.";
            exit;
        }
    }
    

?>