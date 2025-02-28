<?php
// 데이터베이스 연결
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = intval($_POST['post_id']);
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $content = $_POST['content'];

    if (empty($name) || empty($_POST['password']) || empty($content)) {
        die("모든 필드를 입력해주세요.");
    }

    $stmt = $conn->prepare("INSERT INTO comments (post_id, parent_id, name, password, content) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $post_id, $parent_id, $name, $password, $content);

    if ($stmt->execute()) {
        header("Location: read.php?id=$post_id");
    } else {
        die("댓글 작성 실패: " . $conn->error);
    }

    $conn->close();
}
?>
