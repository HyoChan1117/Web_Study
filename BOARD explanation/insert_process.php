<?php
// MySQL 데이터베이스 연결 정보 설정
$servername = "localhost";
$username = "hyochan";
$password = "40957976";
$database = "board_login";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 폼에서 입력한 값 가져오기 (trim 사용하여 앞뒤 공백 제거)
$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : "";
$content = isset($_POST["content"]) ? trim($_POST["content"]) : "";

// 입력값 검증 (이름, 제목, 내용 중 하나라도 비어 있으면 게시글 저장 불가)
if (empty($name) || empty($subject) || empty($content)) {
    echo "<script>alert('이름, 제목, 내용은 필수 입력 항목입니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=list.php'>";
    exit;
}

// 🚨 SQL Injection 위험 코드 (Prepared Statement 미사용)
$sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";

// SQL 실행
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('글이 등록되었습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=list.php'>";
} 
// 오류 발생 시
else {
    echo "<script>alert('오류: " . $conn->error . "');</script>";
    echo "<meta http-equiv='refresh' content='0;url=list.php'>";
}

// 데이터베이스 연결 종료
$conn->close();
?>
