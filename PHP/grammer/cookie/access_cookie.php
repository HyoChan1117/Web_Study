<?php
    # 쿠키 접근하기
    // $_COOKIE["username"]은 username 쿠키의 값을 의미
    // set_cookie.php와 같이 username 쿠키를 설정하면 $_COOKIE["username"]은 '홍길동'의 값을 가짐
    // isset() 함수는 변수 값이 존재하는 지를 체크하는 데 사용됨
    if(isset($_COOKIE["username"])) {
        echo $_COOKIE["username"]."님 환영합니다.";
    }
    else {
        echo "username 쿠키가 존재하지 않습니다.";
    }
?>