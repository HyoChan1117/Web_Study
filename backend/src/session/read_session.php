<?php

    // session_start();

    // read
    $name = $_SESSION['std_info']['name'];
    echo $name;

    // Delete
    // unset : 변수나 자료구조를 메모리 상에서 해제하는 역할
    // 파이썬의 dell과 같은 역할
    unset($_SESSION['std_info']['name']);

    print_r($_SESSION);


    // 세션 삭제 하는 방법
    // 1. $_SESSION에 대한 삭제
    $_SESSION = [];  // 메모리상 삭제
    
    // 2. session file에 대한 삭제
    session_destroy();  // 세션 파일 삭제

    // 3. 쿠키에 대한 삭제
    // 쿠키를 삭제하기 위해서는 path와 domain을 정확히 지정해줘야 함

?>