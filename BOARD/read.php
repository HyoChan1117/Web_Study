<?php
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

// 게시글 ID 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT name, subject, content, created_at FROM board WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "게시글이 존재하지 않습니다.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세 보기</title>
</head>
<body>
    <h3><?php echo htmlspecialchars($row['subject']); ?></h3>
    <p><strong>작성자:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
    <p><strong>작성일:</strong> <?php echo $row['created_at']; ?></p>
    <hr>
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
    <br>
    <a href="list.php">목록으로</a>
</body>
</html>
