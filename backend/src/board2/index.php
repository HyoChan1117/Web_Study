<?php

    // 세션 변수 불러오기
    require_once './header.php';

    // 페이지네이션
    // limit, page, offset
    $limit = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * 4;

    // 검색 기능
    // 검색 타입: 제목(기본), 내용
    // 검색 쿼리: null(기본) - trim 처리
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

    // 검색 쿼리가 비어있지 않을 경우 -> 검색 결과 반영
    // WHERE $search_type LIKE '%$search_query%'
    $where = '';

    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }
    
    // 데이스베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);
        
        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board $where LIMIT $limit OFFSET $offset";

        // 쿼리 실행
        $result = $db_conn->query($sql);

        // sql문 작성 (SELECT COUNT(*))
        $total_sql = "SELECT COUNT(*) total FROM board";
        $total_result = $db_conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total = $total_row['total'];  // 전체 게시글 수
        $total_page = ceil($total / $limit);   // 전체 페이지 수

        // 페이지 블록
        $pagePerBlock = 5;   // 한 블럭 당 페이지 수
        $currentBlock = ceil($page / $pagePerBlock);    // 현재 블럭
        $startPage = ($currentBlock - 1) * $pagePerBlock + 1;   // 시작 페이지
        $endPage = min($currentBlock * $pagePerBlock, $total_page);   // 끝 페이지

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

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

    FORM
    Action: index.php
    Method: get
    검색타입 검색쿼리 검색버튼
    현재 검색어: $search_query($search_type)

    <table>
    번호 작성자 제목 작성시간 수정시간
    if 게시물이 없다면 -> 게시물이 없습니다.
    </table>

    페이지네이션
    << < 1 2 3 4 5 > >>

    글쓰기 버튼 활성화 -> insert.php
    -->

    <h1>게시판 목록</h1>

    <form action="index.php" method='get'>
        <select name="search_type">
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>
        <input type="search" name="search_query" value="하루나">

        <button>검색</button>
    </form>

    <?php

        // 검색쿼리가 있을 경우
        // 현재 검색어(검색타입) 표시
        if (!empty($search_query)) {
            echo "현재 검색어(타입): $search_query($search_type)";
        }

    ?>
    
    <table border='1'>
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성시간</th>
            <th>수정시간</th>
        </tr>

        <?php
            
            // 게시물이 없다면
            if ($result->num_rows <= 0) {
                echo "<tr>";
                echo "<td colspan='5'>게시물이 없습니다.</td>";
                echo "</tr>";
            }

            // 게시물이 있다면
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "    <td>$row[id]</td>";
                echo "    <td>$row[name]</td>";
                echo "    <td><a href='read.php?id=$row[id]'>$row[title]</a></td>";
                echo "    <td>$row[created_at]</td>";
                echo "    <td>$row[updated_at]</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php

        $previousPage = $startPage - $pagePerBlock;

        // << <
        if ($currentBlock != 1) {
            echo "<a href='index.php?page=1'><<</a> ";
            echo "<a href='index.php?page=$previousPage'><</a> ";
        }
        
        // 페이지
        for ($i = $startPage ; $i <= $endPage ; $i++) {
            if ($i == $page) {
                echo "<a href='index.php?page=$i'><strong>$i</strong></a> ";
            } else {
                echo "<a href='index.php?page=$i'>$i</a> ";
            }
        }

        $nextPage = $endPage + 1;

        // > >>
        if (ceil($total_page / $pagePerBlock) != $currentBlock) {
            echo "<a href='index.php?page=$nextPage'>></a> ";
            echo "<a href='index.php?page=$total_page'>>></a> ";
        }

    ?>
    <br>

    <button><a href="insert.php">글쓰기</a></button>

</body>
</html>