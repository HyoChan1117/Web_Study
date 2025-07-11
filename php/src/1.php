<?php

    print_r($_POST);


    // POST or GET 입력 값에 대한 검증이 필요
    // 1. 입력 값의 존재 여부
    function http_response_error($msg) {
        http_response_code(400);

        echo $msg;
    }

    if(!isset($_POST['id']) || !isset($_POST['pw'])) {
        http_response_error("입력 값을 확인하세요.");
        exit;
    }

    // 2. 문자열 전처리
    $id = trim($_POST['id']);
    $pw = trim($_POST['pw']);

    var_dump($_POST);

    echo "입력 값 검증 완료";

    // 3. Option : 각 필드별 특성 처리
    // 숫자를 입력하지 않은 경우
    if(!is_numeric($pw)) {
         http_response_error("패스워드는 숫자로 해당합니다.");
    }

    // key 값이 왔는데 value 값이 없을 경우
    if($id === '') {
        http_response_error("id를 입력하세요.");
    }
?>