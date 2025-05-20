<?php
$conn = new mysqli("localhost", "hyochan", "40957976", "sample");

// SQL 실행
$sql = "INSERT INTO users (name, email) VALUES ('김효찬', 'hyochan@example.com')";
if ($conn->query($sql) === TRUE) {
    echo "새로운 데이터 삽입 성공!";
} else {
    echo "오류 발생: " . $conn->error;
}

$conn->close();
?>
