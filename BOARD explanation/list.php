<?php
include 'header.php'; // 페이지 상단(헤더) 포함 (세션, 스타일, 공통 기능 등이 포함될 가능성이 있음)

$servername = "localhost";  // MySQL 서버 주소 (로컬 개발 환경에서는 localhost 사용)
$username = "hyochan";  // MySQL 접속 계정
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 오류 메시지 출력 후 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 게시글 목록을 가져오는 SQL 쿼리
$sql = "SELECT id, name, subject, created_at FROM board ORDER BY created_at DESC"; // 최신 글이 먼저 나오도록 정렬
$result = $conn->query($sql); // SQL 실행 및 결과 저장

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 인코딩 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹을 위한 설정 -->
    <title>게시판 리스트</title> <!-- 페이지 제목 -->
</head>
<body>
    <!-- 로그인한 사용자에게 환영 메시지를 표시하고 로그아웃 버튼 제공 -->
    <h5>환영합니다, <?php echo $_SESSION['username']; ?>님! <a href="logout.php">로그아웃</a> </h5>

    <h3>게시판 > 리스트</h3>

    <!-- 게시글 목록을 표시하는 테이블 -->
    <table border="1">
        <tr>
            <th>번호</th> <!-- 게시글 ID -->
            <th>이름</th> <!-- 작성자 이름 -->
            <th>제목</th> <!-- 게시글 제목 -->
            <th>작성일</th> <!-- 작성 시간 -->
        </tr>
        
        <?php
        // 게시글이 존재하는 경우 테이블에 출력
        if ($result->num_rows > 0) {
            // 결과를 한 줄씩 가져와서 출력
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>"; // 글 번호
                echo "<td>{$row['name']}</td>"; // 작성자 이름
                // 제목을 클릭하면 해당 게시글로 이동 (`read.php?id=게시글ID`)
                echo "<td><a href='read.php?id={$row['id']}'>{$row['subject']}</a></td>"; 
                echo "<td>{$row['created_at']}</td>"; // 작성 날짜
                echo "</tr>";
            }
        } else {
            // 게시글이 없는 경우 테이블에 "게시글이 없습니다." 표시
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
        ?>
    </table>
    
    <br>

    <!-- 글쓰기 버튼 (insert.php로 이동하여 새 글 작성) -->
    <form action="insert.php" method="post">
        <button type="submit">글쓰기</button>
    </form>

</body>
</html>

<?php
// 데이터베이스 연결 종료
$conn->close();
?>
