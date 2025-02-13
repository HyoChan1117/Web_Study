CREATE TABLE freeboard (
    num INT NOT NULL AUTO_INCREMENT,  -- 게시글 번호 (자동 증가, 기본 키)
    name CHAR(20) NOT NULL,           -- 작성자 이름 (최대 20자, 반드시 입력)
    pass CHAR(20) NOT NULL,           -- 게시글 비밀번호 (최대 20자, 반드시 입력)
    subject CHAR(200) NOT NULL,       -- 게시글 제목 (최대 200자, 반드시 입력)
    content TEXT,                     -- 게시글 내용 (제한 없음)
    regist_day CHAR(20),              -- 등록 날짜 (문자열 형식, 20자)
    PRIMARY KEY (num)                 -- num을 기본 키로 설정 (중복 불가, 고유한 값)
);