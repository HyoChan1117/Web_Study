<?php
session_start(); // 세션 시작 (사용자의 로그인 상태를 확인하기 위해 필요)

// 로그인한 사용자인지 확인
if (!isset($_SESSION['username'])) {
    // 로그인되지 않은 경우 로그인 페이지로 이동
    header("Location: login.php");
    exit(); // 추가적인 코드 실행 방지
}
?>
