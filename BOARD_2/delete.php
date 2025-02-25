<?php
// 데이터베이스 연결
include("db_connect.php");

// id값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 쿼리 실행(DELETE)
$sql = "DELETE FROM board WHERE id = $id";
$result = $conn->query($sql);

// 쿼리 실행 중 오류가 발생했을 경우
if (!$result) {
    die("쿼리 실행 중 오류가 발생했습니다.");
}

// 삭제 후 페이지 이동
header("Refresh: 2; URL='list.php'");
echo "게시글 삭제가 완료되었습니다. 게시글 페이지로 이동합니다."
?>