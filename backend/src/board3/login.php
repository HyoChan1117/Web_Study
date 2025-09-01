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

    FORM
    Action: login_process.php
    Method: post
    입력값: 아이디(account), 비밀번호(pw)

    아직도 계정이 없으신가요? 회원가입
    -->

    <h1>로그인</h1>

    <form action="login_process.php" method="post">
        <fieldset>
            <legend>사용자 정보 입력</legend>
            아이디: <input type="text" name="account" require><br>
            비밀번호: <input type="password" name="pw" require>
        </fieldset>
        <button>로그인</button>
        <input type="reset" value="초기화"><br>
        <a href="search_account.php" style="font-size: 12px">아이디 찾기</a>
        <a href="search_pw.php" style="font-size: 12px">비밀번호 찾기</a>
        <a href="register.php" style="font-size: 12px">회원가입</a>
    </form>

    <hr>

    게스트 계정으로 입장하시겠습니까?
    <a href="index.php">들어가기</a>

</body>
</html>