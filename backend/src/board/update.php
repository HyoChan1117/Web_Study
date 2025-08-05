<?php
    
    // 데이터베이스 연결 및 세션 시작
    include "./db_connect.php";
    include "./header.php";

    // id 값 가져오기
    $id = $_GET['id'];

    // sql문 작성하기
    $query = "SELECT * FROM list where no = $id";

    // 쿼리 실행
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <h1>게시판 > 목록 > 게시글 > 수정</h1>
    <form action="update_process.php?id=<?php echo $id; ?>" method="post">
        <fieldset>
            작성자: <?php echo $row['name']; ?><br>
            작성일: <?php echo $row['created_at']; ?><br>
            <hr>
            제목: <input type="text" name="subject" value="<?php echo $row['subject']; ?>"><br>
            내용: <input type="text" name="content" value="<?php echo $row['content']; ?>">
        </fieldset>
        <button>수정</button>
        <input type="reset" value="초기화">
        <hr>
        게시글로 돌아가시겠습니까? <a href="read.php?id=<?php echo $id ?>">돌아가기</a>
    </form>
</body>
</html>