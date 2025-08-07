<?php

    // 입력값 유효성 검사
    // 입력값을 불러오지 못할 경우 공백 처리
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않은 입력값일 경우
    // 오류 메시지 출력 후 login.html 리다이렉션
    if (empty($id) || empty($pw)) {
        header("Refresh: 2; URL='login.html'");
        echo "유효하지 않은 입력값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // try-catch
    // try
    try {
        // 데이터베이스 연결을 위한 변수값 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (Select)
        $sql = "SELECT * FROM login1 WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 1. 존재하지 않는 아이디
        if ($row <= 0) {
            header("Refresh: 2; URL='login.html'");
            echo "존재하지 않는 아이디입니다.";
            exit;
        }

        // 2. 일치하지 않는 비밀번호
        if (!password_verify($pw, $row['pw'])) {
            header("Refresh: 2; URL='login.html'");
            echo "일치하지 않는 비밀번호입니다.";
            exit;
        }

        // 세션 변수 저장
        $_SESSION['name'] = $row['name'];

        // 성공 메시지 출력 후 메인 페이지 이동
        header("Refresh: 2; URL='welcome.php'");
        echo "로그인 성공!";
        exit;

    } catch (Exception $e) {     // catch
        // 데이터베이스 연결 실패 시
        header("Refresh: 2; URL='login.html'");
        echo "DB 연결 실패";
        exit;
    }
?>