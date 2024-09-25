INSERT INTO board(
	title
	,content
)
VALUES 
('제목14','내용14')
,('제목15','내용15')
,('제목16','내용16')
,('제목17','내용17')
,('제목18','내용18')
,('제목19','내용19')
,('제목20','내용20')
,('제목21','내용21')
,('제목22','내용22')
,('제목23','내용23');

SELECT COUNT(*)
FROM board
WHERE
	deleted_at IS NULL
;
