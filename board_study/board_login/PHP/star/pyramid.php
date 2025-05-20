<pre>
<?php
# 피라미드 별찍기
# 열 개수
$col = 5;

for ($i = 1 ; $i < $col + 1 ; $i++){
    # 공백
    for ($j = 1 ; $j < ($col + 1) - $i ; $j++){
        echo " ";
    }
    
    # 별 찍기
    for ($k = 1 ; $k < $i * 2 ; $k++){
        echo "*";
    }
    echo "<br>";
}

?>
</pre>