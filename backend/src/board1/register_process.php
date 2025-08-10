<?php

    // 입력값 유효성 검사
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않는 입력값이 넘어올 경우
    // 오류 메시지 출력 후 회원가입 페이지 리다이렉션
    if (empty($name) || empty($account) || empty($pw)) {
        header("Refresh: 2; URL='register.html'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    // 데이터베이스 연결 (try-catch문)
    try {
        // 데이터베이스 연결을 위한 변수 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT) - 아이디 중복 확인을 위한 select
        $sql_select = "SELECT account FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        
        // 아이디 중복이 있을 경우
        // 오류 메시지 출력 후 회원가입 페이지 리다이렉션
        if ($result->num_rows > 0) {
            header("Refresh: 2; URL='register.html'");
            echo "중복되는 아이디가 존재합니다.";
            exit;
        } else {     // 아이디 중복이 없을 경우
            // 비밀번호 해싱
            $pw = password_hash($pw, PASSWORD_DEFAULT);

            // sql문 작성 (INSERT) - 아이디 중복 확인 후 이상 없으면 집어 넣기
            $sql_insert = "INSERT INTO login (name, account, pw) VALUES ('$name', '$account', '$pw')";

            // 쿼리 실행
            $result = $db_conn->query($sql_insert);

        // 성공적으로 데이터 삽입이 이루어졌을 때
        // 회원가입 성공 메시지 출력 후 로그인 페이지 리다이렉션
        header("Refresh: 2; URL='login.html'");
        echo "회원가입 성공!";
        exit;
    }
    } catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 회원가입 페이지 리다이렉션
        header("Refresh: 2; URL='register.html'");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>