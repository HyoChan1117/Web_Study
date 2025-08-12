<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <!--
    회원가입

    이름:
    아이디:
    비밀번호:

    회원가입 버튼 활성화
    ------------------
    Form
    Action: register_process.php
    Method: post
    입력값: 이름(name), 아이디(id), 비밀번호(pw)
    -->
    <h1>회원가입</h1>
    <form action="register_process.php" method="post">
        <fieldset>
            이름: <input type="text" name="name"><br>
            아이디: <input type="text" name="id"><br>
            비밀번호: <input type="password" name="pw"><br>
        </fieldset>
        <button>회원가입</button>
        <input type="reset" value="초기화">
        <hr>
        <a href="login.php">로그인</a>
    </form>
</body>
</html>