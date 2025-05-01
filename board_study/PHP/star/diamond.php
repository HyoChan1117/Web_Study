<pre>
<?php
# 다이아몬드 별찍기
$col_up = 4;
$col_down = 4;

# 윗부분
for ($i = 1 ; $i < $col_up + 2 ; $i++) {
    # 공백
    for ($j = 1 ; $j < $col_up - $i + 2 ; $j++) {
        echo " ";
    }
    # 별찍기
    for ($k = 1 ; $k < $i * 2 ; $k++) {
        echo "*";
    }
    echo "<br>";
}

# 아랫부분
for ($i = 0 ; $i < $col_down ; $i++) {
    # 공백
    for ($j = 0 ; $j < $i + 1 ; $j++) {
        echo " ";
    }
    # 별찍기
    for ($k = 1 ; $k < $col_down * 2 - $i * 2 ; $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
</pre>