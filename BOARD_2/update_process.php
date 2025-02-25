<?php
// 데이터베이스 연결
include("db_connect.php");

// id값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// id값을 가져오지 못한 경우
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// POST 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
}

// 쿼리 실행(UPDATE)
$sql = "UPDATE board SET name = '$name', password = '$password', subject = '$subject', content = '$content' WHERE id = $id";
$result = $conn->query($sql);

// 쿼리 실행 중 문제가 발생했을 경우
if (!$result) {
    die("쿼리 실행 중 문제가 발생했습니다.");
}

// 해당 게시글 페이지로 이동하기
header("Refresh: 2; URL='read.php?id=$id'");
echo "게시글 수정이 완료되었습니다. 게시글 페이지로 이동합니다.";
?>