<?php

    // 세션 시작
    session_start();

    $name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
</head>
<body>
    환영합니다 <?php echo $name; ?>님!
    <a href="logout.php">로그아웃</a>
</body>
</html>