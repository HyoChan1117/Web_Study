<?php
session_start(); // 현재 세션을 시작 (세션이 이미 시작된 경우 기존 세션을 사용)

// 모든 세션 변수 해제
session_unset(); // 세션에 등록된 모든 변수 제거

// 세션을 완전히 종료 (서버에서 해당 세션 삭제)
session_destroy(); 

// 로그아웃 후 로그인 페이지로 이동
header("Location: login.php"); 
exit(); // 추가적인 코드 실행을 방지하고 즉시 종료
?>
