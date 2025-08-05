<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h1>회원가입</h1>
    <form action="join_process.php" method="post">
        <fieldset>
            이름: <input type="text" name="name" placeholder="이름을 입력하세요."><br>
            아이디: <input type="text" name="id" placeholder="아이디를 입력하세요."><br>
            비밀번호: <input type="password" name="pw" placeholder="비밀번호를 입력하세요.">
        </fieldset>
        <button>회원가입</button>
        <input type="reset" value="초기화">
    </form>
    <hr>
        로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
</body>
</html>