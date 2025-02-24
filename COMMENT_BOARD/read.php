<?php
include("header.php");

$servername = "localhost";
$username   = "hyochan";
$password   = "40957976";
$database   = "board_login";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("잘못된 접근입니다. ID가 유효하지 않습니다.");
}

$sql = "SELECT id, name, subject, content, file, created_at FROM board WHERE id = ?";
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
    <p><?php echo $row['content']; ?></p>
    <?php if (!empty($row['file'])): ?>
        <p>첨부파일: <a href="<?php echo $row['file']; ?>" download><?php echo basename($row['file']); ?></a></p>
    <?php endif; ?>
    
    <table>
        <tr>
            <td>
                <form action="update_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">수정</button>
                </form>
            </td>
            <td>
                <form action="delete_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>
    
    <hr>
    <h4>댓글</h4>
    <?php
    $sql_comments = "SELECT id, name, content, created_at FROM board WHERE name = ? ORDER BY created_at ASC";
    $stmt = $conn->prepare($sql_comments);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result_comments = $stmt->get_result();
    
    if ($result_comments->num_rows > 0) {
        while ($comment = $result_comments->fetch_assoc()) {
            echo '<div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">';
            echo '<p><strong>' . $comment['name'] . '</strong> (' . $comment['created_at'] . ')</p>';
            echo '<p>' . $comment['content'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>댓글이 없습니다.</p>";
    }
    $stmt->close();
    ?>
    
    <h4>댓글 작성</h4>
    <form action="comment_process.php" method="post">
        <input type="hidden" name="board_id" value="<?php echo $id; ?>">
        이름: <input type="text" name="name" placeholder="이름을 입력하세요" required><br><br>
        비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요" required><br><br>
        댓글 내용: <br>
        <textarea name="content" rows="4" cols="50" placeholder="댓글을 입력하세요" required></textarea><br><br>
        <button type="submit">댓글 등록</button>
    </form>
    
    <br>
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
    
    <?php $conn->close(); ?>
</body>
</html>
