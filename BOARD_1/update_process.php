<?php
// 데이터베이스 연결
include("db_connect.php");

// 수정한 값 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
}

// 쿼리 실행
$sql = "UPDATE board SET name = '$name', password = '$password', subject = '$subject', content = '$content' WHERE id = $id";
$result = $conn->query($sql);

// 수정 했을 경우
if ($result) {
    echo "수정되었습니다. 게시글 페이지로 이동합니다.";
    header("Refresh: 2; URL='read.php?id=$id'");
}
// 문제가 있을 경우
else {
    echo "수정에 실패했습니다. 게시글 수정 페이지로 이동합니다.";
    header("Refresh: 2; URL='update.php?id=$id'");
}

?>