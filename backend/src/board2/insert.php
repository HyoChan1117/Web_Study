<?php

    // 사용자 정보 불러오기
    require_once './header.php';

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
</head>
<body>
    <!--
    게시물 목록 > 글쓰기

    FORM
    Action: insert_process.php
    Method: post
    입력값: 제목, 내용

    제출 버튼 활성화
    초기화 버튼 활성화

    게시판 목록 페이지 돌아가기 활성화
    -->
    <h1>게시물 목록 > 글쓰기</h1>
    <form action="insert_process.php" method="post">
        <fieldset>
            제목: <input type="text" name="title" required><br>
            내용: <br>
            <textarea cols='30' rows='5' name="content" required></textarea>
        </fieldset>
        <button>제출</button>
        <input type="reset" value="초기화">
    </form>

    <hr>

    게시판 목록으로 돌아가시겠습니까? 
    <a href="index.php">돌아가기</a>
</body>
</html>