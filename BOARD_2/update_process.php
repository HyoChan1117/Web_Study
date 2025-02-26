<?php
// 데이터베이스 연결
include("db_connect.php");

// id값 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// id값을 가져오지 못한 경우
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// 기존 데이터 가져오기
$sql = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    die("게시글을 찾을 수 없습니다.");
}

// POST 데이터 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password']; // 수정 시 비밀번호 확인 기능이 필요할 수도 있음.
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
    if (!empty($file_name)) {
        if (!in_array($file_ext, $allowed_extensions)) {
            die("허용되지 않은 파일 형식입니다.");
        }

        // 기존 파일 삭제
        if (!empty($row['saved_file'])) {
            $old_file_path = $upload_dir . $row['saved_file'];
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
        }

        // 새 파일 저장
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_file_name;

        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("파일 업로드 실패.");
        }
    } else {
        // 파일을 변경하지 않는 경우 기존 데이터 유지
        $new_file_name = $row['saved_file'];
        $file_name = $row['original_file'];
    }

    // 게시글 업데이트 쿼리 실행
    $upSql = "UPDATE board SET name = '$name', subject = '$subject', content = '$content', original_file = '$original_file', saved_file = '$saved_file' WHERE id = '$id'";
    $upResult = $conn->query($upSql);

    if ($upResult) {
        header("Refresh: 2, URL='read?id=$id'");
        echo "게시글을 수정하였습니다. 게시글 페이지로 이동합니다.";
    }
    else {
        die("게시글 수정에 실패하였습니다.");
    }
}
?>