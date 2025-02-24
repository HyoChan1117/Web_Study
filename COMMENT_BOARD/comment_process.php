<?php
include("db_connect.php");

$board_id = isset($_POST['board_id']) ? (int)$_POST['board_id'] : 0;
$name     = $_POST['name'];
$password = $_POST['password'];
$content  = $_POST['content'];

if (empty($name) || empty($content)) {
    echo "이름과 댓글 내용은 필수 입력 항목입니다.";
    header("Refresh: 2; URL=read.php?id=$board_id");
    exit;
}

// comments 테이블에 board_id, name, password, content, created_at 컬럼이 있어야 합니다.
$sql = "INSERT INTO comments (board_id, name, password, content, created_at) VALUES ($board_id, '$name', '$password', '$content', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "댓글이 등록되었습니다.";
    header("Refresh: 2; URL=read.php?id=$board_id");
} else {
    echo "오류: " . $conn->error;
    header("Refresh: 2; URL=read.php?id=$board_id");
}

$conn->close();
?>
