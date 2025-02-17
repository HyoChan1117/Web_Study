<?php
include("db_connect.php");

// POST 데이터 받기
$id = $_POST['id'];
$pass = $_POST['pass'];
$pass_check = $_POST['pass_check'];

// 아이디와 비밀번호 입력 여부 확인
if (empty($id) || empty($pass) || empty($pass_check)) {
    die("아이디와 비밀번호를 모두 입력해야 합니다. <a href='join.php'>다시 시도</a>");
}

// 비밀번호 확인 체크
if ($pass !== $pass_check) {
    die("비밀번호가 일치하지 않습니다. <a href='join.php'>다시 시도</a>");
}

// 중복 ID 확인 (Prepared Statement 미사용)
$sql = "SELECT id FROM login WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 중복 ID 존재 시
    echo "이미 존재하는 아이디입니다. <a href='join.php'>다시 입력</a>";
    $conn->close();
    exit();
}

// 회원가입 처리 (Prepared Statement 미사용)
$sql = "INSERT INTO login (id, password) VALUES ('$id', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "회원가입이 완료되었습니다. <a href='login.php'>로그인</a>";
} else {
    echo "회원가입 실패: " . $conn->error;
}

// 연결 종료
$conn->close();
?>
