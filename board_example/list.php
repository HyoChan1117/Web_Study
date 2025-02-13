<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>미니게시판 리스트</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- style.css 파일을 불러옴 -->
</head>
<body>
    <h2>자유게시판 > 글 목록</h2> <!-- 제목 -->
    <li>
        번호
        제목
        글쓴이
        등록일
    </li>
<?php 
    // DB 연결
    $con = mysqli_connect("localhost","user","12345","freebaord");
    $sql = "select * from users order by num desc"; // 내림차순 정렬
    $result = mysqli_query($con, $sql); // 쿼리 실행
    $total_record = mysqli_num_rows($result); // 전체 레코드 수

    $number = $total_record;
    for ($i=0; $i<$total_record; $i++) {
        mysqli_data_seek($result, $i); // 포인터 이동
        $row = mysqli_fetch_array($result); // 레코드 가져오기
        
        $num = $row["num"]; // 번호
        $name = $row["name"]; // 이름
        $subject = $row["subject"]; // 제목
        $regist_day = $row["regist_day"]; // 등록일
        
        echo "---------------------------------------------------";
        echo "<br>";
        echo "<tr>";
        echo "<td>$num</td>"; // 번호 출력
        echo "<td><a href='view.php?num=$num'>$subject</a></td>"; // 제목 출력
        echo "<td>$name</td>"; // 이름 출력
        echo "<td>$regist_day</td>"; // 등록일 출력
        echo "</tr>";
        echo "<br>";
        $number--;
    }
    mysqli_close($con); // DB 연결 종료  
?>
    <br>
    <button onclick="location.href='form.php'">글쓰기</button> <!-- 글쓰기 버튼 -->
</body>
</html>