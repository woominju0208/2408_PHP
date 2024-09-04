-- DELETE문  : 기존 데이터를 삭제(물리적 삭제)
--             조심해서 사용해야함

-- 기본구조
-- DELETE FROM 테이블명
-- WHERE 조건;

-- 나의 급여정보 삭제
SELECT * FROM salaries WHERE emp_id =100003;

DELETE FROM salaries
WHERE emp_id =100003;

SELECT * FROM salaries WHERE emp_id =100003;

-- 자신의 직급정보 삭제
SELECT * FROM title_emps WHERE emp_id=100003;

DELETE FROM title_emps
WHERE emp_id=100003;

SELECT * FROM title_emps WHERE emp_id=100003;