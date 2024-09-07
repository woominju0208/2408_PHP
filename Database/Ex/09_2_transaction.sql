-- Transaction(트랜잭션) 시작(DML사용)
START TRANSACTION;


-- insert
INSERT INTO employees (
	NAME, birth, gender, hire_at
)
VALUES(
	'농담곰', '2000-01-01', 'M', DATE(NOW())
);

-- select
SELECT * FROM employees WHERE emp_id >=100001;

-- 다른 프로그램(통로)으로 연결시 데이터가 나오지 않음(heidi 의 트랜직션과 cmd의 트랜직션이 다름)
-- 트랜직션 Commit을 하지 않았기 때문에 cmd 에선 검색이 되지 않음

-- rollback
ROLLBACK;

-- commit
COMMIT;

-- rollback, commit 을 하면 다시 START TRANSACTION;을 해줘야 한다
-- TRANSACTION은 데이터에만 관련 해 있어서 PK의 auto_increment는 테이블의 구조를 바꾸지 못하기  때문에 적용 x
-- TRANSACTION의 일관성(Consistency)
-- 그래서 rollback, commit을 해도 100001에서 100002로 나오는것