<?php
$servername = "localhost";
$username = "hyochan";  
$password = "40957976";  
$database = "board_login";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // 1️. 해당 ID의 게시글 삭제
    $sql = "DELETE FROM board WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "게시글이 삭제되었습니다.<br>";

        // 2️. ID를 다시 1부터 정렬
        $conn->query("SET @count = 0");
        $conn->query("UPDATE board SET id = @count := @count + 1");
        $conn->query("ALTER TABLE board AUTO_INCREMENT = 1");

        // 3️. 2초 후 목록 페이지로 이동
        echo "<meta http-equiv='refresh' content='2;url=list.php'>";
    } else {
        echo "오류 발생: " . $conn->error;
    }
} else {
    echo "잘못된 요청입니다.";
}

$conn->close();
?>
