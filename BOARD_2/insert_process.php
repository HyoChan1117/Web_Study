<?php
// 데이터베이스 연결
include("db_connect.php");

// POST 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 사용자 입력값 가져오기 (SQL Injection 방지)
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // 파일 업로드 처리
    $upload_dir = "uploads/"; // 업로드 디렉토리 (미리 생성 필요)
    $file_name = $_FILES['file']['name']; // 사용자가 업로드한 파일명
    $file_tmp = $_FILES['file']['tmp_name']; // 임시 저장된 경로
    $file_size = $_FILES['file']['size']; // 파일 크기
    $file_type = $_FILES['file']['type']; // 파일 타입

    // 허용된 확장자 리스트 (예: 이미지, PDF)
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!empty($file_name)) {
        // 파일 크기 제한 (5MB)
        if ($file_size > 5 * 1024 * 1024) {
            echo "파일 크기가 너무 큽니다. 5MB 이하로 업로드하세요.";
            exit;
        }

        // 확장자 검사
        if (!in_array($file_ext, $allowed_extensions)) {
            echo "허용되지 않은 파일 형식입니다.";
            exit;
        }

        // 저장할 파일명을 랜덤하게 생성 (고유 ID + 확장자)
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_file_name;

        // 파일 이동 (서버에 저장)
        if (move_uploaded_file($file_tmp, $target_file)) {
            echo "파일 업로드 성공! 저장된 파일명: " . $new_file_name;
        } else {
            echo "파일 업로드 실패.";
            exit;
        }
    } else {
        $new_file_name = null;
        $file_name = null;
    }

    // SQL 실행 (파일 정보 포함, 원본 파일명 & 저장된 파일명 매핑)
    $sql = "INSERT INTO board (name, password, subject, content, original_file, saved_file) 
            VALUES ('$name', '$password', '$subject', '$content', '$file_name', '$new_file_name')";

    $result = $conn->query($sql);

    if ($result) {
        echo "제출에 성공했습니다. 게시판 목록으로 이동합니다.";
        header("Refresh: 2; URL='list.php'");
    } else {
        echo "제출에 실패했습니다. 다시 입력하세요.";
        header("Refresh: 2; URL='insert.php'");
    }
}
?>
