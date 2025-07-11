<?php

    echo "flkasdjklfjflsdj";

    // 1. 쿠키 생성 요청 (App) : 한 번에 한 개만 생성할 수 있음
    setcookie("bar", "milk");
    setcookie("foo", "beer");
    setcookie("pos", "water");
    setcookie("kin", "cider", time() - 3600);

    // http response 메시지에 bar 라는 이름과 milk 라는 값을 가지는
    // 쿠키를 생성하는 메시지를 작성하시오.
    // bar = milk

    // 2. 쿠키 생성(Client)
    // Web browser가 local에 쿠키 정보를 파일로 저장
    // 도메인 단위 관리 : localhost//bar=milk
    
    
    // 3. 쿠키 전달 (Client)


    // 4. 쿠키 읽기 (App)

?>