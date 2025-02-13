<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h3>회원가입</h3>
    <!-- 회원가입 폼 -->
    <form action="db_account.php" method="post">
        이름 : <input type="text" name="name" placeholder="이름을 입력하세요."><br><br>
        아이디 : <input type="email" name="id" placeholder="아이디를 입력하세요."><br><br>
        비밀번호 : <input type="password" name="pass" placeholder="비밀번호를 입력하세요."><br><br>
        비밀번호 확인 : <input type="password" name="pass_check" placeholder="비밀번호를 확인합니다."><br><br>
        <button type="submit">회원가입</button> <button type="reset">초기화</button><br><br><hr>
    </form>
    <!-- 로그인 창 폼 돌아가기 -->
    로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
</body>
</html>