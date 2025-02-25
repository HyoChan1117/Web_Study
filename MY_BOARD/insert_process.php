<?php
// 데이터베이스 연결
include("db_connect.php");

// POST 값 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
}

// 쿼리 실행
$sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";
$result = $conn->query($sql);

// 게시글 작성 완료 -> 게시판 리스트로 돌아감
echo "게시글 작성이 완료되었습니다.";
header("Refresh: 2; URL='list.php'");
?>