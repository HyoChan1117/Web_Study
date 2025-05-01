<?php
    $name = $_POST["name"];
    $tel = $_POST["tel"];
    $address = $_POST["address"];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결과</title>
</head>
<body>
    <h3>POST로 전달받은 데이터 출력하기</h3>
    이름 : <?php echo $name;?><br>
    전화번호 : <?php echo $tel;?><br>
    주소 : <?php echo $address?><br>
</body>
</html>