<?php
session_start(); // 세션 시작

// 데이터베이스 연결
include("db_connect.php");

// POST 데이터 받기
$id = $_POST['id'];
$pass = $_POST['password'];

// SQL 실행
$sql = "SELECT * FROM login WHERE id = '$id' AND password = '$pass'";
$result = $conn->query($sql);

// 로그인 검증
if ($result->num_rows > 0) {
    // 세션에 사용자 정보 저장
    $_SESSION['username'] = $id; 
    header("Refresh: 2; URL=list.php");
    exit();
} else {
    header("Refresh: 2; URL=login.php");
    echo "로그인 실패! 아이디 또는 비밀번호가 틀렸습니다.";
}

// 연결 종료
$conn->close();
?>
