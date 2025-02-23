<?php
include 'header.php';
include 'db_connect.php';

// 검색어 및 검색 타입 처리
$search_type = isset($_GET['search_type']) ? $_GET['search_type'] : "subject"; // 기본값: 제목 검색
$search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : "";

// 페이지 처리
$limit = 5;  // 한 페이지에 표시할 게시글 개수
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // 현재 페이지 (기본값: 1)
$offset = ($page - 1) * $limit; // SQL OFFSET 계산

// 검색 조건 설정
$where = "";
if (!empty($search_query)) {
    $where = "WHERE $search_type LIKE '%$search_query%'";
}

// 전체 게시글 개수 조회
$totalQuery = "SELECT COUNT(*) AS total FROM board $where";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];
$totalPages = ceil($total / $limit); // 전체 페이지 수 계산

// 게시글 조회 (페이징 적용)
$sql = "SELECT id, name, subject, created_at FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
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

    <!-- 검색 폼 -->
    <form action="list.php" method="get">
        <select name="search_type">
            <option value="subject" <?= $search_type == "subject" ? "selected" : "" ?>>제목</option>
            <option value="content" <?= $search_type == "content" ? "selected" : "" ?>>내용</option>
        </select>

        <input type="search" name="search_query" value="<?= $search_query ?>" placeholder="검색어 입력">
        <button type="submit">검색</button>
    </form>

    <br>

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
            echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
    </table>

    <br>

    <!-- 페이징 -->
    <div>
        <?php if ($totalPages > 1): ?>
            <?php
            $pagesPerBlock = 5; // 한 번에 표시할 페이지 개수
            $currentBlock = ceil($page / $pagesPerBlock); // 현재 블록 번호
            $startPage = ($currentBlock - 1) * $pagesPerBlock + 1; // 블록의 시작 페이지
            $endPage = min($startPage + $pagesPerBlock - 1, $totalPages); // 블록의 마지막 페이지
            ?>

            <!-- 처음 페이지 버튼 -->
            <?php if ($page > 1): ?>
                <a href="?search_type=<?= $search_type ?>&search_query=<?= $search_query ?>&page=1"><<</a>
            <?php endif; ?>

            <!-- 이전 블록 이동 -->
            <?php if ($startPage > 1): ?>
                <a href="?search_type=<?= $search_type ?>&search_query=<?= $search_query ?>&page=<?= $startPage - 1 ?>"><</a>
            <?php endif; ?>

            <!-- 페이지 번호 출력 -->
            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <?php if ($i == $page): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>
                    <a href="?search_type=<?= $search_type ?>&search_query=<?= $search_query ?>&page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- 다음 블록 이동 -->
            <?php if ($endPage < $totalPages): ?>
                <a href="?search_type=<?= $search_type ?>&search_query=<?= $search_query ?>&page=<?= $endPage + 1 ?>">></a>
            <?php endif; ?>

            <!-- 마지막 페이지 버튼 -->
            <?php if ($page < $totalPages): ?>
                <a href="?search_type=<?= $search_type ?>&search_query=<?= $search_query ?>&page=<?= $totalPages ?>">>></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <br>
    <button><a href="insert.php">글쓰기</a></button>
</body>
</html>

<?php
$conn->close();
?>
