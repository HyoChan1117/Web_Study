<?php
// 데이터베이스 연결
include("db_connect.php");

// id값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    die("잘못된 접근입니다.");
}

// 기존 데이터 가져오기 (파일 정보 포함)
$sql = "SELECT original_file, saved_file FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    die("게시글을 찾을 수 없습니다.");
}

// 기존 파일 정보 유지
$original_file = $row['original_file'];
$saved_file = $row['saved_file'];

// POST 데이터 가져오기
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

    // 새로운 파일이 업로드된 경우 처리
    if (!empty($file_name) && in_array($file_ext, $allowed_extensions)) {
        // 기존 파일 삭제
        if (!empty($saved_file) && file_exists($upload_dir . $saved_file)) {
            unlink($upload_dir . $saved_file);
        }

        // 새 파일 저장
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_file_name;

        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("파일 업로드 실패.");
        }

        // 파일명 업데이트
        $original_file = $file_name;
        $saved_file = $new_file_name;
    }

    // SQL 실행 (Prepared Statement 방식)
    $upSql = "UPDATE board SET name = '$name', password = '$password', subject = '$subject', content = '$content', original_file = '$original_file', saved_file = '$saved_file' WHERE id = '$id'";
    $upResult = $conn->query($upSql);

    if ($upResult) {
        echo "게시글을 수정하였습니다. 게시글 페이지로 이동합니다.";
        header("Refresh: 2; URL='read.php?id=$id'");
        exit;
    }
    else {
        die("게시글 수정에 실패하였습니다: " . $conn->error);
    }

    $conn->close();
}
?>
