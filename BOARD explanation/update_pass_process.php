<?php
session_start(); // 세션 시작 (사용자 인증 정보를 저장하기 위해 필요)

// MySQL 데이터베이스 연결
$conn = new mysqli("localhost", "hyochan", "40957976", "board_login");

// 연결 확인 (연결 실패 시 종료)
if ($conn->connect_error) {
    die("서버 연결 실패"); // 보안상 상세한 에러 메시지는 출력하지 않음
}

// POST 요청으로 받은 데이터 검증
$id = isset($_POST['id']) ? intval($_POST['id']) : 0; // 정수 변환 (SQL Injection 방지 일부 효과)
$user_password = isset($_POST['password']) ? $_POST['password'] : ''; // 입력된 비밀번호

// ID가 0 이하이거나 비밀번호가 비어있으면 잘못된 접근 처리
if ($id <= 0 || empty($user_password)) {
    echo "잘못된 접근";
    exit;
}

// 데이터베이스에서 해당 게시글의 비밀번호 가져오기 (🚨 SQL Injection 취약 코드)
$sql = "SELECT password FROM board WHERE id = $id";  // ❌ 위험한 코드 (SQL Injection 가능성 있음)
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // 🚨 비밀번호를 평문으로 비교 (보안 취약)
    if ($user_password === $row['password']) {  // ❌ 비밀번호 해싱이 없어서 매우 위험!
        $_SESSION['authenticated'] = true; // 세션에 인증 상태 저장
        header("Location: update.php?id=$id"); // 게시글 수정 페이지로 이동
        exit;
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>"; // 비밀번호 불일치 처리
    }
} else {
    echo "게시글 없음"; // 해당 ID의 게시글이 없는 경우
}

$conn->close(); // 데이터베이스 연결 종료
?>
