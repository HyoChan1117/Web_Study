<?php

    // 변수 초기화
    $sum = 0;
    $num = 5;  // 입력하는 정수의 개수

    // 입력 값 가져오기 - 입력 값 출력, 합계 포함
    echo "입력 값 : ";
    for ($i = 1 ; $i <= $num ; $i++) {
        $sum += $_POST[$i];
        echo "{$_POST[$i]} ";
    }

    // 평균 계산하기
    $avg = $sum / $num;

    // 분산 계산하기
    $val = 0;

    for ($i = 1 ; $i <= $num ; $i++) {
        $val += pow($_POST[$i] - $avg, 2);
    }

    $disper = $val / ($num - 1);

    // 표준편차 계산하기
    $std_dev = round(sqrt($disper), 2);

    // 계산 값 출력하기
    echo "<br>";
    echo "평균 : {$avg}<br>";
    echo "분산 : {$disper}<br>";
    echo "표준편차 : {$std_dev}";
?>