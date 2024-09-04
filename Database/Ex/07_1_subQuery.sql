-- 서브쿼리(SubQuery)
-- 자주 쓰이지만 속도가 느림
-- 속도가 느리기 때문에 대부분 JOIN문을 사용 

-- WHERE 절 사용 subQuery
-- 큰 쿼리안에 조건 =() ()안에 다른 테이블에 있던 작성 쿼리는 넣어준다.
-- ()안에 넣는 ; 꼭 빼기
-- 조건의 컬럼과 서브쿼리의 도출하는 컬럼과 일치해야한다
-- D001 부서장의 사번과 이름을 출력
SELECT employees.emp_id
		,employees.name
FROM employees
WHERE 
	employees.emp_id = (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE 
			department_managers.end_at IS null
		AND department_managers.dept_code ='D001'
	)
;
-- SELECT emp_id
-- FROM department_managers
-- WHERE 
-- 		end_at IS null
-- 	AND dept_code ='D001'
-- ;

-- 전체 부서장의 사번과 이름을 출력
-- in 연산자로 다중의 결과값 조회
SELECT employees.emp_id
		,employees.name
FROM employees
WHERE 
	employees.emp_id IN (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE 
			department_managers.end_at IS null
	)
;

-- 현재 직책이 T006인 사원의 사번과 이름,생일을 출력
SELECT emp_id
		,name
		,birth
FROM employees
WHERE
	emp_id IN (
		SELECT emp_id
		FROM title_emps
		WHERE
			end_at IS null
			and title_code='T006'
	)
;
-- SELECT emp_id
-- FROM title_emps
-- WHERE
-- 	end_at IS null
-- 	and title_code='T006'
-- ;

SELECT
	employees.emp_id
	,employees.name
	,employees.birth
FROM employees
WHERE
	employees.emp_id IN (
-- employees 의 emp_id
		SELECT title_emps.emp_id
-- title_emps 의 emp_id
-- where의 컬럼과 서브쿼리의 컬럼과 같아야 한다. 여기선 emp_id 가 해당사항
FROM title_emps
WHERE
	title_emps.end_at IS null
	and title_emps.title_code = 'T006'
	)
;	

SELECT title_emps.emp_id
FROM title_emps
WHERE
	title_emps.end_at IS null
	and title_emps.title_code = 'T006'
;

-- 다중열 서브쿼리
-- 현재 D002의 부서장이 해당 부서에 소속된 날짜 출력
SELECT
	department_emps.*
FROM department_emps
WHERE
	(department_emps.emp_id, department_emps.dept_code) IN(
		SELECT 
	department_managers.emp_id
	,department_managers.dept_code
FROM department_managers
WHERE 
	department_managers.end_at IS null
	AND department_managers.dept_code = 'D002'
	)
;

SELECT 
	department_managers.emp_id
	,department_managers.dept_code
FROM department_managers
WHERE 
	department_managers.end_at IS null
	AND department_managers.dept_code = 'D002'
;

-- 연관 서브쿼리
SELECT
	employees.*
FROM employees
WHERE
	employees.emp_id IN (
		SELECT department_managers.emp_id
		FROM department_managers
		WHERE
			department_managers.emp_id = employees.emp_id
	)
 ;
 
 
--  --------------------------------------
-- SELECT절에서 사용되는 subQuery
-- 사원별 평균 연봉과 사번,이름을 출력
SELECT 
	employees.emp_id
	,employees.name
	,(
		SELECT AVG(salaries.salary)
		FROM salaries
		where
			salaries.emp_id = employees.emp_id
-- 			employees와 salaries를 = 로 같다 표현해준다
	)  AS avg_sal
-- 	()안에 한 컬럼만 작성해야한다 
FROM employees
;

--  --------------------------------------
-- FROM절에서 사용되는 subQuery (서브쿼리중 많이 사용)
-- FROM 의 서브쿼리에 AS 필수
SELECT 
	tmp.*
FROM (
	select
		employees.emp_id
		,employees.name
	FROM employees
) AS tmp
;


SELECT 
	tmp.emp_id
FROM (
	select
		employees.emp_id
		,employees.name
	FROM employees
) AS tmp,
	(
		select
			salaries.emp_id
			,salaries.salary
		FROM salaries
) AS smp
WHERE tmp.emp_id = smp.emp_id
;


--  --------------------------------------
-- INSERT문에서 사용되는 subQuery
-- 이미 저장된 데이터값을 인서트해서 가져온다
INSERT INTO employees ( 
	name
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
) 
VALUES (
	(SELECT emp.NAME FROM employees emp WHERE emp.emp_id = 1000)
	,'2000-01-01'
	,'M'
	,DATE(NOW())
	,NULL
	,NULL
	,NOW()
	,NOW()
	,NULL
)
;

--  --------------------------------------
-- UPDATE문에서 사용되는 subQuery
UPDATE employees
SET
	employees.gender = (
		SELECT emp.gender
		FROM employees emp
		WHERE emp.emp_id=100000
	)
WHERE
	employees.emp_id = (
		SELECT MAX(emp2.emp_id)
		FROM employees emp2
	)
	;
	
UPDATE employees
SET
	gender = 'M'
WHERE emp_id=100000;
