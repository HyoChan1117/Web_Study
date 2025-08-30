<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 찾기</title>
</head>
<body>
    <!--
    아이디 찾기

    FORM
    Action: search_account_process.php
    Method: post
    입력값: 이름(name), 휴대전화(phone)
    -->

    <h1>아이디 찾기</h1>

    <form action="search_account_process.php" method="post">
        <fieldset>
            <legend>사용자 정보 입력</legend>
            이름: <input type="text" name="name" required><br>
            휴대전화: <input type="text" name="phone" required><br>
        </fieldset>
        <button>찾기</button>
        <input type="reset" value="초기화">
    </form>

    <hr>

    로그인 페이지로 돌아가시겠습니까? 
    <a href="login.php" method="post">돌아가기</a>
</body>
</html>