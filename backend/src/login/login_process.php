<?php

    // 세션 시작
    session_start();

    // form 입력 값 불러오기
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';

    if (empty($id) || empty($pw)) {
        header("Refresh: 2; URL='register.php'");
        echo "입력 값을 불러올 수 없습니다.";
        exit;
    }

    // DB 연결
    require_once "./db_connect.php";

    // sql문 작성 (SELECT)
    $sql = "SELECT * FROM login WHERE id='$id'";

    // 쿼리 실행
    $result = $db_conn->query($sql);

    // 해당 계정의 정보 가져오기
    if ($row = $result->fetch_assoc()) {
        // 비밀번호가 일치하지 않을 경우
        if (!password_verify($pw, $row['pw'])) {
            header("Refresh: 2; URL='login.php'");
            echo "비밀번호가 일치하지 않습니다.";
            exit;
        } else {
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Refresh: 2; URL='welcome.php'");
            echo "로그인 성공!";
            exit;
        }
    } else {
        header("Refresh: 2; URL='login.php'");
        echo "존재하는 계정이 없습니다.";
    }
    
    // 데이터베이스 종료
    $db_conn->close();

?>