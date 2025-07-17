<?php
    // 세션 ID 출력
    echo session_id()."<br>";

    // 세션이 제대로 시작됐는지 확인하는 방법
    if(!empty(session_id())) {
        echo "세션 시작";
    }

    // 세션 활동하고 있는지 확인하는 방법
    if (session_status() == PHP_SESSION_ACTIVE) {
        echo "<br>세션 활동 중<br>";
    }

    // Create
    $_SESSION['std_info'] = [
        "id" => 2423011, "name" => "김효찬"
    ];

    if (isset($_SESSION['std_info'])) {
        print_r($_SESSION['std_info']);
    } else {
        echo "학생 정보 없음";
    }
?>