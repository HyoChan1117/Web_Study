<?php

    // 입력값 유효성 검사 (이름, 아이디, 비밀번호)
    // 입력값이 제대로 넘어오지 않은 경우 공백 처리
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않은 입력값일 경우
    // 오류 메시지 출력 후 회원가입 페이지 리다이렉션
    if (empty($name) || empty($id) || empty($pw)) {
        header("Refresh: 2; URL='register.html'");
        echo "유효하지 않은 입력값입니다.";
        exit;
    }

    // 데이터베이스 연결
    // try
    try {
        // 데이터베이스 연결을 위한 변수값 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql_select = "SELECT * FROM login2 WHERE id='id';";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // 아이디 중복 검사
        // 중복되는 아이디가 존재하면 오류 메시지 출력 후 회원가입 페이지 리다이렉션
        if ($row > 0) {
            header("Refresh: 2; URL='register.html'");
            echo "중복되는 아이디가 존재합니다.";
            exit;
        } else {     // 중복되는 아이디가 존재하지 않으면
            // 비밀번호 해싱
            $pw = password_hash($pw, PASSWORD_DEFAULT);
        }

        // 입력된 정보 DB 저장
        // sql문 작성 (INSERT)
        $sql_insert = "INSERT INTO login2 (name, id, pw) VALUE ('$name', '$id', '$pw');";

        // 쿼리 실행
        $result = $db_conn->query($sql_insert);

        // 회원가입 성공 메시지 출력 후 로그인 페이지 리다이렉션
        header("Refresh: 2; URL='login.html'");
        echo "회원가입 성공";
        exit;
    }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 회원가입 페이지 리다이렉션
        header("Refresh: 2; URL='register.html'");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>