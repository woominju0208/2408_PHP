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
('제목1','내용1','C:/Apache24/htdocs/img/1.jpg')
,('제목2','내용2','C:/Apache24\htdocs\img/1.jpg')
,('제목3','내용3','C:\Apache24\htdocs\img/1.jpg')
,('제목4','내용4','C:\Apache24\htdocs\img/1.jpg')
,('제목5','내용5','C:\Apache24\htdocs/img/1.jpg')
,('제목6','내용6','C:\Apache24\htdocs\img\1.jpg')
,('제목7','내용7','C:\Apache24\htdocs\img\1.jpg')
,('제목8','내용8','C:\Apache24\htdocs\img\1.jpg')
,('제목9','내용9','C:\Apache24\htdocs\img\1.jpg')
,('제목10','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목11','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목12','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목13','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목14','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목15','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목16','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목17','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목18','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목19','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목20','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목21','내용10','C:\Apache24\htdocs\img\1.jpg')
,('제목22','내용10','C:\Apache24\htdocs\img\1.jpg')
;

INSERT INTO board(
	title
	,content
	,image
)
VALUES
('제목12','내용12','/img/1.jpg')
,('제목13','내용13','/img/1.jpg')
,('제목14','내용14','/img/1.jpg')
,('제목15','내용15','/img/1.jpg')
,('제목16','내용16','/img/1.jpg')
,('제목17','내용17','/img/1.jpg')
,('제목18','내용18','/img/1.jpg')
,('제목19','내용19','/img/1.jpg')
,('제목20','내용20','/img/1.jpg')
,('제목21','내용21','/img/1.jpg')
,('제목22','내용22','/img/1.jpg')
,('제목23','내용23','/img/1.jpg')
;

INSERT INTO board(
	title
	,content
	,image
)
VALUES
('제목1','내용1','C:/Apache24/htdocs/img/1.jpg')
,('제목2','내용2','C:/Apache24/htdocs/img/1.jpg')
,('제목3','내용3','C:/Apache24/htdocs/img/1.jpg')
,('제목4','내용4','C:/Apache24/htdocs/img/1.jpg')
,('제목5','내용5','C:/Apache24/htdocs/img/1.jpg')
,('제목6','내용6','C:/Apache24/htdocs/img/1.jpg')
,('제목7','내용7','C:/Apache24/htdocs/img/1.jpg')
,('제목8','내용8','C:/Apache24/htdocs/img/1.jpg')
,('제목9','내용9','C:/Apache24/htdocs/img/1.jpg')
,('제목10','내용10','C:/Apache24/htdocs/img/1.jpg')
,('제목11','내용11','C:/Apache24/htdocs/img/1.jpg')
,('제목12','내용12','C:/Apache24/htdocs/img/1.jpg')
,('제목13','내용13','C:/Apache24/htdocs/img/1.jpg')
,('제목14','내용14','C:/Apache24/htdocs/img/1.jpg')
,('제목15','내용15','C:/Apache24/htdocs/img/1.jpg')
,('제목16','내용16','C:/Apache24/htdocs/img/1.jpg')
,('제목17','내용17','C:/Apache24/htdocs/img/1.jpg')
,('제목18','내용18','C:/Apache24/htdocs/img/1.jpg')
,('제목19','내용19','C:/Apache24/htdocs/img/1.jpg')
,('제목20','내용20','C:/Apache24/htdocs/img/1.jpg')
,('제목21','내용21','C:/Apache24/htdocs/img/1.jpg')
,('제목22','내용22','C:/Apache24/htdocs/img/1.jpg')
,('제목23','내용23','C:/Apache24/htdocs/img/1.jpg')
,('제목24','내용24','C:/Apache24/htdocs/img/1.jpg')
,('제목25','내용25','C:/Apache24/htdocs/img/1.jpg')
,('제목26','내용26','C:/Apache24/htdocs/img/1.jpg')
,('제목24','내용24','C:/Apache24/htdocs/img/1.jpg')
,('제목25','내용25','C:/Apache24/htdocs/img/1.jpg')
,('제목26','내용26','C:/Apache24/htdocs/img/1.jpg')
,('제목27','내용27','C:/Apache24/htdocs/img/1.jpg')
,('제목28','내용28','C:/Apache24/htdocs/img/1.jpg')
,('제목29','내용29','C:/Apache24/htdocs/img/1.jpg')
,('제목30','내용30','C:/Apache24/htdocs/img/1.jpg')
,('제목31','내용31','C:/Apache24/htdocs/img/1.jpg')
,('제목32','내용32','C:/Apache24/htdocs/img/1.jpg')
,('제목33','내용33','C:/Apache24/htdocs/img/1.jpg');
;

ALTER TABLE board MODIFY COLUMN image VARCHAR(30)	NULL;

