<?php

    // 변수 초기화
    $distance = 0;

    // 행성 이름 가져오기
    $planet = $_POST['planet'];

    // 빛의 속도
    $light_speed = 300000;

    // 행성 이름에 따라 다른 거리 저장
    if ($planet == 'mercury') {
        $distance = 57900000;
    } elseif ($planet == 'earth') {
        $distance = 150000000;
    } else {
        $distance = 230000000;
    }

    // 도달 시간 계산
    $time = round($distance / $light_speed / 60, 2);

    // 결과값 출력
    echo "Trave time from Sun to {$planet} : {$time} minutes";
?>