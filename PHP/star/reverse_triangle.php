<pre>
<?php
# 역삼각형 별찍기
$length = 4; # 높이

for ($i = 0 ; $i < $length ; $i++) {
    # 공백
    for ($j = $length - 1 ; $j > $i ; $j++) {
        echo " ";
    }

    # 별찍기
    for ($k = 0 ; $k < $i + 1 ; $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
</pre>