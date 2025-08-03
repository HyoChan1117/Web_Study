<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h2>회원가입</h2>
    <form action="register_process.php" method="post">
        <fieldset>
            <legend>정보 입력</legend>
            아이디: <input type="text" name="id"><br><br>
            비밀번호: <input type="text" name="pw"><br><br>
            이름: <input type="text" name="name"><br><br>
            <button>회원가입</button>
        </fieldset>
    </form>
</body>
</html>