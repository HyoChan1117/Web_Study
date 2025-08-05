<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h1>로그인</h1>
    <form action="login_process.php" method="post">
        <fieldset>
            아이디: <input type="text" name="name"><br>
            비밀번호: <input type="password" name="pw"><br>
            <button>로그인</button>
            <input type="reset" value="초기화">
        </fieldset>
        <hr>
        아직 계정이 없으십니까? <a href="join.php">회원가입</a>
    </form>
</body>
</html>