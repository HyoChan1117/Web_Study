-- 데이터베이스 만들기
CREATE DATABASE login1;

-- 데이터베이스 사용하기
USE login;

-- 테이블 만들기
-- CREATE TABLE 테이블 이름
--     이름 자료형 속성
CREATE TABLE login (
    name VARCHAR(100) NOT NULL,
    id VARCHAR(255) PRIMARY KEY,
    pw VARCHAR(255) NOT NULL
);