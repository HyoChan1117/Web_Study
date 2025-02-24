<?php
include("db_connect.php");

// 폼에서 입력한 값 가져오기
$name    = $_POST["name"];
$password= $_POST["password"];
$subject = $_POST["subject"];
$content = $_POST["content"];

// 입력값 검증 (이름, 제목, 내용은 필수)
if (empty($name) || empty($subject) || empty($content)) {
    echo "이름, 제목, 내용은 필수 입력 항목입니다.";
    header("Refresh: 1; URL=list.php");
    exit;
}

// 파일 첨부 처리
$file_path = "";
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "uploads/";
    // uploads 폴더가 없으면 생성
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_name = basename($_FILES['attachment']['name']);
    // 파일명에 시간 값을 추가하여 중복 방지
    $file_path = $target_dir . time() . "_" . $file_name;
    
    if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $file_path)) {
        echo "파일 업로드에 실패했습니다.";
        exit;
    }
}

// 게시글 저장 (파일 첨부가 있으면 파일 경로도 저장)
// board 테이블에 file 컬럼이 있어야 합니다.
$sql = "INSERT INTO board (name, password, subject, content, file) VALUES ('$name', '$password', '$subject', '$content', '$file_path')";

if ($conn->query($sql) === TRUE) {
    echo "글이 등록되었습니다.";
    header("Refresh: 2; URL=list.php");
} else {
    echo "오류: " . $conn->error;
    header("Refresh: 2; URL=list.php");
}

$conn->close();
?>
