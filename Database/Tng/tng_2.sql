-- 1. 사원의 사원번호, 이름, 직급코드를 출력해 주세요.
SELECT
	emp.emp_id
	,emp.name
	,tmp.title_code
FROM employees AS emp
	JOIN title_emps AS tmp
 		ON emp.emp_id = tmp.emp_id
WHERE tmp.end_at IS NULL
; 
-- ----------------------------------------------------------
SELECT
	employees.emp_id
	,employees.name
	,title_emps.title_code
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS null
;		
-- inner join 경우 and, where 의 차이가 없지만 left join,right join 은 속도차이가
-- 나서 join on 조건 and 을 적어주는게 속도가 빠르다.



-- 2. 사원의 사원번호, 성별, 현재 연봉을 출력해 주세요.
SELECT
	emp.emp_id
	,emp.gender
	,sal.salary
FROM employees AS emp
	JOIN salaries AS sal
		ON emp.emp_id = sal.emp_id
WHERE sal.end_at IS NULL
;
-- ----------------------------------------------------------
SELECT
	employees.emp_id
	,employees.gender
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL
;		


-- 3. 10010 사원의 이름과 과거부터 현재까지 연봉 이력을 출력해 주세요.
SELECT
	emp.name
	,sal.salary
FROM employees AS emp
	JOIN salaries AS sal
		ON emp.emp_id = sal.emp_id
WHERE
	emp.emp_id = 10010
;		
-- ----------------------------------------------------------
SELECT
	employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.emp_id = 10010
;		
-- employees와 salaries 의 emp_id 를 같게 설정해서 둘 중 하나를 적어도 된다. 



-- 4. 사원의 사원번호, 이름, 소속부서명을 출력해 주세요.
SELECT
	emp.emp_id
	,emp.name
	,dep.dept_name
FROM employees AS emp
	JOIN department_emps AS dept
		ON emp.emp_id = dept.emp_id
	JOIN departments AS dep
		ON dept.dept_code = dep.dept_code
WHERE
	dept.end_at IS null			
;
-- ----------------------------------------------------------
SELECT
	employees.emp_id
	,employees.name
	,departments.dept_name
FROM employees
	JOIN department_emps
		ON employees.emp_id = department_emps.emp_id
		AND department_emps.end_at IS null
	JOIN departments
		ON department_emps.dept_code = departments.dept_code
;			


-- 5. 현재 월급의 상위 10위까지 사원의 사번, 이름, 월급을 출력해 주세요.
SELECT
	emp.emp_id
	,emp.name
	,sal.salary
FROM employees AS emp
	JOIN salaries AS sal
		ON emp.emp_id = sal.emp_id
WHERE sal.end_at IS NULL		
ORDER BY salary desc	
LIMIT 10
;	
-- ----------------------------------------------------------
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL
ORDER BY salaries.salary DESC
LIMIT 10		
;
-- rank로 순위 나열해도 맞음
SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
	,RANK() OVER(ORDER BY salaries.salary desc) rank
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND salaries.end_at IS NULL
LIMIT 10		
;		


					
-- 6. 현재 각 부서의 부서장의 부서명, 이름, 입사일을 출력해 주세요.
SELECT
	dep.dept_name
	,emp.name
	,emp.hire_at
FROM employees AS emp
	JOIN department_managers AS demg
		ON emp.emp_id = demg.emp_id
	JOIN departments AS dep
		ON demg.dept_code = dep.dept_code
WHERE
	demg.end_at IS NULL
	AND dep.end_at IS null
;
-- ----------------------------------------------------------
SELECT
	departments.dept_name
	,employees.name
	,employees.hire_at
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
		AND department_managers.end_at IS null
	JOIN departments
		ON department_managers.dept_code = departments.dept_code
;		



-- 7. 현재 직급이 "부장"인 사원들의 월급 평균을 출력해 주세요. xxxx
SELECT
	avg(sal.salary)
FROM salaries AS sal
	JOIN employees AS emp
		ON sal.emp_id = emp.emp_id
	JOIN title_emps AS temp
		ON emp.emp_id = temp.emp_id
	JOIN titles 
		ON temp.title_code = title.title_code
GROUP BY emp.emp_id		
HAVING
	titles.title = '부장'
	AND titles.end_at IS null		
;

SELECT
	sal.salary
FROM salaries AS sal
	JOIN title_emps AS temp
		ON sal.emp_id = temp.emp_id
	JOIN titles 
		ON temp.title_code = title.title_code
GROUP BY titles.title 		
HAVING
	AVG(sal.salary) = '부장'		
;
-- ----------------------------------------------------------
SELECT
	titles.title
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
			AND titles.title = '부장'
			AND title_emps.end_at IS null
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
			AND salaries.end_at IS null
GROUP BY titles.title
;		

-- 현재 각 부장별 연봉 평균
SELECT
	title_emps.emp_id
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
		AND titles.title = '부장'
		AND title_emps.end_at IS NULL
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
		GROUP BY title_emps.emp_id 	
;		

-- 현재 각 부장별 이름, 연봉 평균
SELECT
	employees.emp_id
	,employees.name
	,avg_table.avg_sal
FROM employees
	JOIN (
		SELECT
	title_emps.emp_id
	,AVG(salaries.salary) avg_sal
FROM title_emps
	JOIN titles
		ON title_emps.title_code = titles.title_code
		AND titles.title = '부장'
		AND title_emps.end_at IS NULL
	JOIN salaries
		ON title_emps.emp_id = salaries.emp_id
		GROUP BY title_emps.emp_id
	) avg_table
		ON employees.emp_id = avg_table.emp_id
;

SELECT 
	employees.emp_id
	,employees.name
	,AVG(salaries.salary)
FROM title_emps
	 JOIN titles
	 	ON titles.title_code = title_emps.title_code
		 	AND titles.title = '부장'
		 	AND title_emps.end_at IS NULL		 	
	JOIN salaries
		ON salaries.emp_id = title_emps.emp_id
			AND salaries.end_at IS null
	JOIN employees
		ON employees.emp_id = salaries.emp_id
GROUP BY title_emps.emp_id	
-- GROUP BY titles.title 을 넣으면 부장이라는 그룹만 잡히기 때문에
-- title_emps.emp_id로 모든 직급들을 그룹화 해줘야 한다.	
;
			 	

	
-- () 안에 있는 서브쿼리 에 group by 가 있으니 서브쿼리 밖에
-- 메인 쿼리 join 에도 또 group by 를 적을수 있다.

-- 연봉평균 만 넣으면 이름 employees와 연관된 컬럼이 없기 때문에 같은 요소인 emp_id를
-- 넣어서 employees와 서브쿼리 avg_table 을 join 해 주었다. 

		
	

-- 8. 부서장직을 역임했던 모든 사원의 이름과 입사일, 사번, 부서번호를 출력해 주세요.
SELECT
	emp.name
	,emp.hire_at
	,emp.emp_id
	,demg.dept_code
FROM employees AS emp
	JOIN department_managers AS demg
		ON emp.emp_id = demg.emp_id
;
-- ----------------------------------------------------------
SELECT
	employees.name
	,employees.hire_at
	,employees.emp_id
	,department_managers.dept_code
FROM employees
	JOIN department_managers
		ON employees.emp_id = department_managers.emp_id
;				



-- 9. 현재 각 직급별 평균월급 중 60,000,000이상인 직급의 직급명, 평균월급(정수)를을 내림차순으로 출력해 주세요.
SELECT
	t.title
	,sal.salary
FROM salaries AS sal
	JOIN employees AS emp
		ON sal.emp_id = emp.emp_id	
	JOIN title_emps AS temp
		ON emp.emp_id = temp.emp_id
	JOIN titles AS t
		ON temp.title_code = t.title_code
GROUP BY title_code		
HAVING
	sal.AVG(salary) >=60000000
ORDER BY sal.AVG(salary) DESC
;
-- ----------------------------------------------------------
SELECT
	titles.title
	,CEILING(AVG(salaries.salary)) avg_sal
FROM salaries
	JOIN title_emps
		ON salaries.emp_id = title_emps.emp_id
			AND salaries.end_at IS null
			AND title_emps.end_at IS null
	JOIN titles
		ON title_emps.title_code = titles.title_code
GROUP BY titles.title
	HAVING
		avg_sal >=60000000
ORDER BY avg_sal DESC
;		




-- 10. 성별이 여자인 사원들의 직급별 사원수를 출력해 주세요.
SELECT
	COUNT(t.title)
FROM employees AS emp
	JOIN title_emps AS temp 
		ON emp.emp_id = temp.emp_id
	JOIN titles AS t
		ON temp.title_code = t.title_code
	GROUP BY temp.title_code
	HAVING 
		COUNT(t.title) = 'F'
;

SELECT
	titles.title
	,COUNT(title)
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
		AND employees.gender = 'F'
		AND title_emps.end_at IS NULL
		AND employees.fire_at IS NULL 
	JOIN titles
		ON title_emps.title_code = titles.title_code
GROUP BY title_emps.title_code
;
-- ----------------------------------------------------------
SELECT
	title_emps.title_code
	,COUNT(*) AS cnt
FROM employees
	JOIN title_emps
		ON employees.emp_id = title_emps.emp_id
			AND title_emps.end_at IS NULL
			AND employees.fire_at IS NULL
			AND employees.gender= 'F'
GROUP BY title_emps.title_code
;		


				