<?php

    // 입력값 유효성 검사
    // form 입력값 불러오기
    // 입력값을 제대로 가지고 오지 못할 경우 -> 공백 처리
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 공백일 경우 유효하지 않은 입력값
    // 오류 메시지 출력 후 register.html 리다이렉션
    if (empty($name) || empty($id) || empty($pw)) {
        header("Refresh: 2; URL='register.html'");
        echo "유효하지 않은 입력값입니다.";
    }

    // 세션 시작
    session_start();

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once "./db_connect.php";

    // try: 데이터베이스 연결 성공 시 해피 시나리오 작성
    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql_select = "SELECT * FROM login1 WHERE id='$id'";

        // 쿼리 실행
        $result = $db_conn->query($sql_select);
        $row = $result->fetch_assoc();

        // 아이디 중복 검사
        // 아이디 중복이 있을 경우
        // 오류 메시지 출력 후 register.html 리다이렉션
        if ($row > 0) {
            header("Refresh: 2; URL='register.html'");
            echo "중복된 아이디가 존재합니다.";
        }

        // 비밀번호 해싱
        // password_hash()
        $pw = password_hash($pw, PASSWORD_DEFAULT);

        // 입력된 정보 DB 저장
        // sql문 작성 (INSERT)
        $sql_insert = "INSERT INTO login1 (name, id, pw) VALUE ('$name', '$id', '$pw')";

        // 쿼리 실행
        if ($result = $db_conn->query($sql_insert)) {
            header("Refresh: 2; URL='login.html'");
            echo "회원가입 성공!";
        }
    } catch (mysqli_sql_exception) {   // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 register.html 리다이렉션
        header("Refresh: 2; URL='register.html'");
        echo "DB 연결 실패";
    }
?> 