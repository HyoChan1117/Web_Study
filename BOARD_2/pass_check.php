<?php
// 데이터베이스 연결
include("db_connect.php");

// id 가져오기
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// id를 가져오지 못했을 경우
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// POST값 가져오기
$password = isset($_POST['password']) ? $_POST['password'] : "";

// 쿼리 실행(SELECT)
$sql = "SELECT password FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// 쿼리 실행 시 문제가 발생했을 경우
if (!$result) {
    header("Refresh: 2; URL='pass_check.php?id=$id'");
    echo "문제가 발생했습니다. 사용자 확인 페이지로 이동합니다.";
    exit();
}
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요." required> <button>확인</button></p>
    </form>
    <!-- 비밀번호가 일치할 경우 -->
    <?php if ($row['password'] == $password): ?>
        <p><button><a href='update.php?id=<?php echo $id; ?>'>수정</a></button>
        <button><a href='delete.php?id=<?php echo $id; ?>'>삭제</a></button></p>
        
    <!-- POST로 받은 값이 빈 값일 때 -> 처음 실행 -->
     <?php elseif (empty($password)): ?>
        <p>사용자 확인 후 수정 or 삭제 가능</p>
    <!-- 비밀번호가 일치하지 않을 경우 -->
     <?php else: ?>
        <p>비밀번호가 일치하지 않습니다. 다시 입력하세요.</p>
    <!-- 조건문 종료 -->
     <?php endif; ?>

    <hr>
    <p>게시글로 돌아가시겠습니까? <a href='read.php?id=<?php echo $id; ?>'>돌아가기</a></p>
</body>
</html>