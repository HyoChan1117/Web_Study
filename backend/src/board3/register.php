<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <!--
    회원가입

    FORM
    Action: register_process.php
    Method: post
    입력값: 이름(name), 아이디(account), 비밀번호(pw)

    로그인 페이지 돌아가기
    -->

    <h1>회원가입</h1>

    <form action="register_process.php" method="post">
        <fieldset>
            <legend>정보 입력</legend>
            이름: <input type="text" name="name" required><br>
            휴대전화: <input type="text" name="phone" required><br>
            <hr>
            아이디: <input type="text" name="account" required><br>
            비밀번호: <input type="password" name="pw" required>
        </fieldset>
        <button>회원가입</button>
        <input type="reset" value="초기화">
    </form>

    <hr>

    로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
</body>
</html>