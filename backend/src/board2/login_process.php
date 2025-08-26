<?php

    // 입력값 유효성 검사
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않는 입력값일 경우
    // 유효하지 않는 입력값입니다. -> 로그인 페이지 리다이렉션
    if (empty($account) || empty($pw)) {
        header("Refresh: 2; URL='login.html'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    // try
    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // 일치하는 아이디가 없을 경우
        // 일치하는 사용자 정보가 없습니다. -> 로그인 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='login.html'");
            echo "일치하는 사용자 정보가 없습니다.";
            exit;
        }

        // 비밀번호가 일치하지 않을 경우
        // 비밀번호가 일치하지 않습니다. -> 로그인 페이지 리다이렉션
        if (!password_verify($pw, $row['pw'])) {
            header("Refresh: 2; URL='login.html'");
            echo "비밀번호가 일치하지 않습니다.";
            exit;
        }

        // 세션 시작
        session_start();

        // 세션 변수 저장
        $_SESSION['name'] = $row['name'];
        $_SESSION['account'] = $row['account'];

        // 로그인 성공했을 경우
        // 로그인에 성공했습니다. -> 게시판 리스트 페이지 리다이렉션
        header("Refresh: 2; URL='index.php'");
        echo "로그인에 성공했습니다.";
        exit;

    } catch (Exception $e) {
        // 데이터베이스 오류가 났을 경우
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>