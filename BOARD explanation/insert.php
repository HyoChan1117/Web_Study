<?php
include("header.php"); // 공통 헤더 포함 (세션 유지 및 UI 통합 가능)
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> <!-- UTF-8 인코딩 설정 (한글 깨짐 방지) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 반응형 웹 설정 -->
    <title>게시판 작성</title> <!-- 페이지 제목 -->
</head>
<body>
    <!-- 로그인한 사용자에게 환영 메시지 및 로그아웃 버튼 제공 -->
    <h5>환영합니다, <?php echo htmlspecialchars($_SESSION['username']); ?>님! <a href="logout.php">로그아웃</a> </h5>

    <h3>게시판 > 글쓰기</h3>

    <!-- 게시글 작성 폼 -->
    <form action="insert_process.php" method="post">
        <!-- 이름 입력 필드 -->
        이름 : <input type="text" name="name" placeholder="이름을 입력하세요" required><br><br>
        
        <!-- 비밀번호 입력 필드 -->
        비밀번호 : <input type="password" name="password" placeholder="비밀번호를 입력하세요" required><br><br>

        <!-- 제목 입력 필드 -->
        제목 : <input type="text" name="subject" placeholder="제목을 입력하세요" required><br><br>

        <!-- 내용 입력 필드 -->
        내용 : <br>
        <textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요" required></textarea><br>
        
        <!-- 제출 및 초기화 버튼 -->
        <input type="submit" value="저장">
        <input type="reset" value="초기화"><br><br><hr>
    </form>

    <!-- 게시판 목록으로 이동하는 링크 -->
    게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
