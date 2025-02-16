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

// GET 요청에서 게시글 ID 가져오기 (SQL Injection 방지)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ID가 0 이하이면 잘못된 요청 처리
if ($id <= 0) {
    die("잘못된 요청입니다.");
}

// 🚨 SQL Injection 취약 코드 (Prepared Statement 미사용)
$sql = "DELETE FROM board WHERE id = $id";

// SQL 실행
if ($conn->query($sql) === TRUE) {
    echo "게시글이 삭제되었습니다.<br>";

    // 🚨 ID를 다시 1부터 정렬하는 것은 비효율적이고 의미 없음!
    // $conn->query("SET @count = 0");
    // $conn->query("UPDATE board SET id = @count := @count + 1");
    // $conn->query("ALTER TABLE board AUTO_INCREMENT = 1");

    // 2초 후 목록 페이지로 이동
    echo "<meta http-equiv='refresh' content='2;url=list.php'>";
} else {
    echo "오류 발생: " . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
