<?php
    // 변수

    // 변수 선언 -> 동적 타이핑
    // $변수명 = 값;
    $bar = 1;
    $foo = 2.0;
    $kin = true;
    $pos = "hello";

    // 변수 자료형
    // 1. Scalar types : integer, float, string, boolean
    // 2. Compound types : object, array, callable, iterable
    // 3. resource
    var_dump($bar, $foo, $kin, $pos);

    // hoisting
    

    // 변수의 접근 범위
    // 변수의 생명주기
    //  - 출생  - 소멸
    //    선언     ?

    // 전역변수($bar) 선언
    $bar = "hello";
    print $bar;

    // 지역변수($bar) 선언
    function foo() {
        global $bar;
        print $bar;
    }

    // Java -> 블록 기반
    // python -> 함수 기반
    // php -> 함수 기반
    
    // 인터프리터 언어는 동적 타이핑을 제공

?>