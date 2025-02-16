<?php
include("header.php"); // 페이지의 공통 헤더를 포함 (세션, 스타일, 공통 기능 등이 포함될 가능성이 있음)

$servername = "localhost";  // MySQL 서버 주소 (보통 로컬 개발 환경에서는 localhost 사용)
$username = "hyochan";  // MySQL 접속 계정
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결 (객체 지향 방식)
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 오류 메시지 출력 후 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// GET 방식으로 전달된 게시글 ID 가져오기
// `isset($_GET['id'])`를 사용하여 `id` 값이 전달되었는지 확인
// `intval($_GET['id'])`을 사용하여 정수로 변환 (SQL Injection 방지)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ID가 0 이하인 경우 (잘못된 접근)
if ($id <= 0) {
    die("잘못된 접근입니다. ID가 유효하지 않습니다.");
}

// 게시글 조회 SQL (Prepared Statement 사용하여 SQL Injection 방지)
$sql = "SELECT id, name, subject, content, created_at FROM board WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i"는 정수를 의미
$stmt->execute();
$result = $stmt->get_result();

// 게시글이 존재하는지 확인
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // 게시글 정보를 배열로 저장
} else {
    die("게시글이 존재하지 않습니다."); // 게시글이 없는 경우 에러 메시지 출력 후 종료
}

// SQL 실행 완료 후 리소스 해제
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 인코딩 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹을 위한 설정 -->
    <title>게시글 상세 보기</title> <!-- 페이지 제목 -->
</head>
<body>
    <!-- 로그인한 사용자에게 환영 메시지를 표시하고 로그아웃 버튼 제공 -->
    <h5>환영합니다, <?php echo $_SESSION['username']; ?>님! <a href="logout.php">로그아웃</a> </h5>

    <h3>게시판 > 상세보기</h3>

    <!-- 게시글 제목 -->
    <h3><?php echo htmlspecialchars($row['subject']); ?></h3>

    <!-- 작성자 및 작성일 -->
    <p><strong>작성자:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
    <p><strong>작성일:</strong> <?php echo $row['created_at']; ?></p>
    <br>

    <!-- 게시글 내용 -->
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p><br>
    
    <!-- 수정 & 삭제 버튼을 나란히 배치 -->
    <table>
        <tr>
            <td>
                <!-- 수정 버튼: update_pass.php로 이동 (게시글 수정) -->
                <form action="update_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">수정</button>
                </form>
            </td>
            <td>
                <!-- 삭제 버튼: delete_pass.php로 이동 (게시글 삭제) -->
                <form action="delete_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>

    <hr>

    <!-- 게시판 목록으로 돌아가기 -->
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
