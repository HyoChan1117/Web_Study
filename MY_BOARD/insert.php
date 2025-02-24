<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 글쓰기</title>
</head>
<body>
    <h3>게시판 > 글쓰기</h3>
    <form action="insert_process.php" method="post">
        <p>이름: <input type="text" name="name" placeholder="이름을 입력하세요."></p>
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요."></p>
        <p>제목: <input type="text" name="subject" placeholder="제목을 입력하세요."></p>
        <p>내용:</p>
        <p><textarea name="content" rows='5' cols='30' placeholder="내용을 입력하세요."></textarea></p>
        <button>제출</button> <button type="reset">초기화</button>
    </form>
    <br>
    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>