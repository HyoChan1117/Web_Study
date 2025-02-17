<?php
include("header.php");

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

if ($id <= 0) {
    die("잘못된 접근입니다. ID가 유효하지 않습니다.");
}

$sql = "SELECT id, name, subject, content, created_at FROM board WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("게시글이 존재하지 않습니다.");
}

$stmt->close();
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
    <h3>게시판 > 상세보기</h3>
    <h3><?php echo $row['subject']; ?></h3>
    <p><strong>작성자:</strong> <?php echo $row['name']; ?></p>
    <p><strong>작성일:</strong> <?php echo $row['created_at']; ?></p>
    <br>
    <p><?php echo $row['content']; ?></p><br>
    
    <!-- 수정 & 삭제 버튼을 나란히 배치 -->
    <table>
        <tr>
            <td>
                <!-- 수정 폼 -->
                <form action="update_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">수정</button>
                </form>
            </td>
            <td>
                <!-- 삭제 폼 -->
                <form action="delete_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>

    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
