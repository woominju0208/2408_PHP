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


SELECT *
FROM users
WHERE YEAR(created_at) = '2024';

SELECT *
FROM users
WHERE created_at >= '2024-01-01 00:00:00'
	AND created_at <= '2024-12-31 23:59:59';
	
SELECT 
		bc_type
		,COUNT(*) cnt
FROM boards
WHERE deleted_at IS NULL
GROUP BY bc_type
HAVING bc_type = 0;

SELECT *
FROM boards
WHERE
	(b_title LIKE '%자유%'
	OR b_title LIKE '%질문%')
	AND deleted_at IS null
;

-- 게시글을 쓴 게시판보드이름,작성자,게시글제목
SELECT
	boards_category.bc_name 
	,boards.b_title AS '제목'
	,users.u_name	AS '작성자'
FROM boards
JOIN boards_category
	ON boards.bc_type = boards_category.bc_type
JOIN users
	ON boards.u_id = users.u_id
	WHERE users.deleted_at IS NULL
		AND boards.deleted_at IS NULL
;

SELECT
	boards.b_title
	,boards.b_content
	,users.u_name
FROM boards
	INNER JOIN users
		ON boards.u_id = users.u_id
		WHERE users.deleted_at IS NULL
;

-- ---------------------------------------
-- boardList 게시판 정보 출력
SELECT *
FROM boards
WHERE deleted_at IS NULL
ORDER BY created_at DESC, b_id DESC 
;