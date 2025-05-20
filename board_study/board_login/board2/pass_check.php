<?php
// 데이터베이스 연결
include("db_connect.php");

// id 값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// id 값이 없을 경우
if ($id == 0) {
    die("해당 게시글이 없습니다.");
}

// POST 가져오기
$password = isset($_POST['password']) ? $_POST['password'] : "";

// 쿼리 실행(읽기)
$sql = "SELECT password FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 확인</title>
</head>
<body>
    <h3>게시판 > 상세보기 > 사용자 확인</h3>
    <form action="pass_check.php?id=<?php echo $id; ?>" method="post">
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요." required> <button>확인</button></p>
    </form>
    <?php if ($row['password'] == $password): ?>
        <button><a href='update.php?id=<?php echo $id; ?>'>수정</a></button> <button><a href='delete.php?id=<?php echo $id; ?>'>삭제</a></button>
    <?php elseif (empty($password)): ?>
        <p>편집을 위해서는 사용자 확인이 필요합니다.</p>
    <?php else: ?>
        <p>비밀번호를 다시 입력하세요.</p>
    <?php endif; ?>
    <hr>
    <p>게시글로 돌아가시겠습니까? <a href='read.php?id=<?php echo $id; ?>'>돌아가기</a></p>
</body>
</html>