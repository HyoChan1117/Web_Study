<?php

    // 세션 시작
    session_start();

    // 세션 변수 불러오기
    $name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--
    "안녕하세요! [사용자 이름]님" 출력
    로그아웃 버튼 활성화
    환영 메시지 출력
    -->
    안녕하세요! <?php echo $name; ?>님
    <a href="logout.php">로그아웃</a><br>
    <h1>Welcome!!</h1>
</body>
</html>