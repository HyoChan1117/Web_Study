<?php
    include "./db_connect.php";
    include "./header.php";

    // sql문 작성
    $query = "SELECT * FROM list";

    // 쿼리 실행
    $result = $db_conn->query($query);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>
    <h1>게시판 > 목록</h1>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>내용</th>
            <th>작성일</th>
        </tr>
        <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>$row[no]</td>";
                echo "<td>$row[name]</td>";
                echo "<td><a href='read.php?id=$row[no]'>$row[subject]</a></td>";
                echo "<td>$row[content]</td>";
                echo "<td>$row[created_at]</td>";
                echo "</tr>";
            }

            // 데이터베이스 종료
            $db_conn->close();
        ?>
        
    </table>
    <button><a href="insert.php">글쓰기</a></button>
</body>
</html>