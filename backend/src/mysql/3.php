<?php
    require_once 'db_conf.php';

    try {
        // 1. 연결 설정
        $db_conn = new mysqli(DB_INFO::DB_HOST, DB_INFO::DB_USER, DB_INFO::DB_PASSWORD, DB_INFO::DB_NAME);

        // 연결 결과 확인
        if ($db_conn->errno) {
            echo "연결 실패: " . $db_conn->connect_error;
            exit;
        }
        
        echo "DBMS 연결 성공, gsc db 선택 완료";

        // 2. SQL 전송
        // 새로운 레코드를 생성
        // 2-1 : SQL문 작성

        $sql = "select * from student";

        $result = $db_conn->query($sql);

        // var_dump($result);의 결과는 mysqli_result 객체
        // var_dump($result);

        // 레코드 개수
        // echo $result->num_rows;

        // 3. 반환 값 처리
        if (!$result) {
            echo "<hr><br>레코드 조회 실패";
            exit;
        } else {
            echo "<hr><br>레코드 조회 성공<br><hr>";
        }

        // 결과값을 처리하는 코드
        while ($row = $result->fetch_assoc()) {
            echo $row["std_id"]. "<br>";
            echo $row["id"]. "<br>";
            echo $row["name"]. "<br>";
            echo $row["age"]. "<br>";
            echo $row["birth"]. "<br>";
            echo "<hr><br><br>";
        }
    } catch (Exception $e) {
        echo "오류 발생: " . $e->getMessage();
    }

    // 4. 연결 종료
    $db_conn->close();

?>