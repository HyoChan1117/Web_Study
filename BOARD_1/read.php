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
} else {
    die("해당 게시글이 없습니다.");
}
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
    <p><strong>작성자</strong>: <?php echo $row['name']; ?></p>
    <p><strong>작성일</strong>: <?php echo $row['created_at']; ?></p>
    <br>
    <p><?php echo nl2br($row['content']); ?></p>

    <?php
    // 업로드한 파일이 있을 경우
    if (!empty($row['saved_file'])) {
        $file_path = "uploads/" . $row['saved_file'];
        $file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $allowed_image_types = ['jpg', 'jpeg', 'png', 'gif'];

        echo "<hr><h4>첨부 파일</h4>";

        // 이미지 파일인 경우 직접 표시
        if (in_array($file_ext, $allowed_image_types)) {
            echo "<img src='$file_path' alt='첨부 이미지' style='max-width:500px; display:block; margin-bottom:10px;'>";
        }

        // 파일 다운로드 링크 제공
        echo "<p><a href='$file_path' download>파일 다운로드: " . $row['original_file'] . "</a></p>";
    }
    ?>

    <button><a href='pass_check.php?id=<?php echo $id ?>'>편집</a></button>
    <br><hr>
    <p>게시판 목록으로 돌아가시겠습니까? <a href='list.php'>돌아가기</a></p>
</body>
</html>
