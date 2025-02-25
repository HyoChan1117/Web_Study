<?php
// 데이터베이스 연결
include("db_connect.php");

// POST 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['name'];
    $subject = $_POST['name'];
    $content = $_POST['name'];
}

// 쿼리 실행(INSERT)
$sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";
$result = $conn->query($sql);

// 제출에 성공했을 경우우
if ($result) {
    echo "제출에 성공했습니다. 게시판 목록으로 이동합니다.";
    header("Refresh: 2; URL='list.php");
}
// 제출에 실패했을 경우
else {
    echo "제출에 실패했습니다. 다시 입력하세요.";
    header("Refresh: 2; URL='insert.php");
}
?>