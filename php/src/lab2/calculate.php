<?php
    // 가져오기
    $num = 5;
    $sum = 0;
    $dis_val = 0;

    echo "입력 값: ";
    for ($i = 1 ; $i <= 5 ; $i++) {
        $sum += $_POST[$i];
        echo "{$_POST[$i]} ";
    }

    // 평균 계산
    $avg = $sum / $num;
    
    // 분산 계산
    for ($i = 1 ; $i <= $num ; $i++) {
        $dis_val += pow($_POST[$i] - $avg, 2);
    }
    
    $dis = $dis_val / ($num - 1);

    // 표준편차
    $std_dev = round(sqrt($dis), 2);

    // 출력창
    echo "<br>";
    echo "평균 : {$avg}<br>";
    echo "분산 : {$dis}<br>";
    echo "표준편차 : {$std_dev}";
?>