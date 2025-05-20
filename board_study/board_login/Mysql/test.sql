-- 데이터베이스 생성
CREATE DATABASE SchoolDB;
USE SchoolDB;

-- 테이블 생성
-- 학생 테이블 생성
CREATE TABLE Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    major VARCHAR(100),
    enrollment_year INT
);

-- 교수 테이블 생성
CREATE TABLE Course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL
);
