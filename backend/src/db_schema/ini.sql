-- 부모 테이블
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 자식 테이블
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    views INT NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    -- 외래 키(FOREIGN KEY) 제약(CONSTRAINT)
    CONSTRAINT fk_posts_user FOREIGN KEY (user_id)  -- 외래 키 이름 및 대상 컬럼
        REFERENCES users(id)  -- 식별자 / 부모(users) 테이블에 있는 키 값(id)을 참조
        -- 참조 작업
        -- CASCADE: 부모 테이블의 행을 삭제하거나 업데이트하고, 자식 테이블의 일치하는 행도 자동으로 삭제하거나 업데이트
        ON DELETE CASCADE   -- 부모 삭제 시 자식도 삭제
        ON UPDATE CASCADE   -- 부모의 PRIMARY KEY 변경 시 자식도 변경
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
