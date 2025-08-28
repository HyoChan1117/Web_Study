<?php

    // 세션 시작
    session_start();

    // 세션 변수 저장
    $account = $_SESSION['account'];
    $name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php

        if (empty($_SESSION)) {
            echo "환영합니다! 게스트님<br>";
            echo "<a href='login.php>로그인</a>'";
        } else {
            echo "환영합니다! $name($account)님";
            echo "<a href='logout.php'> 로그아웃</a>";
        }

    ?>
    
</body>
</html>