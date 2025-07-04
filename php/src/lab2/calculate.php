<?php
    
    // 가져오기
    $num = 5;
    $sum = 0;

    for ($i = 1 ; $i <= 5 ; $i++) {
            $sum += $_POST[$i];
    }

    // 계산
    $avg = $sum / $num;
    $dis = 0;
    $std_dev = 0;

    // 출력창
    echo "입력 값 : <br>";
    echo "평균 : {$avg}<br>";
    echo "분산 : {$dis}<br>";
    echo "표준편차 : {$std_dev}";
    
?>