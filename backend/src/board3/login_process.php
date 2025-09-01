<?php

    // 입력값 유효성 검사
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않는 입력값일 경우
    // 유효하지 않는 입력값입니다. -> 로그인 페이지 리다이렉션
    if (empty($account) || empty($pw)) {
        header("Refresh: 2; URL='login.php'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    try {
        // 데이터베이스 연결
        require_once './db_connect.php';

        // sql문 작성 (SELECT)
        $sql_select = "SELECT * FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 아이디가 틀린 경우
        // 해당하는 계정 정보가 없습니다. -> 로그인 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='login.php'");
            echo "해당 계정 정보가 없습니다.";
            exit;
        }

        // 비밀번호가 틀렸을 경우
        // 비밀번호가 틀렸습니다. -> 로그인 페이지 리다이렉션
        if ($pw != $row['pw']) {
            header("Refresh: 2; URL='login.php'");
            echo "비밀번호가 틀렸습니다.";
            exit;
        }

        // 계정 정보가 일치할 경우
        // 세션 시작
        session_start();

        // 세션 변수 저장
        $_SESSION['account'] = $account;
        $_SESSION['name'] = $name;

        // 로그인 성공! -> 게시판 목록 페이지 이동
        header("Refresh: 2; URL='index.php'");
        echo "로그인 성공!";
        exit;

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>