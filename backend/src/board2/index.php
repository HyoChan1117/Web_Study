<?php

    // 세션 변수 불러오기
    require_once './header.php';

    // 검색 기능
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'title';
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // 검색 조건
    $where = "WHERE $search_type LIKE '%$search_query%'";
    
    // 데이스베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);
        
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

    검색타입 검색창 검색버튼

    <table>
    번호 작성자 제목 작성시간 수정시간
    if 게시물이 없다면 -> 게시물이 없습니다.
    </table>

    글쓰기 버튼 활성화 -> insert.php
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

    <button><a href="insert.php">글쓰기</a></button>

</body>
</html>