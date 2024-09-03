-- JOIN 문
-- 두개 이상의 테이블을 묶어서 하나의 결과 집합으로 출력
-- JOIN 과 ON 은 세트
-- JOIN 문에서 * 전체를 주지 말자(전체 데이터를 다 가져옴)


-- INNER JOIN 문
-- 두 테이블이 공통적으로 만족하는 레코드를 출력(교집합)
-- 사원 번호, 이름, 소속부서코드를 출력
SELECT
	employees.emp_id
	,employees.NAME
	,department_emps.dept_code
	,departments.dept_name
FROM employees 
	JOIN department_emps 
		ON employees.emp_id = department_emps.emp_id
			AND department_emps.end_at IS NULL
-- 		테이블명 필수(as 사용가능)
-- 	ON 은 JOIN 을 쓸때 조건문이다.
	JOIN departments
		ON departments.dept_code = department_emps.dept_code
			AND department_emps.dept_code ='D001';
-- join 은 어려번 사용가능 join~ on~ join~ on ~
-- join 문 연결시 따로 부호를 안써도 된다. 
-- AND ~  을 써도 되고 WHERE ~ 을 써도 된다.
-- (WHERE 은 FROM JOIN 다쓰고 마지막에 WHERE절을 써주면 된다.)
WHERE
		department_emps.end_at IS NULL
	AND department_emps.dept_code ='D001'
;


-- LEFT JOIN(=LEFT OUTER JOIN) 문
-- 왼쪽 테이블을 기준 테이블로 두고 JOIN을 실행
-- 기존 테이블의 모든 데이터를 출력하고
-- 조인 대상 테이블에 없는 값은 NULL로 출력

-- 모든 사원의 사번,이름,부서장 시작 날짜
SELECT 
	employees.emp_id
	,employees.name
	,department_managers.start_at
FROM employees
	LEFT JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
WHERE
	department_managers.end_at IS null
ORDER BY department_managers.start_at DESC
;

-- RIGHT JOIN(=RIGHT OUTER JOIN) 문(안씀 보통 left join 으로 통일)
-- 오른쪽 테이블을 기준 테이블로 두고 JOIN을 실행
-- 기준 테이블의 모든 데이터를 출력하고
--  조인 대상 테이블에 없는 값은 NULL로 출력

SELECT
	employees.emp_id
	,employees.name
	,department_managers.start_at
FROM department_managers
	RIGHT JOIN employees
		ON department_managers.emp_id = employees.emp_id
WHERE
	department_managers.end_at IS NULL
ORDER BY department_managers.start_at desc
;


-- UNION      (중복제거)
-- UNION ALL  (중복제거 안함)
-- 두개 이상의 쿼리의 결과를 합쳐서 출력
SELECT * FROM employees WHERE emp_id IN(1, 3)
UNION ALL
SELECT * FROM employees WHERE emp_id IN(3, 6);


-- SELF JOIN
-- 자기 자신을 조인
-- 슈퍼바이저인 사원의 정보 출력
SELECT 
	emp1.emp_id
	,emp1.name
	,emp2.emp_id
	,emp2.name
FROM employees emp1
	JOIN employees emp2
		ON emp1.emp_id = emp2.sup_id
;


