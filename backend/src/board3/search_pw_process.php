<?php

    // 입력값 유효성 검사
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $account = isset($_POST['account']) ? $_POST['account'] : '';

    // 유효하지 않는 입력값일 경우
    // 유효하지 않는 입력값입니다. -> 로그인 페이지 리다이렉션
    if (empty($name) || empty($phone) || empty($account)) {
        header("Refresh: 2; URL='login.php'");
        echo "유효하지 않는 입력값입니다.";
        exit;
    }

    try {
        // 데이터베이스 연결
        require_once './db_connect.php';

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM login WHERE account='$account'";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 사용자 정보가 일치하지 않을 경우
        // 해당하는 사용자 정보가 없습니다. -> 로그인 페이지 리다이렉션
        if (empty($row['name']) || empty($row['phone'])) {
            header("Refresh: 2; URL='login.php'");
            echo "해당하는 사용자 정보가 없습니다.";
            exit;
        }

        // 사용자 정보가 있을 경우
        // 비밀번호 정보 출력 후 로그인 페이지 버튼 활성화
        echo "<fieldset>";
        echo "<legend>사용자 정보</legend>";
        echo $name."님의 비밀번호: ".$row['pw'];
        echo "<br>로그인 페이지: <a href='login.php'>로그인</a>";
        echo "</fieldset>";

    } catch (Exception $e) {
        // DB 오류 발생

    }

    // 데이터베이스 종료


?>