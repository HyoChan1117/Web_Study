<?php

    // 세션 시작
    session_start();

    // 세션 변수 불러오기
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $account = isset($_SESSION['id']) ? $_SESSION['id'] : '';

    // 유효하지 않은 값을 불러왔을 경우
    // 오류 메시지 출력
    if (empty($name) || empty($account)) {
        // 세션 변수 초기화
        $_SESSION = [];

        // 세션 삭제
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 3600,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
        }

        // 세션 파괴
        session_destroy();
        echo "잘못된 접근입니다.";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    안녕하세요! <?php echo $name."($account)"; ?>님 
    <a href="logout.php">로그아웃</a><br>
</body>
</html>