<?php
    if (isset($_GET["num"])) {
        $num = $_GET["num"];
    }
    else {
        $num = ""; // num이 없을 경우 빈 문자열
    }

    $con = mysqli_connect("localhost","user","12345","freebaord");
    $sql = "select * from users where num = $num"; // num이 일치하는 레코드 가져오기
    $result = mysqli_query($con, $sql); // 쿼리 실행

    $row = mysqli_fetch_array($result); // 레코드 가져오기
    $name = $row["name"]; // 이름
    $subject = $row["subject"]; // 제목
    $regist_day = $row["regist_day"]; // 등록일
    $content = $row["content"]; // 내용
    $content = str_replace(" ", "&nbsp;", $content); // 공백 처리
    $content = str_replace("\n", "<br>", $content); // 줄바꿈 처리
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>미니게시판 내용보기</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- style.css 파일을 불러옴 -->
</head>
<body>
    <h2>자유게시판 내용보기</h2>
    <li>
        번호: <?php echo $num; ?>
        <br>
        이름: <?php echo $name; ?>
        <br>
        제목: <?php echo $subject; ?>
        <br>
        등록일: <?php echo $regist_day; ?>
        <br>
        내용: <?php echo $content; ?>
    </li>
    <br>
    <button onclick="location.href='list.php'">목록</button> <!-- 목록 버튼 -->
    <form method="post" action="password_check.php"> <!-- password_check.php로 전송 -->
        <input type="hidden" name="num" value="<?php echo $num; ?>"> <!-- num 전달 -->
        <input type="hidden" name="action" value="edit"> <!-- action 전달 -->
        <button type="submit">수정</button> <!-- 수정 버튼 -->
    </form>
    <form method="post" action="password_check.php"> <!-- password_check.php로 전송 -->
        <input type="hidden" name="num" value="<?php echo $num; ?>"> <!-- num 전달 -->
        <input type="hidden" name="action" value="delete"> <!-- action 전달 -->
        <button type="submit">삭제</button> <!-- 삭제 버튼 -->
</body>
</html>