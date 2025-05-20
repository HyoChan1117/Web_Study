-- 데이터베이스 생성
CREATE DATABASE board_login1

-- 데이터베이스 사용
USE board_login1

-- 테이블 생성
CREATE TABLE board (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    subject VARCHAR(20) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- 테스트 목록
INSERT INTO board (name, password, subject, content) VALUES
("테스트1", "123", "테스트1", "테스트 1입니다.")