<?php

    // 세션 시작
    session_start();

    // 세션 변수 불러오기
    $name = $_SESSION['name'];
    $id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    안녕하세요! <?php echo $name; ?>님 
    <a href="logout.php">로그아웃</a><br>
</body>
</html>