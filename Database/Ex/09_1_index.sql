-- INDEX 확인 (컬럼에 추가)
SHOW INDEX FROM employees;
-- PK(PRIMARY KEY) 는 자동으로 인덱스 생성
-- 그래서 PK는 AUTO_INCREMNET를 넣는 것


-- 0.031 초
SELECT * FROM employees
WHERE NAME= '주정웅';

-- INDEX 생성(ALTER 문)
-- ALTER TABLE [테이블이름] ADD INDEX idx_employees_name [지정할 인덱스 이름] (컬럼);
ALTER TABLE employees ADD INDEX idx_employees_name (NAME);
ALTER TABLE employees ADD INDEX idx_employees_gender (gender);

-- INDEX 제거(index 제거나 index 를 사용해도 속도가 같다면 제거)
DROP INDEX idx_employees_name ON employees;