<?php

    // 데이터베이스 연결
    require_once "./db_connect.php";

    // form 입력 값 불러오기
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? password_hash($_POST['pw'], PASSWORD_DEFAULT) : '';

    if (empty($name) || empty($id) || empty($pw)) {
        header("Refresh: 2; URL='register.php'");
        echo "입력 값을 불러올 수 없습니다.";
        exit;
    }

    // 아이디 중복 확인
    // sql문 작성 (SELECT)
    $sql_select = "SELECT * FROM login WHERE id='$id';";
    
    // 쿼리 실행
    $result = $db_conn->query($sql_select);

    // 계정 정보 가져오기
    if ($row = $result->fetch_assoc()) {
        header("Refresh: 2; URL='register.php'");
        echo "중복된 아이디가 존재합니다.";
        exit;
    }


    // 계정 정보 삽입
    // sql문 작성 (INSERT)
    $sql_insert = "INSERT INTO login (name, id, pw)
                   VALUE ('$name', '$id', '$pw');";

    // 쿼리 실행
    if ($result = $db_conn->query($sql_insert)) {
        header("Refresh: 2; URL='login.php'");
        echo "회원가입 성공!";
        exit;
    }

    // 데이터베이스 종료
    $db_conn->close();
?>