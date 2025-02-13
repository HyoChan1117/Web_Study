<?php 
$num = $_GET["num"]; // num

// DB 연결
$con = mysqli_connect("localhost","user","12345","freebaord");
$sql = "delete from users where num = $num"; // num이 일치하는 레코드 삭제

mysqli_query($con, $sql); // 쿼리 실행
mysqli_close($con); // DB 연결 종료

header("Location: list.php"); // 목록 페이지로 이동
exit(); // 코드 종료

?>