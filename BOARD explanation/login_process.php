<?php
session_start(); // 세션 시작 (로그인 상태를 유지하기 위해 필요)

// 데이터베이스 연결 정보 설정
$servername = "localhost";  // 데이터베이스 서버 주소 (로컬호스트 사용)
$username = "hyochan";      // 데이터베이스 계정 이름
$password = "40957976";     // 데이터베이스 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결 (객체 지향 방식)
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 오류 메시지 출력 후 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 사용자가 입력한 ID와 비밀번호를 POST 방식으로 가져옴
$id = $_POST['id'];
$pass = $_POST['password'];

// **보안 취약점: SQL 인젝션 가능성 있음!**
// 아래 쿼리는 사용자의 입력값을 직접 SQL 쿼리에 삽입하기 때문에 SQL Injection 공격에 취약함
$sql = "SELECT * FROM login WHERE id = '$id' AND password = '$pass'";
$result = $conn->query($sql);

// 로그인 검증
if ($result->num_rows > 0) {  
    // 로그인 성공: 세션에 사용자 정보 저장
    $_SESSION['username'] = $id; 

    // 로그인 성공 메시지를 알림창으로 띄운 후, 게시판 목록 페이지로 이동
    echo "<script>alert('로그인 성공!'); location.href='list.php';</script>";
    exit(); // 코드 실행 종료
} else {
    // 로그인 실패: 아이디 또는 비밀번호가 틀린 경우
    echo "<script>alert('로그인 실패: 아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
    exit(); // 코드 실행 종료
}

// 데이터베이스 연결 종료
$conn->close();
?>
