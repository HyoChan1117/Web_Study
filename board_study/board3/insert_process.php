<?php
// 데이터베이스 연결
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // 파일 업로드 처리
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = $_FILES['file']['name'] ?? null;
    $file_tmp = $_FILES['file']['tmp_name'] ?? null;
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

    if ($file_name) {
        if (!in_array($file_ext, $allowed_extensions)) {
            die("허용되지 않은 파일 형식입니다.");
        }

        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_file_name;

        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("파일 업로드 실패.");
        }
    } else {
        $new_file_name = null;
        $file_name = null;
    }

    // SQL 실행 (Prepared Statement 사용)
    $sql = "INSERT INTO board (name, password, subject, content, original_file, saved_file) VALUES ('$name', '$password', '$subject', '$content', '$file_name', '$new_file_name')";
    $result = $conn->query($sql);

    if ($result) {
        echo "제출에 성공했습니다. 게시판 목록으로 이동합니다.";
        header("Refresh: 2; URL='list.php'");
    } else {
        die("제출 실패: " . $conn->error);
    }
}
?>
