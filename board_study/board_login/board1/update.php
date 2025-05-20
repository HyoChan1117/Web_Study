<?php
include("header.php");

// 데이터베이스 연결
include("db_connect.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT name, subject, content FROM board WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "게시글이 존재하지 않습니다.";
        exit;
    }
} else {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <h3>게시판 > 게시글 수정</h3>
    <table>
        <tr>
            <form action="update_process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p>이름: <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="이름을 입력하세요." required></p>
                <p>제목: <input type="text" name="subject" value="<?php echo $row['subject']; ?>" placeholder="제목을 입력하세요." required></p>
                내용:<br>
                <textarea name="content" rows="5" cols="30" placeholder="내용을 입력하세요." required><?php echo $row['content']; ?></textarea><br>
                <button type="submit">수정</button>
            </form>
            <form action="list.php" method="get">
                <button type="subject">취소</button>
            </form>
        </tr>
    </table>
</body>
</html>
