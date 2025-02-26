<?php
// 데이터베이스 연결
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_id = intval($_POST['comment_id']);
    $password = $_POST['password'];

    // 댓글 정보 가져오기
    $stmt = $conn->prepare("SELECT password, post_id FROM comments WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password, $post_id);
    
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // 댓글 삭제
            $delete_stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
            $delete_stmt->bind_param("i", $comment_id);
            $delete_stmt->execute();
            header("Location: read.php?id=$post_id");
        } else {
            die("비밀번호가 틀렸습니다.");
        }
    } else {
        die("댓글을 찾을 수 없습니다.");
    }

    $stmt->close();
    $conn->close();
}
?>
