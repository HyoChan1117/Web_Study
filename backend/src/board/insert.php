<?php

    // 세션 불러오기
    require_once "./header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <h1>게시판 > 목록 > 글쓰기</h1>
    <form action="insert_process.php" method="post">
        <fieldset>
            제목: <input type="text" name="title"><br>
            내용:<br>
            <textarea name="content" cols="30" rows="5"></textarea><br>
        </fieldset>
        <button>글쓰기</button>
        <input type="reset" value="초기화">
        <hr>
        게시판 목록으로 돌아가시겠습니까? <a href="index.php">돌아가기</a>
    </form>
</body>
</html>