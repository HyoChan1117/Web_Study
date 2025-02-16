<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- 문서의 문자 인코딩을 UTF-8로 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹을 위한 뷰포트 설정 -->
    <title>회원가입</title> <!-- 페이지 제목 -->
</head>
<body>
    <h3>회원가입</h3>

    <!-- 회원가입 폼: 사용자가 아이디, 비밀번호를 입력하여 계정을 생성 -->
    <form action="db_account.php" method="post">
        <!-- 이메일(아이디) 입력 필드 -->
        아이디 : <input type="email" name="id" placeholder="아이디를 입력하세요."><br><br>
        
        <!-- 비밀번호 입력 필드 -->
        비밀번호 : <input type="password" name="pass" placeholder="비밀번호를 입력하세요."><br><br>
        
        <!-- 비밀번호 확인 입력 필드 -->
        비밀번호 확인 : <input type="password" name="pass_check" placeholder="비밀번호를 확인합니다."><br><br>
        
        <!-- 회원가입 버튼 (폼 데이터 제출) -->
        <button type="submit">회원가입</button> 
        
        <!-- 입력 필드 초기화 버튼 (입력한 내용 지우기) -->
        <button type="reset">초기화</button><br><br><hr>
    </form>

    <!-- 로그인 페이지로 돌아가기 -->
    로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
</body>
</html>
