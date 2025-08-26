<?php

    // 세션 시작
    session_start();

    // 세션 변수 초기화
    $_SESSION = [];

    // 세션 쿠키 삭제
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

    // 로그아웃 성공! -> 로그인 페이지 리다이렉션
    header("Refresh: 2; URL='login.html'");
    echo "로그아웃 성공!";
    exit;

?>