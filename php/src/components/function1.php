<?php
    // Hoisting : 변수나 함수의 선언문이 최상단으로 올려진 것처럼 동작
    echo sum(1, 2);
    function sum($a, $b){
        return $a + $b;
    }

    // php에서는 오버로딩을 지원하지 않는다. - 동적인 언어이기 때문

    // call-by-value & call-by-reference
    // 하나의 함수를 호출할 때, 해당 함수의 입력값으로 인자값을 넣어줌
    // value : 인자값을 복사해서 전달
    // reference : 인자값의 주소를 전달
    // php에서는 기본적으로 call-by-value로 동작
    function bar($a) {
        $a = 100;
    }
    $foo = 3;

    bar($foo);

    echo $foo; // 3, call-by-value이기 때문
?>