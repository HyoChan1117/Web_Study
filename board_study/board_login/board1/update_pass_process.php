<?php
session_start();

// 데이터베이스 연결
include("db_connect.php");

// POST로 받은 데이터 검증 (간단히 처리)
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$user_password = isset($_POST['password']) ? $_POST['password'] : '';

if ($id <= 0 || empty($user_password)) {
    echo "잘못된 접근";
    exit;
}

// 데이터베이스에서 비밀번호 가져오기
$sql = "SELECT password FROM board WHERE id = $id";  // SQL Injection 취약!
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // 비밀번호 검증 (평문 비교)
    if ($user_password === $row['password']) {  // 비밀번호 해싱 없음 (매우 위험)
        $_SESSION['authenticated'] = true;
        header("Location: update.php?id=$id");
        exit;
    } else {
        header("Refresh: 2; URL=update_pass.php?id=$id");
        echo "비밀번호가 일치하지 않습니다.";
        exit();
    }
} else {
    echo "게시글 없음";
}

$conn->close();
?>
