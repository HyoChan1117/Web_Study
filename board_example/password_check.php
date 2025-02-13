<?php
// POST 방식으로 전달된 값이 있는지 확인 후 처리
$num = $_POST["num"];
$action = $_POST["action"];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>미니게시판 비밀번호 확인</title>
</head>
<body>
    <h2>비밀번호 확인</h2>
    <form method="post" action="password_check.php">
        <input type="hidden" name="num" value="<?php echo htmlspecialchars($num, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="action" value="<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>">
        비밀번호: <input type="password" name="pass" required>
        <input type="submit" value="확인">
    </form>

<?php 
// 비밀번호 검증 로직은 POST 요청이면서 비밀번호 값이 존재할 때만 실행
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pass"])) {
    $num = $_POST["num"];
    $action = $_POST["action"];
    $input_pass = $_POST["pass"];

    // DB 연결
    $con = mysqli_connect("localhost", "user", "12345", "freebaord");

    // SQL 실행
    $sql = "SELECT pass FROM users WHERE num = $num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    mysqli_close($con);

    if ($row && isset($row["pass"]) && $row["pass"] === $input_pass) {
        if ($action === "edit") {
            header("Location: edit.php?num=$num");
        } else if ($action === "delete") {
            header("Location: delete.php?num=$num");
        }
        exit();
    } else {
        echo "비밀번호가 일치하지 않습니다.";
    }
}
?>
</body>
</html>
