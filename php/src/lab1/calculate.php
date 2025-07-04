<?php

    // key값을 이용해서 value값 가져오기
    $planet = $_POST['planet'];

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

    echo "Trave time from Sun to mercury : {$time} minutes";

?>