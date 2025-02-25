<?php
// 데이터베이스 연결
include("db_connect.php");

// 게시글 id 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("잘못된 접근입니다.");
}

// 쿼리 실행
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
else {
    echo "해당 게시글이 없습니다";
}
    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 수정</title>
</head>
<body>
    <h3>게시판 > 상세보기 > 수정</h3>
    <form action="update_process.php" method="post">
        <p>이름: <input type="text" name="name" placeholder="이름을 입력하세요." value="<?php echo $row['name']; ?>" required></p>
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요." value="<?php echo $row['password']; ?>" required></p>
    </form>
    
</body>
</html>