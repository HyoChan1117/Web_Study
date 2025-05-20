<?php
include("header.php");

$servername = "localhost";
$username = "hyochan";  
$password = "40957976";  
$database = "board_login";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// URL에서 게시글 ID 가져오기 (GET 방식)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Refresh: 2; URL=delete_pass.php?id=$id");
    echo "잘못된 접근입니다.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 확인</title>
</head>
<body>
    <h3>게시판 > 사용자 확인</h3>
    <form action="delete_pass_process.php" method="post">
        
        <p>비밀번호 : <input type="password" name="password" placeholder="비밀번호를 입력하세요." required></p>
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- 게시글 ID 전달 -->
        <button type="submit">확인</button> <button type="reset">초기화</button>
        <br><hr>
    </form>

    목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
