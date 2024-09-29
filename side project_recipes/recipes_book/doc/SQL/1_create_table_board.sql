CREATE DATABASE recipes_book;

CREATE TABLE board (
	id 			BIGINT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT 
	,title 		VARCHAR(50) 	NOT NULL
	,content 	VARCHAR(1000) 	NOT NULL
	,image		VARCHAR(500)	NOT NULL
	,created_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,updated_at TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP()
	,deleted_at TIMESTAMP 		NULL
)
;

INSERT INTO board(
	title
	,content
	,image
)
VALUES
('제목1','내용1','C:\Apache24\htdocs\img.1.jpg')
,('제목2','내용2','C:\Apache24\htdocs\img.1.jpg')
,('제목3','내용3','C:\Apache24\htdocs\img.1.jpg')
,('제목4','내용4','C:\Apache24\htdocs\img.1.jpg')
,('제목5','내용5','C:\Apache24\htdocs\img.1.jpg')
,('제목6','내용6','C:\Apache24\htdocs\img.1.jpg')
,('제목7','내용7','C:\Apache24\htdocs\img.1.jpg')
,('제목8','내용8','C:\Apache24\htdocs\img.1.jpg')
,('제목9','내용9','C:\Apache24\htdocs\img.1.jpg')
,('제목10','내용10','C:\Apache24\htdocs\img.1.jpg')
;