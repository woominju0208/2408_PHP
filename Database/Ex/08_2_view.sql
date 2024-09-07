-- 사원의 사번,이름,현재직급명,현재소속부서명,현재연봉 조회
-- 내 쿼리
SELECT
	emp.emp_id
	,emp.name
	,t.title
	,de.dept_name
	,sal.salary
FROM employees emp
	JOIN salaries sal
		ON emp.emp_id = sal.emp_id
			AND sal.end_at IS null
	JOIN title_emps temp
		ON temp.emp_id = sal.emp_id
	JOIN titles t
		ON t.title_code = temp.title_code
			AND temp.end_at IS null
	JOIN department_emps demp
		ON demp.emp_id = emp.emp_id
	JOIN departments de
		ON de.dept_code = demp.dept_code
			AND demp.end_at IS NULL	
;
-- 선생님 쿼리
SELECT 
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL
	JOIN titles
		ON titles.title_code = title_emps.title_code
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.end_at IS NULL
	JOIN departments
		ON departments.dept_code = department_emps.dept_code
	JOIN salaries
		ON salaries.emp_id = employees.emp_id
			AND salaries.end_at IS NULL
;	


-- view 생성
-- CREATE VIEW [뷰 설정 이름]
-- AS
-- [VIEW 에 넣을 쿼리문]
CREATE VIEW view_emp_now_data
AS
SELECT 
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL
	JOIN titles
		ON titles.title_code = title_emps.title_code
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.end_at IS NULL
	JOIN departments
		ON departments.dept_code = department_emps.dept_code
	JOIN salaries
		ON salaries.emp_id = employees.emp_id
			AND salaries.end_at IS NULL
;

-- view 사용
-- SELECT * FROM [뷰 설정 이름];
-- index 사용이 불가 해 속도가 느려 잘 쓰지 않음
SELECT * FROM view_emp_now_data;
		
-- view 삭제
-- DROP VIEW [뷰 설정 이름];
DROP VIEW view_emp_now_data;					