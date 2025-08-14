<?php

    // 페이지네이션
    $limit = 5;
    $page = isset($_GET['page']) ? trim($_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    // 검색 타입, 쿼리 설정
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // 검색 조건 설정
    $where = '';

    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT) - 게시판 출력
        $sql = "SELECT * FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // 게시글 전체 개수 구하기
        // sql문 작성 (SELECT)
        $totalSql = "SELECT COUNT(*) AS total FROM board $where";

        // 쿼리 실행
        $totalResult = $db_conn->query($totalSql);
        $totalRow = $totalResult->fetch_assoc();
        $total = $totalRow['total'];

    } catch (Exception $e) {
        // 데이터베이스 관련 오류 시
        // DB 오류 메시지 출력
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 전체 페이지 개수
    $totalPages = ceil($total / $limit);

    // 블록
    $pagesPerBlock = 5;   // 블록 당 페이지 개수
    $currentBlock = ceil($page / $pagesPerBlock);    // 현재 블록
    $startPage = ($currentBlock - 1) * $pagesPerBlock + 1;    // 현재 블록의 시작 페이지
    $endPage = min($currentBlock * $pagesPerBlock, $totalPages);     // 현재 블록의 마지막 페이지

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>
    <!--
    게시판 목록

    검색 기능 활성화 (검색 타입, 검색창)

    번호 작성자 제목 작성일, 수정일
    ~

    글쓰기 버튼 활성화 -> insert.php

    페이지네이션 활성화
    -->
    <h1>게시판 목록</h1>

    <form action="index.php">
        <select name="search_type">
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>

        <input type="search" name="search_query">

        <button>검색</button>
    </form>

    <br>

    <table border="1">
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성일</th>
            <th>수정일</th>
        </tr>

        <?php
            while ($row = $result->fetch_assoc()) {
                // 게시글 번호 세기
                $count = $total - $offset;

                echo "<tr>";
                echo "  <td>$count</td>";
                echo "  <td>$row[name]</td>";
                echo "  <td>$row[title]</td>";
                echo "  <td>$row[created_at]</td>";
                echo "  <td>$row[updated_at]</td>";
                echo "</tr>";

                $total -= 1;
            }
        ?>
    </table>

    <button>글쓰기</button><br>

    <?php

        // 이전 블록 이동하기
        $prevBlock = $startPage - 1;

        // 현재 블록이 1이 아닐 경우 출력
        // 1페이지 이동 "<<"
        // 이전 블록 이동 "<"
        if ($currentBlock != 1) {
            echo "<a href='?page=1&search_type=$search_type&search_query=$search_query'><<</a> ";
            echo "<a href='?page=$prevBlock&search_type=$search_type&search_query=$search_query'><</a> ";
        }

        // 페이지네이션
        // 현재 페이지는 진하게 표시 -> $i == $page
        // 블록 당 페이지 개수 -> $pagesPerBlock = 5;
        for ($i = $startPage ; $i <= $endPage ; $i++) {
            if ($i == $page) {
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'><strong>$i</strong></a> ";
            } else {
                echo "<a href='?page=$i&search_type=$search_type&search_query=$search_query'>$i</a> ";
            }
        }

        // 다음 블록 이동하기
        $nextBlock = $endPage + 1;

        // 마지막 페이지와 전체 페이지의 수가 일치하지 않을 경우 출력
        // 다음 블록 이동 ">"
        // 마지막 페이지 이동 ">>"        
        if ($endPage != $totalPages) {
            echo "<a href='?page=$nextBlock&search_type=$search_type&search_query=$search_query'>></a> ";
            echo "<a href='?page=$totalPages&search_type=$search_type&search_query=$search_query'>>></a> ";
        }
    ?>
</body>
</html>