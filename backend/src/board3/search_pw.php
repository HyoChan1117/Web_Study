<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기</title>
</head>
<body>
    <!--
    비밀번호 찾기

    FORM
    Action: search_pw_process.php
    Method: post
    입력값: 이름(name), 휴대전화(phone), 아이디(account)

    로그인 페이지로 돌아가시겠습니까? 돌아가기
    -->

    <h1>비밀번호 찾기</h1>

    <form action="search_pw_process.php" method="post">
        <fieldset>
            <legend>사용자 정보 입력</legend>
            이름: <input type="text" name="name"><br>
            휴대전화: <input type="text" name="phone"><br>
            아이디: <input type="text" name="account">
        </fieldset>
        <button>찾기</button>
        <input type="reset" value="초기화">

        <hr>

        로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
    </form>
</body>
</html>