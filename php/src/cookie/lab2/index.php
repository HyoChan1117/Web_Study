<?php

    if (isset($_COOKIE['username']) && isset($_COOKIE['latte']) && isset($_COOKIE['americano'])) {
        $username = $_COOKIE['username'];
        $latte = $_COOKIE['latte'];
        $americano = $_COOKIE['americano'];

        echo "<h3>음료 주문</h3>";
        echo "<strong>{$username}</strong>님의 주문 내용<br>";
        echo "<ul>";
        echo "    <li>라떼: {$latte}잔</li>";
        echo "    <li>아이스 아메리카노: {$americano}잔</li>";
        echo "</ul>";

        echo "<a href='edit_order.php'>주문 수정</a><br>";
        echo "<a href='delete_cookie.php'>주문 초기화</a>";
    } else {
        echo "<h3>음료 주문</h3>";
        echo "<form action='set_cookie.php' method='post'><br>";
        echo "  이름: <input type='text' name='username'><br>";
        echo "  라떼 수량: <input type='text' name='latte'><br>";
        echo "  아이스 아메리카노 수량: <input type='text' name='americano'><br>";
        echo "  <button>주문하기</button>";
        echo "</form>";
    }