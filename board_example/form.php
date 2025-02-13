<?php 
    $errors = []; // 에러 메시지를 저장할 배열
    $name = $pass = $subject = $content = ""; // 입력값을 저장할 변수
    
    // form이 제출되었는지 확인
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 이름 검증
        if (empty($_POST["name"])) {
            $errors['name'] = "이름을 입력해 주세요.";
        } else {
            $name = trim($_POST["name"]); // 공백 제거
        }

        // 비번 검증
        if (empty($_POST["pass"])) {
            $errors['pass'] = "비밀번호를를 입력해 주세요.";
        } else {
            $pass = trim($_POST["pass"]); // 공백 제거
        }
        
        // 제목 검증
        if (empty($_POST["subject"])) {
            $errors['subject'] = "제목을 입력해 주세요.";
        } else {
            $subject = trim($_POST["subject"]); // 공백 제거
        }

        // 내용 검증
        if (empty($_POST["content"])) {
            $errors['content'] = "내용을 입력해 주세요.";
        } else {
            $content = trim($_POST["content"]); // 공백 제거
        }
    } 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <!-- 제목 -->
    <title>미니 게시판</title> 
    <!-- style.css 파일을 불러옴 -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>자유게시판 > 글쓰기</h2> <!-- 제목 -->
    <form name ="board" method="post" action="insert.php"> <!-- insert.php로 전송 -->
        <!-- 이름 입력 -->
        <li>
            이름: <input name="name" type="text">
            <!-- 에러 메시지 출력 -->
            <span style="color: red;"><?php echo $errors['name'] ?? ''; ?> </span>
        </li> 
        <!-- 비밀번호 입력 -->
        <li>
            비밀번호: <input name="pass" type="password">
            <!-- 에러 메시지 출력 -->
            <span style="color: red;"><?php echo $errors['pass'] ?? ''; ?> </span>
        </li>
        <!-- 제목 입력 --> 
        <li>
            제목: <input name="subject" type="text">
            <!-- 에러 메시지 출력 -->
            <span style="color: red;"><?php echo $errors['subject'] ?? ''; ?> </span>
        </li> 
        <!-- 내용 입력 -->
        <li>
            내용: <textarea name="content"></textarea>
            <span style="color: red;"><?php echo $errors['content'] ?? ''; ?> </span>
        </li> 
        <li><button type="submit">저장하기</button></li> <!-- 저장하기 버튼 -->
        <li><button type="button" onclick="location.href='list.php'">목록보기</button></li> <!-- 목록보기 버튼 -->
    </form>
</body>
</html>