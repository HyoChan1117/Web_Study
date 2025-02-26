<?php
// 데이터베이스 연결
include("db_connect.php");

// id값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// id값을 가져오지 못했을 경우
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// 쿼리 실행(SELECT)
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// 쿼리 실행 중 문제가 발생했을 경우
if (!$row) {
    die("쿼리 실행 중 문제가 발생했습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <h3>게시판 > 상세보기 > 수정</h3>
    <form action="update_process.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <p>이름: <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="이름을 입력하세요." required></p>
        <p>비밀번호: <input type="password" name="password" value="<?= $row['password'] ?>" placeholder="비밀번호를 입력하세요." required></p>
        <p>제목: <input type="text" name="subject" value="<?php echo $row['subject']; ?>" placeholder="제목을 입력하세요." required></p>
        <p>내용:</p>
        <p><textarea name="content" rows="5" cols="30" placeholder="내용을 입력하세요." required><?php echo $row['content']; ?></textarea></p>

        <!-- 기존 파일 표시 -->
        <?php if (!empty($row['saved_file'])): ?>
            <p>첨부파일: 📄<a href="uploads/<?php echo $row['saved_file']; ?>" download><?php echo $row['original_file']; ?></a></p>
        <?php endif; ?>

        <!-- 파일 업로드 필드 추가 -->
        <p><input type="file" name="file"></p>
        <br>
        <button>수정</button> <button type="reset">초기화</button>
    </form>
    <hr>
    <p>게시글로 돌아가시겠습니까? <a href="read.php?id=<?php echo $id; ?>">돌아가기</a></p>
</body>
</html>
