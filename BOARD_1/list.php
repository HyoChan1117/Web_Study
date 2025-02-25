<?php
// 데이터베이스 연결
include("db_connect.php");

// 쿼리 실행
$sql = "SELECT * FROM board ORDER BY created_at";  // SELECT로 데이터를 읽어옴 -> 객체로 저장장
$result = $conn->query($sql);  // $sql을 쿼리로 실행
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>
    <h3>게시판 > 리스트</h3>
    <!-- 테이블 생성 -->
    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>생성일자</th>
        </tr>

        <tr>
            <?php
            // 행이 있을 경우
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td><a href='read.php?id={$row['id']}'>{$row['subject']}</a></td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<tr>";
                }
            }
            // 행이 없을 경우
            else {
                echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
            }
            ?>
        </tr>
    </table>
    <br>
    <button><a href='insert.php'>글쓰기</a></button>
</body>
</html>