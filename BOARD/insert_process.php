<?php
    // MySQL 연결을 위한 변수
    $servername = "localhost";
    $username = "hyochan";
    $password = "40957976";
    $database = "board_login";

    // MySQL 연결
    $conn = new mysqli($servername, $username, $password, $database);

    // 연결 확인
    if ($conn->connect_error) {
        die("연결 실패: " . $conn->connect_error);
    }

    // 폼에서 입력한 값 가져오기
    $name = $_POST["name"];
    $password = $_POST["password"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // 입력값 검증 (이름, 제목, 내용 중 하나라도 비어 있으면 게시글 저장 불가)
    if (empty($name) || empty($subject) || empty($content)) {
        echo "<script>alert('이름, 제목, 내용은 필수 입력 항목입니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=list.php'>";
        exit;
    }

    // 게시글 저장
    $sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";

    // 쿼리 실행 -> MySQL에서 $sql에 해당하는 쿼리 실행 : 실행이 성공하면 True 반환
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('글이 등록되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0;url=list.php'>";
    } 
    // 오류가 났을 경우
    else {
        echo "<script>alert('오류: " . $conn->error . "');</script>";
        echo "<meta http-equiv='refresh' content='0;url=list.php'>";
    }
    
    // 연결 닫기
    $conn->close();
?>
