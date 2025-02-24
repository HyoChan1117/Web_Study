<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시판 작성</title>
</head>
<body>
  <h3>게시판 > 글쓰기</h3>
  <!-- enctype 속성을 추가하여 파일 업로드 가능 -->
  <form action="insert_process.php" method="post" enctype="multipart/form-data">
      이름 : <input type="text" name="name" placeholder="이름을 입력하세요"><br><br>
      비밀번호 : <input type="password" name="password" placeholder="비밀번호를 입력하세요"><br><br>
      제목 : <input type="text" name="subject" placeholder="제목을 입력하세요"><br><br>
      내용 : <br><textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요"></textarea><br><br>
      파일 첨부 : <input type="file" name="attachment"><br><br>
      <input type="submit" value="저장">
      <input type="reset" value="초기화"><br><br><hr>
  </form>
  게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a>
</body>
</html>
