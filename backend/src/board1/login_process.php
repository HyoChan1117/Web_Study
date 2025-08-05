<?php

    // 데이터베이스 연결
    include "./db_connect.php";
    
    // 세션 시작
    session_start();

    // form 입력 값 가져오기
    $name = $_POST['name'];
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    // sql문 작성
    $query = "SELECT * FROM login WHERE id='$id'"

    // 쿼리 실행
    

    // 데이터베이스 종료


?>