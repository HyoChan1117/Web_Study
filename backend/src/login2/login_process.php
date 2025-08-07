<?php

    // 입력값 유효성 검사 (아이디, 비밀번호)
    // 입력값을 불러오지 못할 경우 공백 처리
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    // 유효하지 않은 입력값일 경우
    // 오류 메시지 출력 후 로그인 페이지 리다이렉션
    if (empty($id) || empty($pw)) {
        header("Refresh: 2; URL='login.html';");
        echo "유효하지 않은 입력값입니다.";
        exit;
    }

    // 세션 시작
    session_start();

    // try
    try {
        // 데이터베이스 연결을 위한 변수 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM login2 WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // DB 내 로그인 정보와 입력값 비교
        // 존재하지 않은 아이디일 경우
        // 오류 메시지 출력 후 로그인 페이지 리다이렉션
        if ($row <= 0) {
            header("Refresh: 2; URL='login.html'");
            echo "존재하지 않는 아이디입니다.";
            exit;
        } else {     // 아이디가 존재할 경우
            // 비밀번호가 다를 경우
            // 이때, 비밀번호 비교는 password_verify(입력값, DB 내 해싱된 비밀번호)를 이용하여 하기!
            // 오류 메시지 출력 후 로그인 페이지 리다이렉션
            if (!password_verify($pw, $row['pw'])) {
                header("Refresh: 2; URL='login.html'");
                echo "비밀번호가 일치하지 않습니다.";
                exit;
            }
        }

        // 세션 변수 저장
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];

        // 로그인 성공 메시지 출력 후 메인 페이지 이동
        header("Refresh: 2; URL='index.php';");
        echo "로그인 성공!";
    }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 로그인 페이지 리다이렉션
        header("Refresh: 2; URL='login.html';");
        echo "DB 연결 실패";
    }

    // 데이터베이스 종료
    $db_conn->close();
?>