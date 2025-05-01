<?php
$servername = "localhost";
$username = "hyochan";  
$password = "40957976";  
$database = "board_login";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$subject = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : '';
$content = isset($_POST['content']) ? $conn->real_escape_string($_POST['content']) : '';

if ($id > 0 && $name && $subject && $content) {
    $sql = "UPDATE board SET name='$name', subject='$subject', content='$content' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "게시글이 수정되었습니다.";
        echo "<meta http-equiv='refresh' content='1;url=read.php?id=$id'>";
    } else {
        echo "오류 발생: " . $conn->error;
    }
} else {
    echo "모든 필드를 입력해야 합니다.";
}

$conn->close();
?>
