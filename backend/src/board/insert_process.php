<?php

    // 입력값 유효성 검사
    // 입력값을 불러오지 못할 경우 공백 처리
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';

    // 유효하지 않는 입력값일 경우
    // 오류 메시지 출력 후 글쓰기 페이지 리다이렉션
    if (empty($title) || empty($content)) {
        header("Refresh: 2; URL='insert.php'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 세션 시작 (DB에 작성자 정보를 저장하기 위해)
    session_start();

    // try
        try {
            // 데이터베이스 연결을 위한 변수 불러오기
            require_once "./db_connect.php";

            // 데이터베이스 연결
            $db_conn = new mysqli($hostname, $username, $password, $database);

            // sql문 작성 (INSERT)
            $sql = "INSERT INTO board (name, account, title, content) VALUE ('$_SESSION[name]', '$_SESSION[id]', '$title', '$content');";

            // 쿼리 실행
            $result = $db_conn->query($sql);

            // 글쓰기 성공 메시지 출력 후 메인 페이지 리다이렉션
            header("Refresh: 2; URL='index.php'");
            echo "글쓰기 성공!";
            exit;
        }
    // catch (Exception $e)
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 글쓰기 페이지 리다이렉션
        // header("Refresh: 2; URL='insert.php'");
        echo $e;
    }

    // 데이터베이스 연결 종료
    $db_conn->close();

?>