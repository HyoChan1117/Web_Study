<?php
// 데이터베이스 연결
include("db_connect.php");

// POST 값 가져오기
$name = $_POST['name'];
$password = $_POST['password'];
$subject = $_POST['subject'];
$content = $_POST['content'];


// 쿼리 실행
$sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";
$result = $conn->query($sql);
?>