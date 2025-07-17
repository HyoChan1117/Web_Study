<?php
    include_once('1.php');
    require_once('myUtil.php');
    include_once('1.php');
    require_once('myUtil.php');

    echo "<br>hello<br>";    

    // module : include, require (현재 파일에서 특정 파일에 ctrl + c, v)
    // include : 파일을 찾지 못할 경우 Warning
    // require : 파일을 찾지 못할 경우 Error
    // include_once : 중복 삽입 방지
    // require_once : 중복 삽입 방지

    sum(1, 2);
?>