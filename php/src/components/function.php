<?php
    
    $bar = 1;
    $foo = 2.0;
    $kin = true;
    $pos = "hello";

    // 변수 자료형
    // 1. Scalar types : integer, float, string, boolean
    // 2. Compound types : object, array, callable, iterable
    // 3. resource

    // 함수 선언 : 함수가 일급 함수로 처리 됨
    // 일급시민이란?
    // 1. 함수를 변수에 할당
    // 2. 다른 함수의 매개변수로 전달
    // 3. 함수의 반환값으로 사용

    // 일급 함수가 되면 캡쳐가 가능
    // 캡쳐란? 함수가 선언된 시점의 변수를 참조하는 것
        function bar(array $arg) {
        foreach ($arg as $key => $value) {
            echo "{$key} : {$value}<br>";
        }
    }

    $foo = [1, 2, 3];

    bar($foo);
    var_dump($foo);

    function foo($arg) {
        return $arg;
    }
    $kin = foo($bar);
    $kin("msg");

    var_dump($bar);
?>