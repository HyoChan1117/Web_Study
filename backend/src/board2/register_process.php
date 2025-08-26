<?php

    // 입력값 유효성 검사
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';
    $pw_check = isset($_POST['pw_check']) ? $_POST['pw_check'] : '';

    // 유효하지 않은 값이 넘어올 경우
    // 유효하지 않는 값입니다. -> 회원가입 페이지 리다이렉션
    if (empty($name) || empty($account) || empty($pw) || empty($pw_check)) {
        header("Refresh: 2; URL='register.html'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 가져오기
    require_once './db_connect.php';

    // try
    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql_select = "SELECT * FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 중복된 계정이 있을 경우
        // 중복된 아이디가 있습니다. -> 회원가입 페이지 리다이렉션
        if ($result -> num_rows > 0) {
            header("Refresh: 2; URL='register.html'");
            echo "중복된 아이디가 있습니다.";
            exit;
        }

        // 비밀번호와 비밀번호 확인이 일치하지 않은 경우
        // 비밀번호가 일치하지 않습니다. -> 회원가입 페이지 리다이렉션
        if ($pw != $pw_check) {
            header("Refresh: 2; URL='register.html'");
            echo "비밀번호가 일치하지 않습니다.";
            exit;
        }

        // 중복된 계정이 없거나 비밀번호가 일치하는 경우
        // 비밀번호 해싱
        $pw_hash = password_hash($pw, PASSWORD_DEFAULT);

        // sql문 작성 (INSERT)
        $sql_insert = "INSERT INTO login (name, account, pw) VALUES ('$name', '$account', '$pw_hash')";

        // 쿼리 실행
        $result = $db_conn->query($sql_insert);

        // 회원가입 성공 시
        // 회원가입에 성공했습니다. -> 로그인 페이지 리다이렉션
        header("Refresh: 2; URL='login.html'");
        echo "회원가입에 성공했습니다.";
        exit;

    } catch (Exception $e) {
        // 데이터베이스 오류 발생 시
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>