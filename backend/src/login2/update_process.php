<?php

    // 입력값 유효성 검사
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // 유효하지 않는 입력값일 경우
    // 오류 메시지 출력 후 게시글 수정 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='update.php?id=$id'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id 값일 경우
    // 오류 메시지 출력
    if (empty($id)) {
        echo "잘못된 접근입니다.";
        exit;
    }

    // try
    try {
        // 데이터베이스 연결을 위한 변수값 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // 계정 정보 비교 알고리즘 불러오기
        require_once "./check_account.php";

        // sql문 작성 (UPDATE)
        $sql = "UPDATE board SET title='$title', content='$content' WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        header("Refresh: 2; read.php?id=$id");
        echo "수정 완료!";
        exit;
    }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 게시글 수정 페이지 리다이렉션
        // header("Refresh: 2; URL='update.php?id=$id'");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>