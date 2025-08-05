<?php

    // 세션 시작
    session_start();

    // 세션 정보 저장
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    환영합니다! <?php echo $name; ?>님 
    <a href="logout.php">로그아웃</a>
</body>
</html>