<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h3>로그인</h3>
    
    <!-- 로그인 폼: 사용자가 이메일(ID)과 비밀번호를 입력하고 로그인할 수 있는 폼 -->
    <form action="login_process.php" method="post"> 
        <!-- 이메일 입력 필드 (사용자의 아이디 역할) -->
        <input type="email" name="id" placeholder="아이디를 입력하세요."><br>
        
        <!-- 비밀번호 입력 필드 -->
        <input type="password" name="password" placeholder="비밀번호를 입력하세요."><br>
        
        <!-- 로그인 버튼: 입력한 정보를 서버로 전송 -->
        <input type="submit" value="로그인"><br><br><hr>
    </form>

    <!-- 회원가입 폼: 계정이 없는 사용자가 회원가입을 진행할 수 있도록 제공 -->
    <form action="join.php" method="post"> 
        <!-- 회원가입 유도 문구 -->
        아직 계정이 없으십니까? 
        
        <!-- 회원가입 버튼: 클릭하면 join.php로 이동하여 회원가입을 진행 -->
        <button type="submit">회원가입</button><br><br>
    </form>
</body>
</html>
