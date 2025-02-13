<?php
$conn = new mysqli("localhost", "hyochan", "40957976", "sample");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - 이름: " . $row["name"] . " - 이메일: " . $row["email"] . "<br>";
    }
} else {
    echo "데이터가 없습니다.";
}

$conn->close();
?>
