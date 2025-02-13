<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h3>로그인</h3>
    <!-- 로그인 폼 -->
    <form action="login_process.php" method="post">
        <input type="email" name="id" placeholder="아이디를 입력하세요."><br>
        <input type="password" name="password" placeholder="비밀번호를 입력하세요."><br>
        <input type="submit" value="로그인"><br><br><hr>
    </form>
    <!-- 회원가입 폼 -->
    <form action="join.php" method="post">
        아직 계정이 없으십니까? <button type="submit">회원가입</button><br><br>
    </form>
</body>
</html>