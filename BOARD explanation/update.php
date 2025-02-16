<?php
include("header.php"); // 공통 헤더 포함 (세션 유지 및 UI 통합 가능)

$servername = "localhost";  // MySQL 서버 주소
$username = "hyochan";  // MySQL 계정 이름
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// URL에서 게시글 ID 가져오기 (GET 방식)
// intval() 사용하여 정수 변환 → SQL Injection 방지
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 유효한 ID인지 확인
if ($id > 0) {
    // Prepared Statement 사용 (SQL Injection 방지)
    $sql = "SELECT name, subject, content FROM board WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // 게시글이 존재하는 경우 데이터 가져오기
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "게시글이 존재하지 않습니다.";
        exit;
    }

    $stmt->close(); // Prepared Statement 종료
} else {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

$conn->close(); // 데이터베이스 연결 종료
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 인코딩 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹 설정 -->
    <title>게시글 수정</title> <!-- 페이지 제목 -->
</head>
<body>
    <!-- 로그인한 사용자에게 환영 메시지 및 로그아웃 버튼 제공 -->
    <h5>환영합니다, <?php echo htmlspecialchars($_SESSION['username']); ?>님! <a href="logout.php">로그아웃</a> </h5>

    <h3>게시판 > 게시글 수정</h3>

    <!-- 게시글 수정 폼 -->
    <form action="update_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- 게시글 ID (수정 대상) -->
        
        <p>이름: 
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" 
                   placeholder="이름을 입력하세요." required>
        </p>
        
        <p>제목: 
            <input type="text" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" 
                   placeholder="제목을 입력하세요." required>
        </p>

        <p>내용:<br>
            <textarea name="content" rows="5" cols="30" placeholder="내용을 입력하세요." required><?php echo htmlspecialchars($row['content']); ?></textarea>
        </p>
        
        <button type="submit">수정</button>
    </form>

    <!-- 취소 버튼: 게시글 목록으로 이동 -->
    <form action="list.php" method="get">
        <button type="submit">취소</button>
    </form>
</body>
</html>
