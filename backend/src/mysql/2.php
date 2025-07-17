<?php


    print_r($_POST);
    // API를 이용하여 MySQL 데이터베이스에 연결
    // 이 클래스 안에 있는 생성자에 접근하여 MySQL 데이터베이스에 연결
    // 프로그램 안에서는 DBMS를 연결하여 데이터베이스에 접근할 수 있다.
    // db 라는 주소를 가지는 mysql에 접속
    // 인증 ID : root
    // 패스워드 : root
    // 선택DB : gsc
    // 내부적으로 mysql이 돌아감
    // API를 사용할 때 어떤 sql문이 실행되는지 알 수 없음
    // CLI 상에서!
    // mysql -u root -p
    // root
    // use gsc;
    // mysqli라는 클래스는 어떤 메소드를 가지고 있는지 확인할 수 있다.
    // var_dump($db_conn);

    // 1번 작업 : DBMS와의 연결 설정
    $db_conn = new mysqli('db', 'root', 'root', 'gsc');
    
    // 연결 결과 확인
    // 연결 실패 시 -> 프로그램 종료
    if ($db_conn->errno) {
        echo "연결 실패: " . $db_conn->connect_error;
        exit;
    }

    // 연결 성공
    echo "DBMS 연결 성공, gsc db 선택 완료";

    // 2번 작업 : SQL 전송

    // 새로운 레코드를 생성

    // 2-1 : SQL문 작성 -> 문자열을 이용하여 실행하고 하는 SQL문을 생성
    $std_id = $_POST['std_id'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $birth = $_POST['birth'];

    $sql = "delete from student where std_id = '$std_id'";


    echo $sql;  // SQL문 출력

    // 2-2 : SQL문 전송(Client -> DBMS Server)
    // mysqli의 객체를 이용하여 SQL문을 전송
    // $result 결과 값
    // 1) true
    // 2) Instance of mysqli_result class
    // 3) false
    $result = $db_conn->query($sql);
    // ----------------------------------------

    // 3번 작업 : 반환 값 처리
    // 쿼리문의 결과값이 true인 경우
    if ($result) {
        echo "<hr><br>레코드 생성 성공<br><hr>";
    } else {
        echo "<hr><br>레코드 생성 실패";
    }

    // 쿼리문의 결과값이 false인 경우

    // 4번 작업 : 연결 성공
    $db_conn->close();

?>