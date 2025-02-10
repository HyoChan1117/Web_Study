<?php
# 직사각형 별찍기
$width = 5; # 너비
$height = 6; # 높이

for ($i = 0 ; $i < $height ; $i++) {
    for ($j = 0 ; $j < $width ; $j++) {
        echo "*";
    }
    echo "<br>";
}
?>