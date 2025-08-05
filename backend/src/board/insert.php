<?php

    include "./header.php";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
</head>
<body>
    <h1>게시판 > 목록 > 글쓰기</h1>
    <form action="insert_process.php" method="post">
        <fieldset>
            제목: <input type="text" name="subject"><br>
            내용: <br>
            <textarea name="content" rows="5" cols="30"></textarea>
        </fieldset>
        <button>글쓰기</button>
        <input type="reset" value="초기화">
    </form>
    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>