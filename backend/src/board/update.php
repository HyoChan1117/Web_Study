<?php

    // id 값 가져오기
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    // 유효하지 않은 값을 받았을 경우
    // 오류 메시지 출력
    if (empty($id)) {
        echo "잘못된 접근입니다.";
        exit;
    }

    // try
    try {
        // 데이터베이스 연결을 위한 변수값 불러오기
        require_once "./db_connect.php";

        // 데이터베이스 연결
        $db_conn = new mysqli($hostname, $username, $password, $database);

        // 계정 정보 비교 알고리즘 불러오기
        require_once "./check_account.php";

        // sql문 작성 (SELECT)
        $sql = "SELECT title, content FROM board WHERE id='$id';";

        // 쿼리 실행
        $result = $db_conn->query($sql);
        $row = $result->fetch_assoc();
        }
    // catch
    catch (Exception $e) {
        // 데이터베이스 연결 실패 시
        // 오류 메시지 출력 후 해당 게시글 읽기 페이지 리다이렉션
        header("Refresh: 2; read.php?id='$id'");
        echo "DB 연결 실패";
        exit;
    }
    // 로그인 정보 출력
    require_once "./header.php";
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
    게시물 > 목록 > 게시글 > 수정

    제목:
    내용:

    수정 버튼 활성화
    -->
    <h1>게시물 > 목록 > 게시글 > 수정</h1>
    <form action="<?php echo "update_process.php?id=$id"; ?>" method="post">
        <fieldset>
            제목: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
            내용:<br>
            <textarea name="content"><?php echo $row['content']; ?></textarea><br>
        </fieldset>
        <button>수정</button>
        <input type="reset" value="초기화">
    </form>
    <hr>
    해당 게시글로 돌아가시겠습니까? <a href="<?php echo "read.php?id=$id"; ?>">돌아가기</a>
</body>
</html>