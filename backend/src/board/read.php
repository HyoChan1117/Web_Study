<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않은 값이 넘어왔을 경우
    // 오류 메시지 출력 후 메인 페이지 리다이렉센
    if (empty($id)) {
        header("Refresh: 2; index.php");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // try
    try {
        // 데이터베이스 연결을 위한 변수 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();
    }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 메인 페이지 리다이렉션
        header("Refresh: 2; index.php");
        echo "DB 연결 실패";
        exit;
    }

    // 로그인 정보 불러오기
    require_once "./header.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']."님의 ".$row['title']." 게시글"; ?></title>
</head>
<body>
    <!--
    게시판 > 목록 > 게시글

    작성자:
    작성일:
    수정일: (수정 시 출력)
    --------------------
    제목:
    내용:

    수정, 삭제 버튼
    -->
    <h1>게시판 > 목록 > 게시글</h1>
    <fieldset>
        <strong>작성자: </strong><?php echo $row['name']."($row[account])"; ?><br>
        <strong>작성일: </strong><?php echo $row['created_at']; ?><br>
        <?php
            if (!empty($row['updated_at'])) {
                echo "<strong>수정일: </strong>".$row['updated_at']."<br>";
            } // 수정일이 있으면 출력, 없으면 미출력
        ?>
        <hr>
        <strong>제목: </strong><?php echo $row['title']; ?><br>
        <strong>내용: </strong><br>
        <?php echo $row['content']; ?><br>
    </fieldset>
    <?php
        if ($row['name'] == $name && $row['account'] == $account) {
            echo "<button><a href='update.php?id=$row[id]'>수정</a></button>";
            echo "<button><a href='delete.php?id=$row[id]'>삭제</a></button>";
        }
    ?>
    <hr>
    게시판 목록으로 돌아가시겠습니까? <a href="index.php">돌아가기</a>
    
</body>
</html>