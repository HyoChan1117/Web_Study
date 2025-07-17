<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <!-- PHP 스크립트 작성 -->
    <?php  // php 스키립트 시작
    // Super Global Variable : PHP 엔진에서 제공되는 변수, 전역 변수 범위
    // Form 형식 : Post, Get
    // $_POST
    // $_GET
    // 해쉬 맵 : key와 value
      if($_GET["bar"] > 10)
        echo "<h1 style='color: red'>Hello</h1>";
      else
        echo "<h1 style='color: green'>Hello</h1>";
    ?>
  </body>
</html>
