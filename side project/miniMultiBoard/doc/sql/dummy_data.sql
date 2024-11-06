-- 게시판 카테고리 정보 추가
INSERT INTO boards_category(bc_type, bc_name)
VALUES('2', '문의게시판')
,('3', '만두게시판')
;

-- 테스트용 유저 추가
INSERT INTO users(
	u_email
	,u_name
	,u_password
)VALUES(
	'admin@admin.com'
	,'관리자'
	,'cXdlMTIz'
);

-- 테스트용 게시글 추가
INSERT INTO boards(
	u_id
	,bc_type
	,b_title
	,b_content
	,b_img)
VALUES
(3,'3','문의1','문의내용1','/View/img/다운로드.jfif')
,(3,'3','문의2','문의내용2','/View/img/843689388f56fabb7cb64da9cfbc772f.jpg')
,(3,'3','문의3','문의내용3','/View/img/1590471745952.jpg')
;

SELECT 
	boards.b_title
	,boards.b_content
	,boards.b_img
	,users.u_name
FROM boards
JOIN users
ON boards.u_id = users.u_id
WHERE
	b_id
	AND boards.deleted_at IS NULL
;