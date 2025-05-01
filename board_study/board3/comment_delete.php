<?php
// 데이터베이스 연결
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_id = intval($_POST['comment_id']);
    $password = $_POST['password'];

    // 댓글 정보 가져오기 (`query()` 사용)
    $sql = "SELECT password, post_id FROM comments WHERE id = $comment_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // 배열로 데이터 가져오기
        $hashed_password = $row['password'];
        $post_id = $row['post_id'];

        // 비밀번호 검증
        if (password_verify($password, $hashed_password)) {
            // 댓글 삭제
            $delSql = "DELETE FROM comments WHERE id = $comment_id";
            $conn->query($delSql);  // 실행

            // 게시글 페이지로 이동
            header("Location: read.php?id=$post_id");
            exit;
        } else {
            header("Refresh:2 ; URL='read.php?id=$post_id'");
            echo "비밀번호가 틀렸습니다.";
        }
    } else {
        die("댓글을 찾을 수 없습니다.");
    }

    $conn->close();
}
?>
