<?php
// 데이터베이스 연결
include("db_connect.php");

// id 값 가져오기
$id = $_GET['id'];

// 쿼리 실행(삭제)
$sql = "DELETE FROM board WHERE id = $id";
$result = $conn->query($sql);

// 삭제 성공했을 경우
if ($result) {
    echo "게시글을 삭제했습니다. 게시판 목록으로 이동합니다.";
    header("Refresh: 2; URL='list.php'");
}

// 쿼리 실행에 문제가 있을 경우
else {
    echo "삭제하지 못했습니다. 게시글 페이지로 돌아갑니다.";
    header("Refresh: 2; URL='read.php?id=$id'");
}
?>