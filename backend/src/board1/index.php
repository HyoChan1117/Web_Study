<?php

    // 데이터베이스 연결
    try {
        // 데이터베이스 연결
        require_once "./db_connect.php";

        // sql문 작성 (SELECT)
        $sql = "SELECT * FROM board ORDER BY created_at DESC;";

        // 쿼리 실행
        $result = $db_conn->query($sql);
    } catch (Exception $e) {
        // DB 관련 오류 메시지 출력
        echo "DB 오류<br>".$e ;
    }

    // 데이터베이스 종료
    $db_conn->close();

    // 로그인 정보 불러오기
    require_once "./header.php";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
    
</head>
<body>
    <!--
    안녕하세요! [사용자 이름(사용자 아이디)]님 "로그아웃(버튼)"

    게시판 목록

    Table 생성
    번호 작성자 제목 작성일 수정일
    
    글쓰기 버튼 활성화 -> insert.php
    -->
    <h1>게시판 목록</h1>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>작성자</th>
            <th>제목</th>
            <th>작성일</th>
            <th>수정일</th>
        </tr>

        <?php
            // DB board 테이블 출력
            // 게시글이 없을 경우
            if ($result->num_rows <= 0) {
                echo "<tr>";
                echo "  <td colspan='5'>게시글이 없습니다.</td>";
                echo "</tr>";
            } else {     // 게시글이 있을 경우
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "  <td>$row[id]</td>";
                    echo "  <td>$row[name]</td>";
                    echo "  <td><a href='read.php?id=$row[id]'>$row[title]</a></td>";
                    echo "  <td>$row[created_at]</td>";
                    echo "  <td>$row[updated_at]</td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
    <button><a href="insert.php">글쓰기</a></button>
    
</body>
</html>