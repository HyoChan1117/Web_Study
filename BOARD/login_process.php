<?php
session_start(); // 세션 시작

// 데이터베이스 연결
$servername = "localhost";
$username = "hyochan";
$password = "40957976";
$database = "board_login";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// POST 데이터 받기
$id = $_POST['id'];
$pass = $_POST['password'];

// SQL 실행 (Prepared Statement 미사용, 직접 쿼리 실행)
$sql = "SELECT * FROM login WHERE id = '$id' AND password = '$pass'";
$result = $conn->query($sql);

// 로그인 검증
if ($result->num_rows > 0) {
    // 세션에 사용자 정보 저장
    $_SESSION['username'] = $id; 

    echo "<script>alert('로그인 성공!'); location.href='list.php';</script>";
    exit();
} else {
    echo "<script>alert('로그인 실패: 아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
    exit();
}

// 연결 종료
$conn->close();
?>
