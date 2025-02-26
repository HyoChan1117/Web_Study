<?php
include 'header.php';
include 'db_connect.php';

// 페이지 처리
$limit = 5;  // 한 페이지에 표시할 게시글 개수
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // 현재 페이지 (기본값: 1)
$offset = ($page - 1) * $limit; // SQL OFFSET 계산

// 전체 게시글 개수 조회
$totalQuery = "SELECT COUNT(*) AS total FROM board";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];
$totalPages = ceil($total / $limit); // 전체 페이지 수 계산

// 게시글 조회 (페이징 적용)
$sql = "SELECT id, name, subject, created_at FROM board ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 리스트</title>
</head>
<body>
    <h3>게시판 > 리스트</h3>

    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td><a href='read.php?id={$row['id']}'>{$row['subject']}</a></td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
        ?>
    </table>

    <br>

    <!-- 페이징 -->
    <div>
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">이전</a>
        <?php endif; ?>

        <strong><?= $page ?></strong>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">다음</a>
        <?php endif; ?>
    </div>

    <br>
    <button><a href="insert.php">글쓰기</a></button>
</body>
</html>

<?php
$conn->close();
?>
