<?php

    if (isset($_COOKIE['username']) && isset($_COOKIE['latte']) && isset($_COOKIE['americano'])) {
        $username = $_COOKIE['username'];
        $latte = $_COOKIE['latte'];
        $americano = $_COOKIE['americano'];

        echo "<h3>음료 주문</h3>";
        echo "<form action='set_cookie.php' method='post'><br>";
        echo "  이름: <input type='text' name='username' value='$username'><br>";
        echo "  라떼 수량: <input type='text' name='latte' value='$latte'><br>";
        echo "  아이스 아메리카노 수량: <input type='text' name='americano' value='$americano'><br>";
        echo "  <button>수정 완료</button>";
        echo "</form>";

        echo "<a href='index.php'>뒤로가기</a>";
    }
?>