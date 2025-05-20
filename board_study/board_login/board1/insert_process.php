<?php
    include("db_connect.php");

    // 폼에서 입력한 값 가져오기
    $name = $_POST["name"];
    $password = $_POST["password"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // 입력값 검증 (이름, 제목, 내용 중 하나라도 비어 있으면 게시글 저장 불가)
    if (empty($name) || empty($subject) || empty($content)) {
        echo "이름, 제목, 내용은 필수 입력 항목입니다";
        header("Refresh: 1; URL=list.php");
        exit;
    }

    // 게시글 저장
    $sql = "INSERT INTO board (name, password, subject, content) VALUES ('$name', '$password', '$subject', '$content')";

    // 쿼리 실행 -> MySQL에서 $sql에 해당하는 쿼리 실행 : 실행이 성공하면 True 반환
    if ($conn->query($sql) === TRUE) {
        echo "글이 등록되었습니다.";
        header("Refresh: 2; URL=list.php");
    } 
    // 오류가 났을 경우
    else {
        echo "오류: " . $conn->connect_error;
        header("Refresh: 2; URL=list.php");
    }
    
    // 연결 닫기
    $conn->close();
?>
