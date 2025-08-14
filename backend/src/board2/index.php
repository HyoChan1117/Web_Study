<?php

    // 페이지네이션
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // 검색 조건
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // 검색 타입 및 검색창 조건 설정
    $where = '';
    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 실행 (SELECT) - 게시판 출력
        $sql = "SELECT * FROM board $where ORDER BY created_at DESC LIMIT $limit";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // sql문 실행 (SELECT) - 총 게시물 개수
        $sqlTotal = "SELECT COUNT(*) AS total FROM board $where";

        // 쿼리 실행
        $resultTotal = $db_conn->query($sqlTotal);
        $rowTotal = $resultTotal->fetch_assoc();
        $total = $rowTotal['total'];

    } catch (Exception $e) {
        // 데이터베이스 관련 오류 시
        // DB 오류 메시지 출력
        echo "DB 오류<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 전체 페이지 세기
    $totalPages = ceil($total / $limit);

    // 한 블럭 당 페이지 설정
    // 현재 블럭 설정
    // 블럭 시작 페이지
    // 블럭 마지막 페이지
    $pagesPerBlock = 5;
    $currentBlock = ceil($page / $pagesPerBlock);
    $startPage = ($currentBlock - 1) * $pagesPerBlock + 1;
    $endPage = min($pagesPerBlock * $currentBlock, $totalPages);


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
                // 게시물 번호
                $pagePerNum = $total - $offset;

                echo "<tr>";
                echo "  <td>$pagePerNum</td>";
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

        // 이전 블럭 이동하기
        // 1번 블럭은 출력 X
        $prevBlock = $startPage - 1;

        if ($currentBlock != 1) {
            echo "<a href='?page=1'><<</a> ";
            echo "<a href='?page=$prevBlock'><</a> ";
        }

        // 페이지네이션
        for ($i = $startPage ; $i <= $endPage ; $i++) {
            // 현재 페이지 진하게 표시
            if ($i == $page) {
                echo "<a href='?page=$i'><strong>$i</strong></a> ";
            } else {   // 나머지 페이지 약하게 표시
                echo "<a href='?page=$i'>$i</a> ";
            }
        }

        // 다음 블럭 이동하기
        // 마지막 블럭은 출력 X
        $nextBlock = $endPage + 1;

        if ($endPage != $totalPages) {
            echo "<a href=?page=$nextBlock>></a> ";
            echo "<a href=?page=$totalPages>>></a>";
        }
        
    ?>
</body>
</html>