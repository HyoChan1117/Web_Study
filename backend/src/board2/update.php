<?php

    // id 값 유효성 검사
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않는 id 값일 경우
    // id 값이 유효하지 않습니다. -> 게시판 목록 페이지 리다이렉션
    if (empty($id)) {
        header("Refresh: 2; URL='index.php'");
        echo "id 값이 유효하지 않습니다.";
        exit;
    }

    // 데이터베이스 연결을 위한 변수 불러오기
    require_once './db_connect.php';

    try {
        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board WHERE id=$id";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();
        
        // 예외 처리
        // 해당 게시글이 없을 경우
        // 잘못된 접근입니다. -> 게시판 목록 페이지 리다이렉션
        if ($result->num_rows <= 0) {
            header("Refresh: 2; URL='index.php'");
            echo "잘못된 접근입니다.";
            exit;
        }

    } catch (Exception $e) {
        // DB 오류 발생
        echo "DB 오류 발생<br>".$e;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 사용자 정보 불러오기
    require_once './header.php';

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <!--
    게시판 목록 > 게시글 수정

    FORM
    Action: update_process.php
    Method: post
    입력값: 제목(title), 내용(content) -> 해당 게시글 데이터 불러오기
    -->
    <h1>게시판 목록 > 게시글 수정</h1>
    <form action="update_process.php?id=<?= $row['id']; ?>" method='post'>
        <fieldset>
            제목: <input type="text" name="title" value="<?= $row['title']; ?>"><br>
            내용: <br>
            <textarea cols='30' rows='5' name="content"><?= $row['content']; ?></textarea>
        </fieldset>
        <button>수정</button>
        <input type="reset" value="초기화">
    </form>
    <hr>
    해당 게시글로 돌아가시겠습니까? 
    <a href="read.php?id=<?= $id; ?>">돌아가기</a>
</body>
</html>