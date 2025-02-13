<?php
$num = $_GET["num"]; // num
$con = mysqli_connect("localhost","user","12345","freebaord"); // DB 연결

$sql = "select * from users where num = $num"; // num이 일치하는 레코드 가져오기
$result = mysqli_query($con, $sql); // 쿼리 실행
$row = mysqli_fetch_array($result); // 레코드 가져오기

mysqli_close($con); // DB 연결 종료
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>미니게시판 글수정</title>
</head>
<body>
    <h2>글수정</h2>
    <form method="post" action="update.php">
        <input type="hidden" name="num" value="<?php echo $num; ?>"> <!-- num 전달 -->
        <li>
            이름: <?php echo $row["name"]; ?> <!-- 이름 출력 -->
        </li>
        <li>
            제목: <input type="text" name="subject" value="<?php echo $row["subject"]; ?>" ><br> <!-- 제목 입력 -->
        </li>
        <li>
            내용: <textarea name="content" required><?php echo $row["content"]; ?></textarea><br> <!-- 내용 입력 -->
        </li>
        <input type="submit" value="수정"> <!-- 수정 버튼 -->
    </form>
</body>
</html>