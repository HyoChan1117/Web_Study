<?php
// 데이터베이스 연결
include("db_connect.php");

// 검색 유형 및 검색어 처리
$search_type = isset($_GET['search_type']) ? $_GET['search_type'] : "subject";  // 검색 유형 선택 (기본: 제목)
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : "";  // 검색어 (기본: 빈 문자열)

// 검색 조건 설정
$where = "";
if (!empty($search_query)) {
    $where = "WHERE $search_type LIKE '%$search_query%'";
}

// 페이지 표시 처리
$limit = 5;  // 한 페이지에 표시할 게시글 개수
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 현재 페이지 (기본: 1페이지)
$offset = ($page - 1) * $limit;  // 페이지 당 첫 게시글 인덱스 번호

// 전체 페이지 수
$totalSql = "SELECT COUNT(*) AS total FROM board $where";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$total = $totalRow['total'];
$totalPage = ceil($total / $limit);

// 쿼리 실행(SELECT)
$sql = "SELECT * FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// 블록 처리
$pagesPerBlock = 5;
$currentBlock = ceil($page / $pagesPerBlock);
$startPage = ($currentBlock - 1) * $pagesPerBlock + 1; // 각 블록에서 가장 첫번째 페이지
$endPage = min($currentBlock * $pagesPerBlock, $totalPage) // 각 블록에서 가장 마지막 페이지, $totalPages를 사용하는 이유는 마지막 게시글이 있는 페이지를 구하기 위함
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>
    <h3>게시판 > 목록</h3>
    <form action="list.php" method="get">
        <select name="search_type">
            <option value="subject" <?= $search_type == "subject" ? "selected" : "" ?>>제목</option>
            <option value="content" <?= $search_query == "content" ? "selected" : "" ?>>내용</option>
        </select>

        <input type="search" name="search_query" value="<?= $search_query ?>" placeholder="검색어 입력">

        <button>확인</button>
    </form>

    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>생성일자</th>
        </tr>

        <tr>
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
            }
            else {
                echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
            }
            ?>
        </tr>
    </table>
    <div>
        <!-- 블록 시작 페이지가 1보다 클 때 -->
        <?php if ($startPage > 1): ?>
            <a href="?page=1"><<</a>
            <a href="?page=<?= $startPage - $pagesPerBlock ?>"><</a>
        <?php endif; ?>

        <!-- 페이지 내비게이션바 -->
        <?php for ($i = $startPage ; $i <= $endPage ; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $page ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- 블록 끝 페이지가 전체 페이지 보다 작을 때 -->
        <?php if ($endPage < $totalPage): ?>
            <a href="?page=<?= $endPage + 1 ?>">></a>
            <a href="?page=<?= $totalPage ?>">>></a>
        <?php endif; ?>
    </div>
    <p><button><a href='insert.php'>글쓰기</a></button></p>
</body>
</html>