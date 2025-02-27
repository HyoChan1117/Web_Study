<?php
// 데이터베이스 연결 파일을 포함
include("db_connect.php");

// GET 요청에서 id 값을 받아옴, 숫자로 변환 (intval 사용)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// id가 0 이하일 경우 잘못된 접근 처리
if ($id <= 0) {
    die("잘못된 접근입니다.");
}

// 데이터베이스에서 해당 id의 게시글을 가져오는 SQL 쿼리 작성
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// 게시글이 존재하지 않을 경우 오류 메시지 출력 후 종료
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
        /* 댓글 스타일: 댓글 구분선 추가 */
        .comment {
            border-bottom: 1px solid #ccc; /* 댓글 하단에 회색 선을 추가해서 댓글 구분 */
            padding: 10px;                /* 댓글 내부 여백 */
            margin-bottom: 5px;           /* 댓글 간격 추가 */
        }
        /* 대댓글 스타일: 들여쓰기 및 왼쪽 테두리 추가 */
        .reply {
            margin-left: 30px;            /* 대댓글 왼쪽으로 들여쓰기(30px) */
            border-left: 3px solid #ddd;  /* 왼쪽에 연한 회색 굵은 선 추가 */
            padding-left: 10px;           /* 왼쪽 패딩으로 들여쓰기 효과 */
        }
    </style>
</head>
<body>
    <h3>게시판 > 상세보기</h3>

    <!-- 게시글 제목 출력 -->
    <h3><?= $row['subject'] ?></h3>

    <!-- 작성자 정보 표시 -->
    <p><strong>작성자</strong>: <?= $row['name'] ?></p>

    <!-- 작성일 정보 표시 -->
    <p><strong>작성일</strong>: <?= $row['created_at'] ?></p>

    <!-- 첨부 파일이 있을 경우 다운로드 링크 제공 -->
    <?php if (!empty($row['saved_file'])) : ?>
        <p><strong>첨부 파일:</strong> 📄 
            <a href="uploads/<?= $row['saved_file'] ?>" download>
                <?= $row['original_file'] ?>
            </a>
        </p>
    <?php endif; ?>

    <br>

    <!-- 게시글 본문 표시, nl2br()을 사용하여 개행 유지 -->
    <p><?= nl2br($row['content']) ?></p>

    <br>

    <!-- 게시글 편집 버튼 -->
    <button><a href="pass_check.php?id=<?= $id ?>">편집</a></button>

    <hr>

    <h4>댓글 작성</h4>

    <!-- 댓글 입력 폼 -->
    <form action="comment_process.php" method="post">
        <!-- 게시글 ID를 hidden 필드로 포함 -->
        <input type="hidden" name="post_id" value="<?= $id ?>">
        
        <!-- 댓글 내용 입력 -->
        <p><textarea name="content" rows="5" cols="65" required></textarea></p>
        
        <!-- 작성자 이름과 비밀번호 입력 -->
        <p>이름: <input type="text" name="name" required> 
           비밀번호: <input type="password" name="password" required>
        </p>
        
        <!-- 댓글 작성 버튼 -->
        <button type="submit">작성</button>
    </form>

    <h4>댓글</h4>

    <?php
    // 해당 게시글의 댓글을 가져오는 SQL 쿼리 (작성일 기준 오름차순 정렬)
    $sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at ASC";
    $result = $conn->query($sql);

    // 댓글을 부모-자식 구조로 정리할 배열 생성
    $comments = [];

    // 댓글 데이터를 하나씩 가져와서 배열에 저장
    while ($comment = $result->fetch_assoc()) {
        // 부모 댓글일 경우
        if ($comment['parent_id'] == null) {
            $comments[$comment['id']] = $comment;
            $comments[$comment['id']]['replies'] = []; // 대댓글 저장을 위한 배열 생성
        } else {
            // 대댓글이면 부모 댓글 배열에 추가
            $comments[$comment['parent_id']]['replies'][] = $comment;
        }
    }
    ?>

    <!-- 댓글 출력 -->
    <?php foreach ($comments as $parent) : ?>
        <div class="comment">
            <!-- 부모 댓글 정보 출력 -->
            <p><strong><?= $parent['name'] ?></strong> 
               (<?= $parent['created_at'] ?>)
            </p>
            <p><?= nl2br($parent['content']) ?></p>

            <!-- 댓글 삭제 폼 -->
            <form action="comment_delete.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="comment_id" value="<?= $parent['id'] ?>">
                <p>비밀번호 입력 후 삭제: 
                   <input type="password" name="password" required>
                   <button type="submit">삭제</button>
                </p>
            </form>

            <hr>

            <!-- 대댓글 입력 폼 -->
            <strong>▶ 대댓글 작성</strong>
            <form action="comment_process.php" method="post" style="margin-left: 20px;">
                <input type="hidden" name="post_id" value="<?= $id ?>">
                <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
                <p><textarea name="content" rows="5" cols="65" required></textarea></p>
                <p>이름: <input type="text" name="name" required> 
                   비밀번호: <input type="password" name="password" required>
                </p>
                <button type="submit">작성</button>
            </form>

            <!-- 대댓글 목록 표시 -->
            <?php foreach ($parent['replies'] as $reply) : ?>
                <div class="comment reply">
                    <!-- 대댓글 정보 출력 -->
                    <p><strong><?= $reply['name'] ?></strong> 
                       (<?= $reply['created_at'] ?>)
                    </p>
                    <p><?= nl2br($reply['content']) ?></p>

                    <!-- 대댓글 삭제 폼 -->
                    <form action="comment_delete.php" method="post">
                        <input type="hidden" name="comment_id" value="<?= $reply['id'] ?>">
                        <p>비밀번호 입력 후 삭제: 
                           <input type="password" name="password" required>
                           <button type="submit">삭제</button>
                        </p>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endforeach; ?>

    <!-- 게시판 목록으로 돌아가는 링크 -->
    <p>게시판 목록으로 돌아가시겠습니까? 
        <a href="list.php">돌아가기</a>
    </p>
</body>
</html>
