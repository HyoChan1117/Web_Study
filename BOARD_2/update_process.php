<?php
// 데이터베이스 연결 파일 포함 (db_connect.php에서 $conn 변수를 불러옴)
include("db_connect.php");

// GET 요청에서 게시글 ID 가져오기 (intval을 사용하여 정수 변환, SQL Injection 방지)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ID 값이 0이면 잘못된 접근으로 판단하고 프로그램 실행 중단
if ($id == 0) {
    die("잘못된 접근입니다.");
}

// 기존 게시글의 파일 정보를 가져오는 SQL 쿼리 실행
$sql = "SELECT original_file, saved_file FROM board WHERE id = $id";
$result = $conn->query($sql); // 쿼리 실행
$row = $result->fetch_assoc(); // 결과를 배열로 변환하여 가져옴

// 게시글이 존재하지 않으면 오류 메시지를 출력하고 프로그램 실행 중단
if (!$row) {
    die("게시글을 찾을 수 없습니다.");
}

// 기존에 저장된 파일 정보 유지
$original_file = $row['original_file']; // 원본 파일명
$saved_file = $row['saved_file']; // 서버에 저장된 파일명

// 사용자가 폼을 제출했을 경우 (POST 요청 확인)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 입력 데이터 가져오기
    $name = $_POST['name']; // 작성자 이름
    $password = $_POST['password']; // 비밀번호
    $subject = $_POST['subject']; // 제목
    $content = $_POST['content']; // 내용

    // 파일 업로드 처리 시작
    $upload_dir = "uploads/"; // 업로드된 파일을 저장할 폴더 경로 지정
    
    // 업로드 폴더가 존재하지 않으면 생성 (권한 0777로 설정하여 모든 권한 부여)
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // 업로드된 파일 정보 가져오기
    $file_name = $_FILES['file']['name'] ?? null; // 파일 원래 이름 (사용자가 업로드한 파일명)
    $file_tmp = $_FILES['file']['tmp_name'] ?? null; // 서버에 임시로 저장된 파일 경로
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // 파일 확장자 추출 (소문자로 변환)
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // 허용된 파일 확장자 목록

    // 사용자가 새로운 파일을 업로드한 경우 처리
    if (!empty($file_name) && in_array($file_ext, $allowed_extensions)) {
        // 기존 파일이 서버에 존재하면 삭제하여 중복 방지
        if (!empty($saved_file) && file_exists($upload_dir . $saved_file)) {
            unlink($upload_dir . $saved_file);
        }

        // 새로운 파일명을 생성 (중복 방지를 위해 고유한 ID 사용)
        $new_file_name = uniqid("file_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_file_name; // 저장될 경로 설정

        // 업로드된 파일을 지정한 위치로 이동
        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("파일 업로드 실패."); // 업로드 실패 시 프로그램 종료
        }

        // 데이터베이스에 저장할 파일 정보 업데이트
        $original_file = $file_name; // 원본 파일명 유지
        $saved_file = $new_file_name; // 새로 저장된 파일명
    }

    // 게시글 수정 SQL 쿼리 실행 (Prepared Statement 사용하지 않음 -> 보안 강화 필요)
    $upSql = "UPDATE board SET name = '$name', password = '$password', subject = '$subject', content = '$content', original_file = '$original_file', saved_file = '$saved_file' WHERE id = '$id'";
    $upResult = $conn->query($upSql); // SQL 실행

    // 게시글 수정 성공 여부 확인
    if ($upResult) {
        echo "게시글을 수정하였습니다. 게시글 페이지로 이동합니다."; // 성공 메시지 출력
        header("Refresh: 2; URL='read.php?id=$id'"); // 2초 후 게시글 상세보기 페이지로 이동
        exit; // 프로그램 종료
    } else {
        die("게시글 수정에 실패하였습니다: " . $conn->error); // 오류 메시지 출력 후 종료
    }
}

// 데이터베이스 연결 종료
$conn->close();
?>
