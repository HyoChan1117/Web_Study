<?php
// 데이터베이스 연결 정보 설정
$servername = "localhost";  // MySQL 서버 주소 (로컬 개발 환경에서는 localhost 사용)
$username = "hyochan";  // MySQL 계정 이름
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결 (객체 지향 방식)
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 오류 메시지 출력 후 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// POST 요청으로 전달된 데이터 가져오기 및 검증
$id = isset($_POST['id']) ? intval($_POST['id']) : 0; // 게시글 ID (정수 변환하여 SQL Injection 방지)
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : ''; // 작성자 이름
$subject = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : ''; // 게시글 제목
$content = isset($_POST['content']) ? $conn->real_escape_string($_POST['content']) : ''; // 게시글 내용

// 모든 입력값이 유효한지 확인
if ($id > 0 && $name && $subject && $content) {
    // SQL Injection 방지를 위해 Prepared Statement 사용 (기존 방식은 취약)
    $sql = "UPDATE board SET name=?, subject=?, content=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $subject, $content, $id); // "sssi"는 데이터 타입 (문자열, 문자열, 문자열, 정수)

    // SQL 실행
    if ($stmt->execute()) {
        echo "게시글이 수정되었습니다.";
        echo "<meta http-equiv='refresh' content='1;url=read.php?id=$id'>"; // 1초 후 게시글 보기 페이지로 이동
    } else {
        echo "오류 발생: " . $conn->error;
    }

    // Prepared Statement 종료
    $stmt->close();
} else {
    echo "모든 필드를 입력해야 합니다.";
}

// 데이터베이스 연결 종료
$conn->close();
?>
