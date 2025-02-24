<?php
// 데이터베이스 연결
$hostname = "localhost";
$username = "hyochan";
$password = "40957976";
$database = "board_login1";

$conn = new mysqli($hostname, $username, $password, $database);

// 연결 실패 시 오류 메시지 출력
if($conn->connect_error) {
    die("연결 종료" . $conn->connect_error);
}

?>