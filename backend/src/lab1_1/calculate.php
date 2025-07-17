<?php

    // 변수 초기화
    $distance = 0.0;

    // 값 받아오기
    $planet = $_POST['planet'];

    // 받은 값에 따라 거리 다르게 부여
    if ($planet == 'mercury') {
        $distance = 57900000;
    } elseif ($planet == 'earth') {
        $distance = 150000000;
    } else {
        $distance = 230000000;
    }

    // 빛의 속도
    $speed = 300000;

    // 도달 시간 계산
    $time = round($distance / $speed / 60, 2);

    // 결과값 출력
    echo "Trave time from Sun to {$planet} : {$time} minutes";
?>