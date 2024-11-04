-- DataBase
mini_boardmini_boardCREATE DATABASE mini_multi_board;
USE mini_multi_board;
-- 1) users(유저) Table
-- 	- PK, 이메일, 비밀번호, 이름, 가입일자, 수정일자, 탈퇴일자
CREATE TABLE users(
	u_id				BIGINT UNSIGNED			PRIMARY KEY AUTO_INCREMENT 
	,u_email			VARCHAR(100)				NOT NULL
	,u_password		VARCHAR(256) BINARY		NOT NULL	 
-- 실제 패스워드는 암호화기 때문에 기본 256자 보안을 더 강하게 하면 512자를 쓴다.
-- BINARY : 대소문자 구분
	,u_name			VARCHAR(50)					NOT NULL
	,created_at		TIMESTAMP					NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP					NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);

-- 2) boards(게시판) Table
-- 	- PK, 유저PK, 게시판타입, 제목, 내용, 이미지파일, 가입일자, 수정일자, 탈퇴일자
CREATE TABLE boards(
	b_id				BIGINT UNSIGNED			PRIMARY KEY AUTO_INCREMENT 
	,u_id				BIGINT UNSIGNED			NOT NULL
	,bc_type			CHAR(1)						NOT NULL 
	,b_title			VARCHAR(50)					NOT NULL 
	,b_content		VARCHAR(200)				NOT NULL 
	,b_img			VARCHAR(100)				NOT NULL
	,created_at		TIMESTAMP					NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,updated_at		TIMESTAMP					NOT NULL DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);

-- 3) boards category(게시판 기본 정보) Table
-- 	- PK, 게시판타입, 게시판이름
CREATE TABLE boards_category (
	bc_id				BIGINT UNSIGNED			PRIMARY KEY AUTO_INCREMENT
-- 	UNIQUE : 중복되지 않는 값을 줌
	,bc_type			CHAR(1)						NOT NULL	UNIQUE
	,bc_name			VARCHAR(20)					NOT NULL 
);

-- FK 추가
ALTER TABLE boards
ADD CONSTRAINT fk_boards_u_id
FOREIGN KEY (u_id)
REFERENCES users(u_id)
;

ALTER TABLE boards
ADD CONSTRAINT fk_boards_bc_type
FOREIGN KEY (bc_type)
REFERENCES boards_category(bc_type)
;
