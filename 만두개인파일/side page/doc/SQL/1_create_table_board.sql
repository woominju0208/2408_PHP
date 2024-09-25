-- CREATE DATABASE 
CREATE DATABASE
-- mini_board가 존재하지 않는다면 생성
if NOT EXISTS mini_board;

-- USE DATABASE
USE mini_board;

-- board 테이블이 존재한다면 삭제
DROP TABLE IF EXISTS board;


-- mini_table 생성
CREATE TABLE board (
	id 			BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT 
	,title 		VARCHAR(50) 	NOT NULL
	,content 	VARCHAR(1000) 	NOT NULL
	,created_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP 		NULL
	)
;	



	 