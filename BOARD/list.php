<?php
include 'header.php';

$servername = "localhost";
$username = "hyochan";  // 본인의 MySQL 계정명
$password = "40957976";  // 본인의 MySQL 비밀번호
$database = "board_login";  // 사용할 데이터베이스

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 게시글 가져오기
$sql = "SELECT id, name, subject, created_at  FROM board ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 리스트</title>
</head>
<body>
    <h3>게시판 > 리스트</h3>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
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
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
        ?>
    </table>
    <br>
    <form action="insert.php" method="post">
        <button type="submit">글쓰기</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>