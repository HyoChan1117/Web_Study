<?php
// 데이터베이스 연결
include("db_connect.php");

// 게시글 id 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("잘못된 접근입니다.");
}

// 게시글 가져오기
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    die("해당 게시글이 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 상세보기</title>
    <style>
        .comment {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 5px;
        }
        .reply {
            margin-left: 30px; /* 대댓글 들여쓰기 */
            border-left: 3px solid #ddd;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <h3>게시판 > 상세보기</h3>
    <h3><?= $row['subject'] ?></h3>
    <p><strong>작성자</strong>: <?= $row['name'] ?></p>
    <p><strong>작성일</strong>: <?= $row['created_at'] ?></p>
    <!-- 첨부 파일 다운로드 링크 -->
    <?php
    if (!empty($row['saved_file'])) {
        $file_path = "uploads/" . $row['saved_file'];
        echo "<p><strong>첨부 파일:</strong> 📄 <a href='$file_path' download>{$row['original_file']}</a></p>";
    }
    ?>
    <br>
    <p><?= nl2br($row['content']) ?></p>

    
    
    <br>
    <button><a href='pass_check.php?id=<?= $id ?>'>편집</a></button>
    <hr>

    <h4>댓글 작성</h4>

    <!-- 댓글 입력 폼 -->
    <form action="comment_process.php" method="post">
        <input type="hidden" name="post_id" value="<?= $id ?>">
        <p><textarea name="content" rows="5" cols="65" required></textarea></p>
        <p>이름: <input type="text" name="name" required> 비밀번호: <input type="password" name="password" required></p>
        <button type="submit">작성</button>
    </form>

    <h4>댓글</h4>

    <!-- 댓글 목록 표시 -->
    <?php
    // 댓글 가져오기 (오름차순 정렬)
    $sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at ASC";
    $result = $conn->query($sql);

    // 부모 댓글과 자식 댓글을 그룹화
    $comments = [];
    while ($comment = $result->fetch_assoc()) {
        if ($comment['parent_id'] == null) {
            $comments[$comment['id']] = $comment;
            $comments[$comment['id']]['replies'] = [];
        } else {
            $comments[$comment['parent_id']]['replies'][] = $comment;
        }
    }

    // 댓글 출력
    foreach ($comments as $parent) {
        echo "<div class='comment'>";
        echo "<p><strong>{$parent['name']}</strong> ({$parent['created_at']})</p>";
        echo "<p>{$parent['content']}</p>";

        // 댓글 삭제 폼 추가
        echo "<form action='comment_delete.php' method='post'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='comment_id' value='{$parent['id']}'>";
        echo "<p>비밀번호 입력 후 삭제: <input type='password' name='password' required> ";
        echo "<button type='submit'>삭제</button></p>";
        echo "</form>";

        echo "<hr>";

        // 대댓글 입력 폼 (항상 표시)
        echo "▶ <strong>대댓글 작성</strong>";
        echo "<form action='comment_process.php' method='post' style='margin-left: 20px;'>";
        echo "<input type='hidden' name='post_id' value='{$id}'>";
        echo "<input type='hidden' name='parent_id' value='{$parent['id']}'>";
        echo "<p><textarea name='content' rows='5' cols='65' required></textarea></p>";
        echo "<p>이름: <input type='text' name='name' required> 비밀번호: <input type='password' name='password' required></p>";
        echo "<button type='submit'>작성</button>";
        echo "</form>";

        // 대댓글 출력
        foreach ($parent['replies'] as $reply) {
            echo "<div class='comment reply'>";
            echo "<p><strong>{$reply['name']}</strong> ({$reply['created_at']})</p>";
            echo "<p>{$reply['content']}</p>";

            // 대댓글 삭제 폼 추가
            echo "<form action='comment_delete.php' method='post'>";
            echo "<input type='hidden' name='comment_id' value='{$reply['id']}'>";
            echo "<p>비밀번호 입력 후 삭제: <input type='password' name='password' required> ";
            echo "<button type='submit'>삭제</button></p>";
            echo "</form>";

            echo "</div>"; // 대댓글 닫기
        }

        echo "</div>"; // 부모 댓글 닫기
    }
    ?>
    
    <p>게시판 목록으로 돌아가시겠습니까? <a href='list.php'>돌아가기</a></p>
</body>
</html>
