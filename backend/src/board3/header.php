<?php

    // 세션 시작
    session_start();

    // 세션 변수 저장
    // 세션 정보가 없을 경우
    // 게스트 정보 저장
    if (empty($_SESSION)) {
        $name = "GUEST";
        $account = "GUEST";
    } else {    // 세션 정보가 있을 경우
    $name = $_SESSION['name'];
    $account = $_SESSION['account'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    환영합니다! <?= $name; ?>(<?= $account; ?>) 
    
    <?php
        if ($account == "GUEST") {
            echo "<a href='login.php'>로그인</a>";
        } else {
            echo "<a href='logout.php'>로그아웃</a>";
        }
    ?>
</body>
</html>