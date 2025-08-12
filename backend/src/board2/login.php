<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <!--
    로그인

    아이디:
    비밀번호:

    로그인 버튼 활성화
    초기화 버튼 활성화

    회원가입 버튼
    ----------------
    Form
    Action: login_process.php
    Method: post
    입력값: 아이디(id), 비밀번호(pw)
    -->
    <h1>로그인</h1>
    <form action="login_process.php" method="post">
        <fieldset>
            아이디: <input type="text" name="id"><br>
            비밀번호: <input type="password" name="pw"><br>
        </fieldset>
        <button>로그인</button>
        <input type="reset" value="초기화">
        <hr>
        <a href="register.php">회원가입</a>
    </form>
</body>
</html>