<?php

    // 세션 불러오기
    require_once "./header.php";

    // try
    try {
        // 데이터베이스 연결을 위한 변수 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board;";

        // 쿼리 실행
        $result = $db_conn->query($sql);
    }
    // catch (Exception $e)
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력
        echo "DB 연결 실패!<br>";
        exit;
    }

    // 데이터베이스 종료
    $db_conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
    <style>
        table {
            border: 2px black solid;
        }

        th, td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!--
    "안녕하세요! [사용자 이름]님" 출력
    로그아웃 버튼 활성화
    
    게시판 > 목록

    <Table>
    번호 작성자 제목 작성일 수정일
    ...

    글쓰기 버튼 활성화
    -->
    <h1>게시판 > 목록</h1>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성일</th>
            <th>수정일</th>
        </tr>
    <?php
        
        // 게시글 조회
        while ($row = $result->fetch_assoc()) {
            // 게시글이 있을 경우
            echo "<tr>";
            echo "  <td>$row[id]</td>";
            echo "  <td>$row[name]</td>";
            echo "  <td><a href='read.php?id=$row[id]'>$row[title]</a></td>";
            echo "  <td>$row[created_at]</td>";
            echo "  <td>$row[updated_at]</td>";
            echo "</tr>";
        }

        // 게시글이 없는 경우
        if ($result->num_rows <= 0) {
            echo "<tr>";
            echo "  <td colspan=5>게시글이 없습니다.</td>";
            echo "</tr>";
        }
    ?>
    </table>
    <br>
    <button><a href="insert.php">글쓰기</a></button>
</body>
</html>