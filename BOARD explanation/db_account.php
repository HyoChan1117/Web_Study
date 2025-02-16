<?php
// 데이터베이스 연결 정보 설정
$servername = "localhost";
$username = "hyochan";  // MySQL 계정 이름
$password = "40957976";  // MySQL 계정 비밀번호
$database = "board_login";  // 사용할 데이터베이스 이름

// MySQL 연결 (객체 지향 방식)
$conn = new mysqli($servername, $username, $password, $database);

// 연결 확인 (연결 실패 시 오류 메시지 출력 후 종료)
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// POST 데이터 받기 (사용자 입력값)
$id = isset($_POST['id']) ? trim($_POST['id']) : ''; // 아이디 입력값
$pass = isset($_POST['pass']) ? $_POST['pass'] : ''; // 비밀번호 입력값
$pass_check = isset($_POST['pass_check']) ? $_POST['pass_check'] : ''; // 비밀번호 확인

// 1. 아이디와 비밀번호 입력 여부 확인
if (empty($id) || empty($pass) || empty($pass_check)) {
    die("아이디와 비밀번호를 모두 입력해야 합니다. <a href='join.php'>다시 시도</a>");
}

// 2. 비밀번호 확인 체크
if ($pass !== $pass_check) {
    die("비밀번호가 일치하지 않습니다. <a href='join.php'>다시 시도</a>");
}

// 3. 중복 ID 확인 (Prepared Statement 미사용 → 보안 취약)
$sql = "SELECT id FROM login WHERE id = '$id'";  // ❌ SQL Injection 가능성 있음
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 중복 ID 존재 시 회원가입 불가
    echo "이미 존재하는 아이디입니다. <a href='join.php'>다시 입력</a>";
    $conn->close();
    exit();
}

// 4. 회원가입 처리 (Prepared Statement 미사용 → 보안 취약)
$sql = "INSERT INTO login (id, password) VALUES ('$id', '$pass')"; // ❌ SQL Injection 가능성 있음

if ($conn->query($sql) === TRUE) {
    echo "회원가입이 완료되었습니다. <a href='login.php'>로그인</a>";
} else {
    echo "회원가입 실패: " . $conn->error;
}

// 5. 데이터베이스 연결 종료
$conn->close();
?>
