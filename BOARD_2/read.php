<?php
// 데이터베이스 연결
include("db_connect.php");

// id 가져오기
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// id를 못 가져왔을 때
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// 쿼리 실행(SELECT)
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 상세보기</title>
</head>
<body>
    <h3>게시판 > 상세보기</h3>
    <h3><?php echo $row['subject']; ?></h3>
    <p><strong>작성자:</strong> <?php echo $row['name']; ?></p>
    <p><strong>작성일:</strong> <?php echo $row['created_at']; ?></p>
    <br>
    <p><?php echo $row['content']; ?></p>
    <br>
    <p><button><a href='pass_check.php?id=<?php echo $id; ?>'>편집</a></button></p>
    <hr>
    <p>게시판 목록으로 돌아가시겠습니까? <a href='list.php'>돌아가기</a></p>
</body>
</html>