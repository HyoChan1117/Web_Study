<?php
//POST 방식으로 전달된 num 값을 변수에 저장
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = $_POST["num"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    
    $con = mysqli_connect("localhost","user","12345","freebaord"); // DB 연결
    $sql = "update users set subject = '$subject', content = '$content' where num = $num"; // num이 일치하는 레코드 수정
    mysqli_query($con, $sql); // 쿼리 실행

    mysqli_close($con); // DB 연결 종료
    header("Location: list.php"); // 목록 페이지로 이동
    exit(); // 코드 종료
}
?>