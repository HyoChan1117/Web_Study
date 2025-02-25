<?php
// 데이터베이스 연결
include("db_connect.php");

// 페이지네이션
$limit = 5;


// 쿼리 실행(SELECT)
$sql = "SELECT * FROM board ORDER BY created_at";
$result = $conn->query($sql);
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
    <p><button><a href='insert.php'>글쓰기</a></button></p>
</body>
</html>