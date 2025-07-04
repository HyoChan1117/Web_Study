<?php
 // Operator
  // 1) 기능 : 산술, 비교, 논리, 복합 등
  // 2) 우선순위 : 최고 -> () / 최소 -> =
  // 3) 이항연산 시 묵시적 형변환 규칙 
  // 산술
  echo 2**3;
  $bar = 1;
  $foo = 2;
  
  // 비교 : ==,
  // 동적 언어를 제공하는 언어인 경우, 변수의 자료형까지 비교하는 연산자도 제공
  // == / != : 스칼라 값만 비교
  // === / !== : 스칼라 값과 자료형까지 비교
  // <> : 같지 않다 -> 사용하지는 않기!
  if($bar == $foo) {
    echo "True";  
  } else {
    echo "False"; 
  }
  // Spaceship
  echo (1 <=> 1);
  echo (2 <=> 1);
  echo (1 <=> 2);

  $my_array = [10, 1, 5, 90, 3];

  usort($my_array, function($a, $b) {
    return $a <=> $b;
    // if ($a == $b) {
    //     return 0;
    // } else {
    //     return $a < $b ? -1 : 1;
    // }
  });


  // 논리 : !, &&, ||
  //        and, or
  $bar = true && false;  // true false 비교한 후 $bar에 저장(이거 쓰기!)
  var_dump($bar);

  $foo = true and false;  // true를 $bar에 저장한 후 false와 비교
  var_dump($foo);

  // 복합 : Java와 동일

  // 문자열
//   echo "1" + "222ff";  // 느슨한 결합 -> 문자열을 숫자화 - 223
  echo "1" . "222ff";  // 문자열 연산자 -> 문자열을 결합하기 위한 연산자
//   echo "1" . "ff222ff";  // 이건 안됨
  // 에러제어 연산자 : @ -> 지금은 사용 안함

  // 실행 연산자 : ` `
  echo `ls -la`;

  $bar = [1, 2, 3];
  $foo = [1, 2, 5];

  if ($bar==$foo) {
    echo "True";
  } else {
    echo "False";
  }

  // 배열 연산자 (Array)
  // HashMap : key <-> value pair
  // key => value
  $bar = [1, 2, 3];
  $foo = [1, 2 => 3, 1 => 2];

  if ($bar===$foo) {
    echo "True";
  } else {
    echo "False";
  }

  // 삼항 연산자
  echo 2 > 4 ? "hello" : "world";
?>