<?php
    $name = $_POST["name"]; // 이름
    $pass = $_POST["pass"]; // 비밀번호
    $subject = $_POST["subject"]; // 제목
    $content = $_POST["content"]; // 내용

    $subject = htmlspecialchars($subject, ENT_QUOTES); // HTML 특수문자 처리
    $content = htmlspecialchars($content, ENT_QUOTES); // HTML 특수문자 처리
    $regist_day = date("Y-m-d (H:i)"); // 현재 시간

    $con = mysqli_connect("localhost","user","12345","freebaord"); // DB 연결

    $sql = "select min(t1.num + 1) as next_num
            from users t1
            left join users t2 on t1.num + 1 = t2.num
            where t2.num is null"; // num 중 최소값 가져오기
    $result = mysqli_query($con, $sql); // 쿼리 실행
    $row = mysqli_fetch_array($result); // 레코드 가져오기

    // 비어있는 num이 없으면 최댓값 + 1 사용 (테이블이 비어 있으면 1부터 시작)
    $next_num= $row["next_num"] ?? 1;

    // 최대값 + 1을 사용하여 레코드 번호 맞추기
    $sql_max = "select ifnull(max(num) + 1, 1) as new_num from users"; // num 중 최대값 가져오기
    $result_max = mysqli_query($con, $sql_max); // 쿼리 실행
    $row_max = mysqli_fetch_array($result_max); // 레코드 가져오기

    if (!$next_num) {
        $next_num = $row_max["new_num"];
    }
    
    $sql = "insert into users(num, name, pass, subject, content, regist_day) "; 
    $sql .= "values($next_num,'$name', '$pass', '$subject', '$content', '$regist_day')"; 

    mysqli_query($con, $sql); // 쿼리 실행
    mysqli_close($con); // DB 연결 종료

    // 목록 페이지로 이동
    // header를 사용해서 강제로 페이지 이동
    header("Location: list.php");
    exit(); // 코드 종료(불필요한 코드 실행 방지)

?>