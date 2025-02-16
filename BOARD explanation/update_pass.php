<?php
include("header.php"); // 헤더 포함 (세션 유지 및 공통 UI 요소 포함 가능)

$servername = "localhost";  // MySQL 서버 주소
$username = "hyochan";  // MySQL 계정 이름
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// URL에서 게시글 ID 가져오기 (GET 방식)
// `intval($_GET['id'])`을 사용하여 정수로 변환 (SQL Injection 방지)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 유효하지 않은 ID일 경우 경고 메시지를 띄우고 이전 페이지로 돌아감
if ($id <= 0) {
    die("<script>alert('잘못된 접근입니다.'); history.back();</script>");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 인코딩 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹 설정 -->
    <title>사용자 확인</title> <!-- 페이지 제목 -->
</head>
<body>
    <!-- 로그인한 사용자에게 환영 메시지를 표시하고 로그아웃 버튼 제공 -->
    <h5>환영합니다, <?php echo $_SESSION['username']; ?>님! <a href="logout.php">로그아웃</a> </h5>

    <h3>게시판 > 사용자 확인</h3>

    <!-- 사용자 비밀번호 확인 폼 -->
    <form action="update_pass_process.php" method="post">
        <p>비밀번호 : <input type="password" name="password" placeholder="비밀번호를 입력하세요." required></p>
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- 게시글 ID 전달 -->
        <button type="submit">확인</button> 
        <button type="reset">초기화</button> <!-- 입력 내용 초기화 -->
        <br><hr>
    </form>

    <!-- 게시판 목록으로 돌아가기 -->
    목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
