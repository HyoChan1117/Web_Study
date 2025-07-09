<?php

    // 변수 초기화
    $sum = 0;
    $num = 5;  // 입력 값 개수
    $std_var = 0;

    // 입력 값 가져오기
    // 합계 계산까지!
    echo "입력 값 : ";
    
    for ($i = 1 ; $i <= 5 ; $i++) {
        echo "$_POST[$i] ";
        $sum += $_POST[$i];
    }

    // 평균 계산하기
    $avg = $sum / $num;

    // 분산 계산하기
    for ($i = 1 ; $i <= $num ; $i++) {
        $std_var += pow($_POST[$i] - $avg, 2);
    }

    $std_var = $std_var / ($num - 1);

    // 표준편차 계산하기
    $std_dev = round(sqrt($std_var), 2);

    // 결과값 출력
    echo "<br>평균 : {$avg}<br>";
    echo "분산 : {$std_var}<br>";
    echo "표준편차 : {$std_dev}<br>";
?>