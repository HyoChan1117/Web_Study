<?php

    // 게시물 id값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id값일 경우
    // 유효하지 않는 값입니다. -> 게시판 목록 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='index.php'");
        echo "유효하지 않는 값입니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board1 WHERE id=$id";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();

        // 예외 처리
        // 해당 id 값이 없을 경우
        // 해당하는 게시물이 없습니다. -> 게시판 목록 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='index.php'");
            echo "해당하는 게시물이 없습니다.";
            exit;
        }

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 사용자 정보 불러오기
    require_once './header.php';

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물</title>
</head>
<body>
    <!--
    게시물 목록 > 게시물

    작성자:
    작성시간:
    수정시간:  -> 수정 했을 경우 보이게 설정
    --------------------------
    제목:
    내용:

    수정, 삭제 버튼 활성화
    게시판 목록 돌아가기 활성화
    -->
    <h1>게시물 목록 > 게시물</h1>
    <fieldset>
        <strong>작성자:</strong> <?= $row['name']; ?><br>
        <strong>작성시간:</strong> <?= $row['created_at']; ?><br>
        <?php
            // 수정했을 경우
            if (!empty($row['updated_at'])) {
                echo "<strong>수정시간:</strong> <?= $row[updated_at]; ?><br>";
            }    // 수정하지 않으면 출력 X
        ?>
        <hr>
        <strong>제목:</strong> <?= $row['title']; ?><br>
        <strong>내용:</strong><br>
        <?= $row['content']; ?>
    </fieldset>

    <?php
        // 사용자 정보와 작성자 계정이 일치하는 경우
        // 수정, 삭제 버튼 활성화
        if ($account == $row['account']) {
            echo "<button><a href='update.php?id=$id'>수정</a></button>";
            echo "<button><a href='delete.php?id=$id'>삭제</a></button>";
        }
    ?>

    <hr>

    게시판 목록으로 돌아가시겠습니까? 
    <a href="index.php">돌아가기</a>
</body>
</html>