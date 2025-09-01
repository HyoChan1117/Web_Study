<?php

    // 검색 타입, 쿼리 유효성 검사
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

    $where = '';
    // 검색 쿼리가 비어있지 않을 경우
    if (!empty($search_query)) {
        $where = "WHERE $search_type LIKE '%$search_query%'";
    }

    try {
        // 데이터베이스 연결
        require_once './db_connect.php';

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board $where ORDER BY created_at DESC";

        // 쿼리 실행
        $result = $db_conn->query($sql);
    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 사용자 정보 출력
    require_once './header.php';
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
    입력값: 검색타입(search_type) - 제목(title), 내용(content)
           검색쿼리(search_query)

    <table>
    번호 작성자 제목 작성일 수정일
    </table>

    글쓰기 버튼 활성화
    -->

    <h1>게시판 목록</h1>

    <form action="index.php" method="get">
        <select name="search_type">
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>

        <input type="search" name="search_query">

        <button>검색</button>
    </form>

    <table border='1'>
        <tr>
            <td><strong>번호</strong></td>
            <td><strong>작성자</strong></td>
            <td><strong>제목</strong></td>
            <td><strong>작성일</strong></td>
            <td><strong>수정일</strong></td>
        </tr>

        <?php
            // 게시물이 있을 경우
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$row[id]</td>";
                    echo "<td>$row[name]</td>";
                    echo "<td><a href='read.php?id=$row[id]'>$row[title]</a></td>";
                    echo "<td>$row[created_at]</td>";
                    echo "<td>$row[updated_at]</td>";
                    echo "</tr>";
                }
            } else {   // 게시물이 없을 경우
                echo "<tr>";
                echo "<td colspan='5'>게시물이 없습니다.</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <?php
        if ($account != 'GUEST') {
            echo "<button onclick=location.href='insert.php'>글쓰기</button>";
        }
    ?>
</body>
</html>