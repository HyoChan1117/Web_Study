<?php

    // 데이터베이스 연결 및 세션 시작
    include "./db_connect.php";
    include "./header.php";

    // id 가져오기
    $id = $_GET['id'];

    // sql문 작성
    $query = "SELECT * FROM list where no = $id";

    // 쿼리 실행
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물</title>
</head>
<body>
    <h1>게시판 > 목록 > 게시물</h1>
    <fieldset>
        <?php
            echo "<strong>작성자</strong>: $row[name]<br>";
            echo "<strong>작성일</strong>: $row[created_at]<hr>";
            echo "<strong>제목</strong>: $row[subject]<br>";
            echo "<strong>내용</strong>:<br>";
            echo "$row[content]";
        ?>
    </fieldset>
    <?php
        if ($name == $row['name']) {
            echo "<button><a href='update.php?id=$id'>수정</a></button> ";
            echo "<button><a href='delete.php?id=$id'>삭제</a></button>";
        }
    ?>
    <hr>
    게시판으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>