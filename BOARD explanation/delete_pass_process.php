<?php
session_start(); // 세션 시작 (사용자 인증 정보를 저장하기 위해 필요)

// MySQL 데이터베이스 연결
$conn = new mysqli("localhost", "hyochan", "40957976", "board_login");

// 연결 확인 (연결 실패 시 종료)
if ($conn->connect_error) {
    die("서버 연결 실패");
}

// POST 요청으로 받은 데이터 검증
$id = isset($_POST['id']) ? intval($_POST['id']) : 0; // 게시글 ID (정수 변환하여 SQL Injection 방지)
$user_password = isset($_POST['password']) ? $_POST['password'] : ''; // 사용자 입력 비밀번호

// 유효성 검사: ID가 0 이하이거나 비밀번호가 비어 있으면 잘못된 접근 처리
if ($id <= 0 || empty($user_password)) {
    echo "잘못된 접근";
    exit;
}

// 🚨 SQL Injection 취약 코드 (수정 필요)
$sql = "SELECT password FROM board WHERE id = $id";  // ❌ 직접적인 SQL 문자열 삽입
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // 🚨 비밀번호를 평문으로 비교 (보안 취약)
    if ($user_password === $row['password']) {  // ❌ 해싱된 비밀번호가 아니기 때문에 보안상 매우 취약!
        $_SESSION['authenticated'] = true;
        header("Location: delete.php?id=$id"); // 게시글 삭제 페이지로 이동
        exit;
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>"; // 비밀번호 불일치 처리
    }
} else {
    echo "게시글 없음"; // 해당 ID의 게시글이 없는 경우
}

$conn->close(); // 데이터베이스 연결 종료
?>
