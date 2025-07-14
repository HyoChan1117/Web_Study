<?php

    if (isset($_COOKIE['username']) && isset($_COOKIE['latte']) && isset($_COOKIE['americano'])) {
        $username = $_COOKIE['username'];
        $latte = $_COOKIE['latte'];
        $americano = $_COOKIE['americano'];

        echo "<h3>음료 주문</h3>";
        echo "<form action='set_cookie.php' method='post'><br>";
        echo "  이름: <input type='text' name='username'><br>";
        echo "  라떼 수량: <input type='text' name='latte' value='0'><br>";
        echo "  아이스 아메리카노 수량: <input type='text' name='americano' value='0'><br>";
        echo "  <button>주문하기</button>";
        echo "</form>";
    }

?>