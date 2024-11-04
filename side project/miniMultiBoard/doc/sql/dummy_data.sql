-- 게시판 카테고리 정보 추가
INSERT INTO boards_category(bc_type, bc_name)
VALUES('0', '자유게시판')
,('1', '질문게시판')
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
(1,'0','자유1','자유내용1','/View/img/따봉-따봉담곰.png')
,(1,'0','자유2','자유내용2','/View/img/따봉-따봉담곰.png')
,(1,'0','자유3','자유내용3','/View/img/따봉-따봉담곰.png')
,(1,'1','질문1','질문내용1','/View/img/따봉-따봉담곰.png')
,(1,'1','질문2','질문내용2','/View/img/따봉-따봉담곰.png')
;