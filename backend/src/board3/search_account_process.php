<?php

    // 입력값 유효성 검사
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // 유효하지 않는 입력값일 경우
    // 유효하지 않는 값입니다. -> 로그인 페이지 리다이렉션
    if (empty($name) || empty($phone)) {
        header("Refresh: 2; URL='login.php'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    try {
        // 데이터베이스 연결
        require_once './db_connect.php';

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM login WHERE phone='$phone'";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 해당 계정이 없을 경우
        // 해당하는 계정이 없습니다. -> 로그인 페이지 리다이렉션
        if ($result->num_rows <= 0 || $row['name'] != $name) {
            header("Refresh: 2; URL='login.php'");
            echo "해당하는 계정이 없습니다.";
            exit;
        }

        // 해당 계정이 있을 경우
        // 계정 아이디 출력 후 로그인 및 비밀번호 찾기 버튼 활성화
        echo $name."님의 아이디: ".$row['account'];
        echo "<br>로그인 페이지: <a href='login.php'>로그인</a>";
        echo "<br>비밀번호 찾기: <a href='search_pw.php'>비밀번호 찾기</a>";
    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

?>