<?php
$servername = "localhost";
$username = "hyochan";
$password = "40957976";
$database = "board_login";

// MySQL 연결 시도
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}
else 
    echo " MySQL 연결 성공!";

$conn->close();
?>
