-- UPDATE문 : 기존 데이터를 수정(WHERE 조건문 필수!)

-- 기본구조
-- UPDATE 테이블명
-- SET 컬럼1 = 값1, 컬럼2 = 값2...
-- WHERE 조건 
UPDATE employees
SET
	gender='F'
	,updated_at = NOW()
WHERE emp_id = 100003
;

-- 현재 시간으로 업데이트 되는 것
SELECT NOW();

-- 나의 직급을 'T005'로 변경해 주세요.
SELECT * FROM title_emps WHERE emp_id =100003 AND end_at IS NULL;

UPDATE title_emps
SET
	title_code = 'T005'
WHERE emp_id =100003
		AND end_at IS NULL
;

SELECT * FROM title_emps WHERE emp_id =100003 AND end_at IS NULL;

-- 현재 급여가 26,000,000원 이하인 직원의 급여를 50,000,000원 으로 수정해 주세요.
-- end_at = null 인 건 지금 급여가 26,000,000을 받고 있다. 이 급여가 끝나지 않았다 라는 의미
SELECT * FROM salaries
WHERE end_at IS NULL
AND salary <=26000000;

UPDATE salaries
SET
	salary = 50000000, updated_at =NOW()
WHERE salary <=26000000
		AND end_at IS NULL;
		
SELECT * FROM salaries
WHERE end_at IS NULL
AND salary =50000000;		

-- 원래 데이터를 select 로 확인 후 update 요소를 해준다.